<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/{svelte_routing?}/{svelte_params?}', name: 'app_default', priority: -1)]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
