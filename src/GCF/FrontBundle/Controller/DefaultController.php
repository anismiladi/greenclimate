<?php

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request ){


        return $this->render('@GCFFront/Default/index.html.twig');
    }


    public function yourAction( Request $request )
    {
        $url = $request->getRequestUri();

        $breadcrumbs = $this->get("white_october_breadcrumbs");

        $breadcrumbs->addNamespaceItem("maroine", "home", $url);

        // Simple example
        //$breadcrumbs->addItem("Home", $this->get("router")->generate("base.html.twig"));
    }

}