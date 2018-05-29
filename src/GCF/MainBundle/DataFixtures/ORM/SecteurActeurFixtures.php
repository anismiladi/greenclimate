<?php

namespace GCF\MainBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GCF\MainBundle\Entity\SecteurActeur;

class SecteurActeurFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $names = array(
            'Publique',
            'M.Environnement',
            'M.Agriculture',
            'M.Energie',
            'M.Transport',
            'Privé',
            'Société civile',
            'Parlement',
            'Parlement',
            'Comités',
            'Corps'
        );

        foreach ($names as $name) {

            $secActeur = new SecteurActeur();
            $secActeur->setNom($name);

            // On la persiste
            $manager->persist($secActeur);
        }

        $manager->flush();
    }
}