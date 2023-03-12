<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Contact;

use Symfony\Polyfill\Intl\Normalizer\Normalizer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ContactFixtures extends Fixture 
{
    private $faker;
    

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
       
 }

    public function load(ObjectManager $manager): void
    {
       
        for($i=0;$i<20;$i++){
            $c = new Contact();
            $c->setNom($this->faker->lastName())
            ->setSujet($this->faker->sentence(3))
            ->setDateEnvoi($this->faker->dateTimeThisYear())
            ->setEmail(strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',$this->faker->firstName().'.'.$c->getNom().'@'.$this->faker->freeEmailDomain())))
            ->setMessage($this->faker->paragraph())
            ;
        
            $manager->persist($c);
        }
        $manager->flush();
    }

   
}