<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SCategorie;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

class VerifController extends AbstractController
{
    #[Route('/verif', name: 'app_verif')]
    public function index(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $cat1 = $entityManagerInterface->getRepository(Categorie::class)->find(1);
       
        $scat1 = new SCategorie();
        $scat1->setLibelle('Développement');
        $scat1->setNumero(1);
        $scat1->setCategorie($cat1);
        $entityManagerInterface->persist($scat1);
        $entityManagerInterface->flush();
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/VerifController.php',
        ]);
    }
}
