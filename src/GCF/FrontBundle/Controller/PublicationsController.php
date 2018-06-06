<?php


namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('GCFMainBundle:Publication')->findAll();

        return $this->render('@GCFFront/Default/Publications/publications.html.twig', array(
            'publications' => $publications
        ));
    }
}