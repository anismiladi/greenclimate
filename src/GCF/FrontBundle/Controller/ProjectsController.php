<?php


namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use GCF\MainBundle\Entity\Acteur;
use GCF\MainBundle\Entity\Gouvernorat;
use GCF\MainBundle\Entity\Focus;
use GCF\MainBundle\Entity\SecteurActeur;
use GCF\MainBundle\Entity\SecteurProjet;

class ProjectsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gouvernorates = $em->getRepository('GCFMainBundle:Gouvernorat')->findAll();

        $organismes = $em->getRepository('GCFMainBundle:SecteurActeur')->findAll();

        $projects = $em->getRepository('GCFMainBundle:Projet')->findAll();

        foreach ( $organismes as $organisme){
            if ( $organisme->getSecteurActeurParent() == Null )
            {
                $org[] = $organisme;
            }
        }

        $secteurs = $em->getRepository('GCFMainBundle:SecteurProjet')->findAll();

        $focus = $em->getRepository('GCFMainBundle:Focus')->findAll();

        return $this->render('@GCFFront/Default/Projects/projects.html.twig',array(
            'gouvernorates' => $gouvernorates,
            'organismes' => $org,
            'secteurs' => $secteurs,
            'focuss' => $focus,
            'projects' => $projects

        ));
    }



    public function resutAction($gouvernorat, $organisme, $secteur, $focus)
    {
        $em = $this->getDoctrine()->getManager();

        $gouv = $em->getRepository('GCFMainBundle:Gouvernorat')->findOneByNom($gouvernorat);
        $org = $em->getRepository('GCFMainBundle:SecteurActeur')->findOneByNom($organisme);
        $sectProj = $em->getRepository('GCFMainBundle:SecteurProjet')->findOneByNom($secteur);
        $foc = $em->getRepository('GCFMainBundle:Focus')->findOneByNom($focus);
        
        //echo "$gouv"."<br>";
        //echo "$org"."<br>";
        //echo "$sectProj"."<br>";
        //echo "$foc"."<br>";
        
        $result = array();
        $projects = $em->getRepository('GCFMainBundle:Projet')->findResultatBy($gouv, $org, $sectProj, $foc);

        foreach ($projects as $project) {

            $gouver = '';
            foreach ($project->getGouvernorat() as $gov) {
                $gouver = $gov->getNom().', ';
            }
            $gouver = substr($gouver, 0, -2);

            /*organisme**/
            $organi = $project->getActeur()->getSecteurActeur()->getNom();
            
            $sect = $project->getSecteurProjet()->getNom();

            /*focus**/
            $foc = '';
            foreach ($project->getFocus() as $fo) {
                $foc = $fo->getNom().', ';
            }
            $foc = substr($foc, 0, -2);

            $result[] = array(
                'id' => $project->getId(),
                'nom' => $project->getNom(),
                'gouvernorat' => $gouver,
                'organisme' => $organi,
                'secteur' => $sect,
                'focus' => $foc
            );
        }
        // dump($result);
        return new JsonResponse($result);



    }


    public function singleProjectAction($projectName){

        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('GCFMainBundle:Projet')->findOneBy(  array(
            'nom' => $projectName
        ));

        return $this->render('@GCFFront/Default/Projects/resutl-projects.html.twig',array(
            'project' => $project
        ));
    }

}