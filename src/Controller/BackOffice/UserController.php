<?php

namespace App\Controller\BackOffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/setadmin/{id}', name: 'app_user_setadmin', methods: ['POST'])]
    public function setAdmin(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('setadmin'.$user->getId(), $request->request->get('_token')))
        {
            $roles = $user->getRoles();

            if (!in_array("ROLE_ADMIN", $roles))
            {
                $roles[] = "ROLE_ADMIN";
                $user->setRoles($roles);
            }

            $userRepository->add($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token')))
        {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
