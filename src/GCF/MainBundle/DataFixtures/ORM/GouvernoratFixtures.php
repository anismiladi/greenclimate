<?php

namespace GCF\MainBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GCF\MainBundle\Entity\Gouvernorat;

class GouvernoratFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $names = array(
            'Ariana',
            'Béja',
            'Ben Arous',
            'Bizerte',
            'Gabès',
            'Gafsa',
            'Jendouba',
            'Kairouan',
            'Kasserine',
            'Kébili',
            'Le Kef',
            'Mahdia',
            'La Manouba',
            'Médenine',
            'Monastir',
            'Nabeul',
            'Sfax',
            'Sidi Bouzid',
            'Siliana',
            'Sousse',
            'Tataouine',
            'Tozeur',
            'Tunis',
            'Zaghouan'
        );

        foreach ($names as $name) {

            $gouvernorat = new Gouvernorat();
            $gouvernorat->setNom($name);

            // On la persiste
            $manager->persist($gouvernorat);
        }

        $manager->flush();
    }
}