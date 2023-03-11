<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\SCategorie;
use App\Entity\Categorie;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SCategorieFixtures extends Fixture implements DependentFixtureInterface
{
   

    public function load(ObjectManager $manager): void
    {

        $scat1 = new SCategorie();
        $scat1->setLibelle('Développement');
        $scat1->setNumero(1);
        $scat1->setCategorie($this->getReference('cat1'));
        $manager->persist($scat1);
        $this->addReference('scat1', $scat1);
        
        $scat2 = new SCategorie();
        $scat2->setLibelle('Réseau');
        $scat2->setNumero(2);
        $scat2->setCategorie($this->getReference('cat1'));
        $manager->persist($scat2);
        $this->addReference('scat2', $scat2);

        $scat3 = new SCategorie();
        $scat3->setLibelle('Economie');
        $scat3->setNumero(1);
        $scat3->setCategorie($this->getReference('cat2'));
        $manager->persist($scat3);
        $this->addReference('scat3', $scat3);

        $scat4 = new SCategorie();
        $scat4->setLibelle('Droit');
        $scat4->setNumero(2);
        $scat4->setCategorie($this->getReference('cat2'));
        $manager->persist($scat4);
        $this->addReference('scat4', $scat4);

        $scat5 = new SCategorie();
        $scat5->setLibelle('Management');
        $scat5->setNumero(3);
        $scat5->setCategorie($this->getReference('cat2'));
        $manager->persist($scat5);
        $this->addReference('scat5', $scat5);

        $scat6 = new SCategorie();
        $scat6->setLibelle('Vocabulaire');
        $scat6->setNumero(1);
        $scat6->setCategorie($this->getReference('cat3'));
        $manager->persist($scat5);
        $this->addReference('scat6', $scat6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }
}