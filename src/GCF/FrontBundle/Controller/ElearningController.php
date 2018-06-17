<?php
/**
 * Created by PhpStorm.
 * User: maroine
 * Date: 08/05/2018
 * Time: 11:22
 */

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ElearningController extends Controller
{
    public function indexAction()
    {
        $pageTitle = 'E-learning';
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Simple example
        $breadcrumbs->addItem("Accueil", $this->get("router")->generate("gcf_front_homepage"));
        // Simple example
        $breadcrumbs->addItem("E-learning");

        $em = $this->getDoctrine()->getManager();

        $elearningTechArticles = $em->getRepository('GCFMainBundle:Elearning')->findBy(array(
            'catLearning' => '1' //id de technique
        ));

        $elearningLegisArticles = $em->getRepository('GCFMainBundle:Elearning')->findBy(array(
            'catLearning' => '2' //id de legislative
        ));

        return $this->render('@GCFFront/Default/Elearning/e-learning.html.twig',array(
            'pageTitle' => $pageTitle,
            'elearningTechArticles' => $elearningTechArticles,
            'elearningLegisArticles' => $elearningLegisArticles
        ));
    }
}