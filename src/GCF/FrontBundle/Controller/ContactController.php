<?php
/**
 * Created by PhpStorm.
 * User: maroine
 * Date: 06/06/2018
 * Time: 13:37
 */

namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{

    public function indexAction(Request $request){

        $pageTitle = 'Contactez-nous';


        //$routeName = $request->get('_route');
        $breadcrumbs = $this->get("white_october_breadcrumbs");

        // Simple example
        $breadcrumbs->addItem("Home", $this->get("router")->generate("gcf_front_homepage"));

        // Example without URL
        $breadcrumbs->addItem("contact");





    $bread = '';

    $bread .= '<ul id="crumbs">';
	/* get array containing each directory name in the path */
	$parts = explode("/", dirname($_SERVER['REQUEST_URI']));
    $bread .= '<li><a href="/">Home</a></li>';
	foreach ($parts as $key => $dir) {

		switch ($dir) {
			case "about": $label = "About Us"; break;
			/* if not in the exception list above,
			use the directory name, capitalized */
			default: $label = ucwords($dir); break;
		}

		/* start fresh, then add each directory back to the URL */
		$url = "";

		for ($i = 1; $i <= $key; $i++)
		{
			$url .= $parts[$i] ."/";
		}
		if ($dir != "")
        $bread .= '<li>> <a href="/'.$url.'">'.$label.'</a></li>';
	}
    $bread .= "</ul>";





        return $this->render('@GCFFront/Default/contact.html.twig',array(
            'pageTitle' => $pageTitle,
            'bread' => $bread
        ));
    }
}