<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Fichier;
use App\Entity\Telecharger;
use App\Entity\User;
use Symfony\Polyfill\Intl\Normalizer\Normalizer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TelechargerFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;


    public function __construct(){
        $this->faker=Factory::create("fr_FR");     
 }

    public function load(ObjectManager $manager): void
    {
        // https://fakerphp.github.io/formatters/numbers-and-strings/
       
        $i = 0;
      
        for ($u=0;$u<mt_rand(0,9);$u++){
            for ($f=0;$f<mt_rand(0,9);$f++){
                $t = new Telecharger();
                $t->setUser($this->getReference('user'.$u))
                ->setFichier($this->getReference('fichier'.$f))
                ->setNb($this->faker->randomNumber(3, false));            
                $this->addReference('telechargement'.$i, $t);
                $manager->persist($t);
                $i++;
            }
        }
       
       
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            FichierFixtures::class,
        ];
    }
}