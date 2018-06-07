<?php


namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pageTitle = 'Publications';

        $publications = $em->getRepository('GCFMainBundle:Publication')->findAll();

        return $this->render('@GCFFront/Default/Publications/publications.html.twig', array(
            'pageTitle' => $pageTitle,
            'publications' => $publications
        ));
    }

    public function singlePublicationAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $publication = $em->getRepository('GCFMainBundle:Publication')->find($id);

        $pageTitle = $publication->getTitre();


        return $this->render('@GCFFront/Default/Publications/single-publication.html.twig', array(
            'pageTitle' => $pageTitle,
            'publication' => $publication
        ));
    }
}