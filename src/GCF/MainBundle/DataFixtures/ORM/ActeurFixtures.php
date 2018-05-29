<?php

namespace GCF\MainBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GCF\MainBundle\Entity\Acteur;

class ActeurFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $acteur = new Acteur();
            $acteur->setNom('acteur '.$i);
            $acteur->setLogo('logo'.mt_rand(10, 100));
            $acteur->setDescription('description'.$i);
            $acteur->setHierarchie('hierarchie'.$i);
            $acteur->setMission('mission'.$i);
            $acteur->setResponsable('responsable'.$i);
            $acteur->setContact('contact'.$i);
            $acteur->setCritique('contact'.$i);

            $manager->persist($acteur);
        }

        $manager->flush();
    }
}