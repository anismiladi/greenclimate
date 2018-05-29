<?php

namespace GCF\MainBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GCF\MainBundle\Entity\Focus;

class FocusFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Adaptation',
            'Atténuation',
            'Vulnérabilité',
            'Transfert Technologie et renforcement de capacité',
            'Les objectifs de développement durable',
            'Economie verte',
            'Perte et dommages',
            'Genre',
            'Droits de l’homme',
            'Transparence'
        );

        foreach ($names as $name) {

            $focus = new Focus();
            $focus->setNom($name);

            // On la persiste
            $manager->persist($focus);
        }

        $manager->flush();
    }
}