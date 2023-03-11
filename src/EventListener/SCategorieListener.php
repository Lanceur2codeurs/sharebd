<?php
namespace App\EventListener;
use App\Entity\SCategorie;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class SCategorieListener
{
    public function prePersist(SCategorie $sCategorie, LifecycleEventArgs $event): void
    {
        $entityManager = $event->getEntityManager();
        $repository = $entityManager->getRepository(SCategorie::class);

        $count = $repository->findDuplicates($sCategorie->getNumero(), $sCategorie->getCategorie());

        if ($count > 0) {
            throw new \RuntimeException('Le numéro est déjà utilisé pour cette catégorie.');
        }
    }
}