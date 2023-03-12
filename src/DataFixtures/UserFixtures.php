<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Polyfill\Intl\Normalizer\Normalizer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
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
            $user = new Client();
            $user->setNom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setRoles(array('ROLE_USER'))
            ->setEmail(strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',$user->getPrenom().'.'.$user->getNom().'@'.$this->faker->freeEmailDomain())))
            ->setPassword($this->passwordHasher->hashPassword($user, strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',$user->getPrenom()))))
            ->setDateInscription($this->faker->dateTimeThisYear())
            ->setIsVerified(true)
            ->setAbo($this->getReference('abo'.mt_rand(1,2)));
            $this->addReference('user'.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AbonnementFixtures::class,
        ];
    }

    
}