<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;

class CategorieFixtures extends Fixture
{
    
    public function __construct(){
       
    }

    public function load(ObjectManager $manager): void
    {
        $cat1 = new Categorie();
        $cat1->setLibelle('Informatique');
        $manager->persist($cat1);
        $this->addReference('cat1', $cat1);

        $cat2 = new Categorie();
        $cat2->setLibelle('Eco/Gestion/Mana');
        $manager->persist($cat2);
        $this->addReference('cat2', $cat2);

        $cat3 = new Categorie();
        $cat3->setLibelle('Anglais');
        $manager->persist($cat3);
        $this->addReference('cat3', $cat3);
        
        $manager->flush();
    }
}