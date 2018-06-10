<?php


namespace GCF\FrontBundle\Controller;


use GCF\MainBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PublicationsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pageTitle = 'Publications';

        $publications = $em->getRepository('GCFMainBundle:Publication')->findBy(
            array(),
            array('id' => 'desc')
        );

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


    public function saveGbPostAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //get data posted
        $datas = $request->request;

        $response = array();

        foreach ($datas as $key =>$data){
            $response[$key] = $data;
        }


        //save data
        $publication  = new Publication();
        $publication->setTitre($response['gb_article_title']);
        $publication->setContenu($response['gb_article_content']);
        //$publication->setProjet($response['gb_article_project']);

        $publication->setEmailBloggeur($response['gb_email']);
//        $publication->setNameBloggeur($response['gb_name']);
//        $publication->setCategory('GreenBlogger');
//        $publication->setEtatPub();


        $em->persist($publication);

        $em->flush();

        return new JsonResponse($response);
    }

    public function popupAction()
    {
        return $this->render('@GCFFront/Default/blocks/gb-popoup.html.twig');
    }
}