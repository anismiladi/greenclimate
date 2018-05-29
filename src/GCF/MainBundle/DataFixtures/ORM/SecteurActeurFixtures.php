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
            'Organisme publique',
            'Organisme privé',
            'Société civile',
            'Parlement',
            'M.Environnement',
            'M.Agriculture',
            'M.Energie',
            'M.Transport',
            'Autres'
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