<?php

namespace GCF\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActorsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $sectors = $em->getRepository('GCFMainBundle:SecteurActeur')->findAll();

        $sectorsFils = $em->getRepository('GCFMainBundle:SecteurActeur')->findAll();


        return $this->render('@GCFFront/Default/Actors/actors.html.twig',array(
            'sectors' => $sectors,
            'sectorsFils'=> $sectorsFils

        ));
    }

    public function gethierarchieAction( $clicked )
    {
        $em = $this->getDoctrine()->getManager();

        $acteur = $em->getRepository('GCFMainBundle:Acteur')->findAll();

        $secteursActeur = $em->getRepository('GCFMainBundle:SecteurActeur')->findAll();

        $response = array();

        foreach ($acteur as $act){

            //$response[] = $act->getSecteurActeur()->getId();

            foreach ( $secteursActeur as $secteurActeur)
            {
                if($secteurActeur->getId() == $act->getSecteurActeur()->getId())
                {
                    if ($secteurActeur->getNom() == $clicked){
                        //$response[] = $act->getActeurParent();
                        if ($act->getActeurParent() == null){
                            //dump($act->getNom());

                            foreach ($act->getActeurFils() as $fils){
                                $filsarray[] = $fils->getNom();
                            }
                            $response[] = array('nom' => $act->getNom(), 'parent'=> 'null', 'fils' => $filsarray );
                        }else{
                            //dump($act->getNom());
                            $filsarray = array();
                            foreach ($act->getActeurFils() as $fils){
                                $filsarray[] = $fils->getNom();
                            }
                            $response[] = array('nom'=>$act->getNom(), 'parent' => $act->getActeurParent()->getNom(), 'fils' => $filsarray );

                        }

//                        foreach ( $act->getActeurParent() as $acttt) {
//                            dump($acttt);
//
//                        }


                    }
                }
            }

        }

        return new JsonResponse($response);
    }

    public function ActorsSectorAction($id){
        $em = $this->getDoctrine()->getManager();
        $sector = $em->getRepository('GCFMainBundle:SecteurActeur')->findOneById($id);
        $actors = $em->getRepository('GCFMainBundle:Acteur')->findBy(
            array( 'secteurActeur' => $id,
                'acteurParent' => Null,
            )
        );

        $sectors = $em->getRepository('GCFMainBundle:SecteurActeur')->findBy(
            array( 'secteurActeurParent' => Null)
        );
        return $this->render('@GCFFront/Default/Actors/actorsSector.html.twig',array(
            'sector' => $sector,
            'actors' => $actors,
            'sectors' => $sectors,
        ));
    }
    public function sousActorsAction($id){
        $em = $this->getDoctrine()->getManager();
        $actor = $em->getRepository('GCFMainBundle:Acteur')->findOneById($id);

        return $this->render('@GCFFront/Default/Actors/blocks/sousactors.html.twig',array(
            'actor' => $actor,
        ));
    }

    public function oPublicAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sectors = $em->getRepository('GCFMainBundle:SecteurActeur')->findBy(
            array( 'secteurActeurParent' => 1)
        );



        return $this->render('@GCFFront/Default/Actors/oPublic.html.twig',array(
            'sectors' => $sectors
        ));
    }

    public function oPrivateAction()
    {
        return $this->render('@GCFFront/Default/Actors/oPrivate.html.twig');
    }
    public function sCivileAction()
    {
        return $this->render('@GCFFront/Default/Actors/sCivile.html.twig');
    }
    public function parlementAction()
    {

        $em = $this->getDoctrine()->getManager();
        $palement = $em->getRepository('GCFMainBundle:SecteurActeur')->findBy(
            array( 'secteurActeurParent' => 4)
        );
        return $this->render('@GCFFront/Default/Actors/parlement.html.twig', array(
            'parlements' => $palement
        ));
    }

}