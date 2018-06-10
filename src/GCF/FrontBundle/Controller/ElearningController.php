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

        return $this->render('@GCFFront/Default/Elearning/e-learning.html.twig',array(
            'pageTitle' => $pageTitle
        ));
    }
}