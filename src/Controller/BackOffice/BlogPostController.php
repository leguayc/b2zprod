<?php

namespace App\Controller\BackOffice;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\BlobHelper;

#[Route('/blogpost')]
class BlogPostController extends AbstractController
{
    #[Route('/', name: 'app_blog_post_index', methods: ['GET'])]
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog_post/index.html.twig', [
            'blog_posts' => $blogPostRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blog_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlogPostRepository $blogPostRepository, BlobHelper $blobHelper): Response
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if ($file) {
                $newFilename = $blobHelper->uploadFile($file, 'blogposts_directory');
                $blogPost->setImage($newFilename);
            }

            $blogPost->setCreationdate(new \DateTime());
            $blogPost->setLocale($request->request->get('lang'));

            $blogPostRepository->add($blogPost, true);

            return $this->redirectToRoute('app_blog_post_index', [], Response::HTTP_SEE_OTHER);
        }

        $langsJson = file_get_contents($this->getParameter('locales_directory') . '/langs.json');
        $allLangs = json_decode($langsJson, true)['allLangs'];

        return $this->renderForm('blog_post/new.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form,
            'allLangs' => $allLangs
        ]);
    }

    #[Route('/{id}', name: 'app_blog_post_show', methods: ['GET'])]
    public function show(BlogPost $blogPost): Response
    {
        return $this->render('blog_post/show.html.twig', [
            'blog_post' => $blogPost,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_blog_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlogPost $blogPost, BlogPostRepository $blogPostRepository, BlobHelper $blobHelper): Response
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if ($file) {
                $newFilename = $blobHelper->uploadFile($file, 'blogposts_directory');
                $blogPost->setImage($newFilename);
            }

            $blogPost->setLocale($request->request->get('lang'));

            $blogPostRepository->add($blogPost, true);

            return $this->redirectToRoute('app_blog_post_index', [], Response::HTTP_SEE_OTHER);
        }

        $langsJson = file_get_contents($this->getParameter('locales_directory') . '/langs.json');
        $allLangs = json_decode($langsJson, true)['allLangs'];

        return $this->renderForm('blog_post/edit.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form,
            'allLangs' => $allLangs
        ]);
    }

    #[Route('/{id}', name: 'app_blog_post_delete', methods: ['POST'])]
    public function delete(Request $request, BlogPost $blogPost, BlogPostRepository $blogPostRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogPost->getId(), $request->request->get('_token'))) {
            $blogPostRepository->remove($blogPost, true);
        }

        return $this->redirectToRoute('app_blog_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
