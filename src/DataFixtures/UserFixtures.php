<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Polyfill\Intl\Normalizer\Normalizer;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<10;$i++){
            $user = new User();
            $user->setNom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setRoles(array('ROLE_USER'))
            ->setEmail(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',strtolower($user->getPrenom()).'.'.strtolower($user->getNom()).'@'.$this->faker->freeEmailDomain()))
            ->setPassword($this->passwordHasher->hashPassword($user, strtolower($user->getPrenom())))
            ->setDateInscription($this->faker->dateTimeThisYear())
            ->setIsVerified(true);
            $this->addReference('user'.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    
}