<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/users', name: 'app_user')]
    public function user(EntityManagerInterface $entityManagerInterface): Response
    {
        $users = $entityManagerInterface->getRepository(Client::class)->findAll();
        return $this->render('user/users.html.twig', [
            'users' => $users,
        ]);
    }
}
