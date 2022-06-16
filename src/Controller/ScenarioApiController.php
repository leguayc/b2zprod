<?php

namespace App\Controller;

use App\Entity\Scenario;
use App\Repository\ScenarioRepository;
use App\Helpers\BlobHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class ScenarioApiController extends AbstractController
{
    private ScenarioRepository $repository;
    private BlobHelper $blobHelper;

    public function __construct(ScenarioRepository $repository, BlobHelper $blobHelper)
    {
        $this->repository = $repository;
        $this->blobHelper = $blobHelper;
    }

    public function __invoke(Request $request): Scenario
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        if ($uploadedFile->guessExtension() !== "pdf" && $uploadedFile->guessExtension() !== "xpdf")
        {
            throw new BadRequestHttpException('"file" needs to be a PDF');
        }

        $newFilename = $this->blobHelper->uploadFile($uploadedFile, 'scenarios_directory');

        $scenario = new Scenario();
        $scenario->setFile($newFilename);
        $scenario->setEmail($request->request->get('email'));
        $scenario->setPhoneNumber($request->request->get('phoneNumber'));
        $scenario->setFirstname($request->request->get('firstname'));
        $scenario->setLastname($request->request->get('lastname'));
        $scenario->setSummary($request->request->get('summary'));
        $scenario->setStuffToAdd($request->request->get('stuffToAdd'));

        return $scenario;
    }
}
