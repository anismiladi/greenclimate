<?php
/**
 * Created by PhpStorm.
 * User: maroine
 * Date: 12/06/2018
 * Time: 15:18
 */

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function eventIndexAction(){

        $pageTitle = 'Evenemet';

        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('GCFMainBundle:Event')->findBy(
            array(),
            array('id'=> 'desc')
        );

        return $this->render('@GCFFront/Default/Event/eventIndex.html.twig',array(
            'pageTitle' => $pageTitle,
            'evenements' => $evenements

        ));
    }

}