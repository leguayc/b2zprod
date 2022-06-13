<?php

namespace App\Controller\BackOffice;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\BlobHelper;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project_index', methods: ['GET'])]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_project_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProjectRepository $projectRepository, BlobHelper $blobHelper): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $newFilename = $blobHelper->uploadFile($image, 'projects_directory');
                $project->setImage($newFilename);
            }

            $pressKit = $form->get('pressKit')->getData();
            if ($pressKit) {
                $newFilename = $blobHelper->uploadFile($pressKit, 'projects_directory');
                $project->setPressKit($newFilename);
            }

            // Traductions
            $project->translate('fr')->setTitle($form->get('title')->getData());
            $project->translate('fr')->setDescription($form->get('description')->getData());
            $project->translate('fr')->setSection1Title($form->get('section1title')->getData());
            $project->translate('fr')->setSection1Text($form->get('section1text')->getData());
            $project->translate('fr')->setSection2Title($form->get('section2title')->getData());
            $project->translate('fr')->setSection2Text($form->get('section2text')->getData());

            $projectRepository->add($project, true);

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_show', methods: ['GET'])]
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Project $project, ProjectRepository $projectRepository): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $newFilename = $blobHelper->uploadFile($image, 'projects_directory');
                $project->setImage($newFilename);
            }

            $pressKit = $form->get('pressKit')->getData();
            if ($pressKit) {
                $newFilename = $blobHelper->uploadFile($pressKit, 'projects_directory');
                $project->setPressKit($newFilename);
            }

            // Traductions
            $project->translate('fr')->setTitle($form->get('title')->getData());
            $project->translate('fr')->setDescription($form->get('description')->getData());
            $project->translate('fr')->setSection1Title($form->get('section1title')->getData());
            $project->translate('fr')->setSection1Text($form->get('section1text')->getData());
            $project->translate('fr')->setSection2Title($form->get('section2title')->getData());
            $project->translate('fr')->setSection2Text($form->get('section2text')->getData());
            
            $projectRepository->add($project, true);

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_delete', methods: ['POST'])]
    public function delete(Request $request, Project $project, ProjectRepository $projectRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $projectRepository->remove($project, true);
        }

        return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
    }
}
