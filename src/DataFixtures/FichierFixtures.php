<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Fichier;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Polyfill\Intl\Normalizer\Normalizer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FichierFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
        // https://fakerphp.github.io/formatters/numbers-and-strings/
        for($i=0;$i<100;$i++){
            $f = new Fichier();
            $f->setNomOriginal($this->faker->regexify('[A-Z]{20}'))
            ->setNomServeur($this->faker->regexify('[A-Z]{5}[0-4]{3}'))
            ->setDateEnvoi($this->faker->dateTimeThisYear())
            ->setExtension($this->faker->randomElement(['png', 'pdf', 'txt']))
            ->setTaille($this->faker->randomNumber(5, false))
            ->setProprietaire($this->getReference('user'.mt_rand(0,9)));
            $this->addReference('fichier'.$i, $f);
            $manager->persist($f);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}