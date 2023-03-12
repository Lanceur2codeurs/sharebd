<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Fichier;
use App\Entity\SCategorie;
use Symfony\Polyfill\Intl\Normalizer\Normalizer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AttribuerFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    
    public function __construct(){
        $this->faker=Factory::create("fr_FR");     
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<100;$i++){
            $f = $this->getReference('fichier'.$i);
            $ss = $this->getReference('scat'.mt_rand(1,5)); 
            $f->addLesSousCategory($ss);
            $manager->persist($f);
            $manager->persist($ss);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FichierFixtures::class,
            SCategorieFixtures::class,
            CategorieFixtures::class,
        ];
    }
}