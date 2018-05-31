<?php


namespace GCF\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gouvernorates = $em->getRepository('GCFMainBundle:Gouvernorat')->findAll();

        $organismes = $em->getRepository('GCFMainBundle:SecteurActeur')->findAll();
        $org = array();
        $projects = $em->getRepository('GCFMainBundle:Projet')->findAll();

        foreach ( $organismes as $organisme){

            if ( $organisme->getSecteurActeurParent() == Null )

                $org[] = $organisme;
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

        $projects = $em->getRepository('GCFMainBundle:Projet')->findAll();

        $result = array();

        foreach ($projects as $project) {


            /*gouvernorat**/
            foreach ($project->getGouvernorat() as $gouv) {
                $gouver = $gouv->getNom();
            }
            /*organisme**/
            $actors = $em->getRepository('GCFMainBundle:Acteur')->findBy(array(
                    'id' => $project->getActeur()
                )
            );


            $organi = array();
            foreach ($actors as $actor) {
                if ($actor->getSecteurActeur()->getSecteurActeurParent() != null) {
                    $organi = $actor->getSecteurActeur()->getSecteurActeurParent()->getNom();
                } else {
                    $organi = $actor->getSecteurActeur()->getNom();
                }
            }


            $sect = array();
            /*secteur**/
            $sect = $project->getSecteurProjet()->getNom();



            /*focus**/
            $foc = array();
            foreach ($project->getFocus() as $fo) {
                $foc[] = $fo->getNom();
            }



            if ( in_array($focus, $foc) && $secteur === $sect && $organisme === $organi && $gouvernorat === $gouver) {

                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );





            }elseif (in_array($focus, $foc) && $secteur !== $sect && $organisme !== $organi && $gouvernorat !== $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (!in_array($focus, $foc) && $secteur === $sect && $organisme !== $organi && $gouvernorat !== $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (!in_array($focus, $foc) && $secteur !== $sect && $organisme === $organi && $gouvernorat !== $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (!in_array($focus, $foc) && $secteur !== $sect && $organisme !== $organi && $gouvernorat === $gouver){
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );





            }elseif (in_array($focus, $foc) && $secteur === $sect && $organisme === $organi && $gouvernorat !== $gouver ) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (in_array($focus, $foc) && $secteur === $sect && $organisme !== $organi && $gouvernorat === $gouver ){
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (in_array($focus, $foc) && $secteur !== $sect && $organisme === $organi && $gouvernorat === $gouver ) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (!in_array($focus, $foc) && $secteur === $sect && $organisme === $organi && $gouvernorat === $gouver ) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (in_array($focus, $foc) && $secteur === $sect && $organisme !== $organi && $gouvernorat !== $gouver){
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (in_array($focus, $foc) && $secteur !== $sect && $organisme === $organi && $gouvernorat !== $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (!in_array($focus, $foc) && $secteur === $sect && $organisme === $organi && $gouvernorat !== $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (in_array($focus, $foc) && $secteur !== $sect && $organisme !== $organi && $gouvernorat === $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif (!in_array($focus, $foc) && $secteur === $sect && $organisme !== $organi && $gouvernorat === $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );
            }elseif(!in_array($focus, $foc) && $secteur !== $sect && $organisme === $organi && $gouvernorat === $gouver) {
                $result[] = array(
                    'id' => $project->getId(),
                    'nom' => $project->getNom(),
                    'gouvernorat' => $gouver,
                    'organisme' => $organi,
                    'secteur' => $sect,
                    'focus' => $foc
                );

            }

        }
        // dump($result);
        return new JsonResponse($result);



    }


    public function singleProjectAction($id){

        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('GCFMainBundle:Projet')->findOneBy(  array(
            'id' => $id
        ));

        return $this->render('@GCFFront/Default/Projects/single-projects.html.twig',array(
            'project' => $project
        ));
    }

}