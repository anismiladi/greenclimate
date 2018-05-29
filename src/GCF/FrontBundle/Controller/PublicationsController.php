<?php


namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationsController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GCFFront/Default/Publications/publications.html.twig');
    }
}