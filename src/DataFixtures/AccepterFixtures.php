<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AccepterFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function __construct(){
       
    }

    public function load(ObjectManager $manager): void
    {
        for ($u=0;$u<mt_rand(0,9);$u++){
            for ($a=0;$a<mt_rand(0,9);$a++){
                if($u != $a){
                    $user = $this->getReference('user'.$u);
                    $ami = $this->getReference('user'.$a);
                    $user->addAccepter($ami);
                    $manager->persist($user);
                }
            }        
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