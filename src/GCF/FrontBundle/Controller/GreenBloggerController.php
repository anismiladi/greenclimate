<?php
/**
 * Created by PhpStorm.
 * User: maroine
 * Date: 04/06/2018
 * Time: 11:00
 */

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GreenBloggerController extends Controller
{
    public function indexAction()
    {
        return $this->render('GCFFrontBundle:Default:green-blogger.html.twig');
    }
}