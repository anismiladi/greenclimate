<?php
/**
 * Created by PhpStorm.
 * User: maroine
 * Date: 04/06/2018
 * Time: 11:00
 */

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GreenBloggerController extends Controller
{
    public function indexAction(Request $request)
    {
        $pageTitle = 'Green Blogger';

        dump($request->getPathInfo());
        die();

        return $this->render('GCFFrontBundle:Default:green-blogger.html.twig',array(
            'pageTitle' => $pageTitle
        ));
    }
}