<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Abonnement;

class AbonnementFixtures extends Fixture
{
    
    public function __construct(){
       
    }

    public function load(ObjectManager $manager): void
    {
        $abo1 = new Abonnement();
        $abo1->setLibelle('Mensuel');
        $manager->persist($abo1);
        $this->addReference('abo1', $abo1);

        $abo2 = new Abonnement();
        $abo2->setLibelle('Annuel');
        $manager->persist($abo2);
        $this->addReference('abo2', $abo2);

        
        $manager->flush();
    }
}