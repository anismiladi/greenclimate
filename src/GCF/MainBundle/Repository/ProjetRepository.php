<?php

namespace GCF\MainBundle\Repository;

/**
 * ProjetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetRepository extends \Doctrine\ORM\EntityRepository
{
    public function findResultatBy($gouv, $org, $sectProj, $foc)
    {
        //$em = $this->getEntityManager();
        //$typejeu = $em->getRepository('TierceBundle:TypeJeu')->findOneByidEurotierce(27);
        $txtWhere = '(p.id > 0)';

        if($gouv)
        {
            if($txtWhere != ''){ $txtWhere .= ' AND '; }
            $txtWhere .= '( g.id = '.$gouv->getId().' )';
        }
        if($org)
        {
            if($txtWhere != ''){ $txtWhere .= ' AND '; }
            $txtWhere .= '( a.secteurActeur = '.$org->getId().' )';
        }
        if($sectProj)
        {
            if($txtWhere != ''){ $txtWhere .= ' AND '; }
            $txtWhere .= '( p.secteurProjet = '.$sectProj->getId().' )';
        }
        if($foc)
        {
            if($txtWhere != ''){ $txtWhere .= ' AND '; }
            $txtWhere .= '( f.id = '.$foc->getId().' )';
        }/**/
        $txtWhere .= '';
        //echo $txtWhere. "<br>";
<<<<<<< HEAD

=======
        
>>>>>>> Anis
        $projets = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('GCFMainBundle:Projet', 'p')
            ->leftJoin('p.gouvernorat', 'g')
            ->leftJoin('p.acteur', 'a')
            ->leftJoin('p.focus', 'f')
            ->Where($txtWhere)
            //->orderBy('p.nom', 'ASC')
            //->orderBy('a.Num', 'ASC')
            //->setParameter('course', $course->getId())
            //->setParameter('null', NULL)
            ->getQuery()
            ->getResult();
<<<<<<< HEAD

=======
        
>>>>>>> Anis
        return $projets;
    }
}
