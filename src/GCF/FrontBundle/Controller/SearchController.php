<?php


namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    public function searchAction(){
        return $this->render('@GCFFront/Default/search-result.html.twig');
    }
}