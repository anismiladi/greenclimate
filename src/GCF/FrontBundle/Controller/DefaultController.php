<?php

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(){

        $pageTitle = 'Accueil';

        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('GCFMainBundle:Projet')->findAll();

        $sectors = $em->getRepository('GCFMainBundle:SecteurProjet')->findAll();

        $nbrProj= array();

        foreach ($sectors as $sector){

            $i=0;

            foreach ($projects as $project){

                if( $project->getSecteurProjet()->getNom() ==  $sector->getNom() ) {

                    $i = $i + 1;

                }

            }

            $nbrProj[$sector->getNom()] = $i;

        }

        return $this->render('@GCFFront/Default/index.html.twig',array(
            'pageTitle' => $pageTitle,
            'nbr_by_project' => $nbrProj
        ));
    }

}