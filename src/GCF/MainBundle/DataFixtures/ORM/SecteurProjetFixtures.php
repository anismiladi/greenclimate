<?php

namespace GCF\MainBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GCF\MainBundle\Entity\SecteurProjet;

class SecteurProjetFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $names = array(
            'Economie agricole',
            'Agriculture',
            'Ressource en eau',
            'Forêts',
            'Ecosystème côtier et aquatique',
            'Écosystème oasien',
            'Société civile',
            'Sécurité alimentaire',
            'Renforcement de capacité et transfert des technologies',
            'Energie',
            'Aménagement',
            'Industrie',
            'Santé',
            'Education environnementale',
            'Finance climat',
            'Consommation durable',
            'Écotourisme',
            'Transport',
            'Assainissement',
            'Déchet',
            'Etudes, Stratégies et Planifications',
            'Catastrophes naturelles et prévention des angers',
            'Changement climatique',
            'Autres'
        );

        foreach ($names as $name) {

            $secActeur = new SecteurProjet();
            $secActeur->setNom($name);

            // On la persiste
            $manager->persist($secActeur);
        }

        $manager->flush();
    }
}