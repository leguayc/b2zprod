<?php

namespace App\Controller\BackOffice;

use App\Entity\Project;
use App\Entity\ProjectThanks;
use App\Form\ProjectType;
use App\Form\ProjectThanksType;
use App\Form\ProjectTranslationType;
use App\Repository\ProjectRepository;
use App\Repository\ProjectThanksRepository;
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
            unset($image);

            $pressKit = $form->get('pressKit')->getData();
            if ($pressKit) {
                $newFilename = $blobHelper->uploadFile($pressKit, 'projects_directory');
                $project->setPressKit($newFilename);
            }
            unset($pressKit);

            // Traductions
            $lang = 'fr'; 
            $project->translate($lang)->setTitle($form->get('title')->getData());
            $project->translate($lang)->setDescription($form->get('description')->getData());
            $project->translate($lang)->setSection1Title($form->get('section1title')->getData());
            $project->translate($lang)->setSection1Text($form->get('section1text')->getData());
            $project->translate($lang)->setSection2Title($form->get('section2title')->getData());
            $project->translate($lang)->setSection2Text($form->get('section2text')->getData());

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
    public function edit(Request $request, Project $project, ProjectRepository $projectRepository, BlobHelper $blobHelper): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $newFilename = $blobHelper->uploadFile($image, 'projects_directory');
                $project->setImage($newFilename);
            }
            unset($image);

            $pressKit = $form->get('pressKit')->getData();
            if ($pressKit) {
                $newFilename = $blobHelper->uploadFile($pressKit, 'projects_directory');
                $project->setPressKit($newFilename);
            }
            unset($pressKit);

            // Traductions
            $lang = 'fr'; 
            $project->translate($lang)->setTitle($form->get('title')->getData());
            $project->translate($lang)->setDescription($form->get('description')->getData());
            $project->translate($lang)->setSection1Title($form->get('section1title')->getData());
            $project->translate($lang)->setSection1Text($form->get('section1text')->getData());
            $project->translate($lang)->setSection2Title($form->get('section2title')->getData());
            $project->translate($lang)->setSection2Text($form->get('section2text')->getData());
          
            $projectRepository->add($project, true);

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_delete', methods: ['POST'])]
    public function delete(Request $request, Project $project, ProjectRepository $projectRepository, ProjectThanksRepository $projectThanksRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $projectThanks = $project->getProjectThanks();
            foreach ($projectThanks as $key => $value) {
                $projectThanksRepository->remove($value);
            }

            $projectRepository->remove($project, true);
        }

        return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/addthanks', name: 'app_project_addthanks', methods: ['GET', 'POST'])]
    public function addThanks(Request $request, Project $project, ProjectThanksRepository $projectThanksRepository): Response
    {
        $projectThanks = new ProjectThanks();
        $projectThanks->setProject($project);
        $form = $this->createForm(ProjectThanksType::class, $projectThanks);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectThanksRepository->add($projectThanks, true);

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('project/addthanks.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/managetranslation', name: 'app_project_managetranslation', methods: ['GET', 'POST'])]
    public function manageTranslation(Request $request, Project $project, ProjectRepository $projectRepository): Response
    {
        $form = $this->createForm(ProjectTranslationType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lang = $request->request->get('lang'); 
            $project->translate($lang)->setTitle($form->get('title')->getData());
            $project->translate($lang)->setDescription($form->get('description')->getData());
            $project->translate($lang)->setSection1Title($form->get('section1title')->getData());
            $project->translate($lang)->setSection1Text($form->get('section1text')->getData());
            $project->translate($lang)->setSection2Title($form->get('section2title')->getData());
            $project->translate($lang)->setSection2Text($form->get('section2text')->getData());

            $projectRepository->add($project, true);

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        $langsJson = file_get_contents($this->getParameter('locales_directory') . '/langs.json');
        $allLangs = json_decode($langsJson, true)['allLangs'];

        return $this->render('project/managetranslation.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'allLangs' => $allLangs
        ]);
    }
}
