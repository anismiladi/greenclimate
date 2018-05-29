<?php
// src/Admin/CategoryAdmin.php
namespace GCF\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\TranslationBundle\Filter\TranslationFieldFilter;
use Sonata\AdminBundle\Form\Type\ModelType;


class SecteurProjetAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('logo', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'default'
            ))
            ->add('secteurProjetParent','sonata_type_model_autocomplete',
                array(
                    'required' => false,
                    'multiple' => false,
                    'property' => 'nom',
                    'to_string_callback' => function($enitity, $property) {
                        return $enitity->getNom();
                    },
                )
            );
        //->add('translations', TranslationsType::class)
        //        ->add('nom');
    }

    /**/protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nom', TranslationFieldFilter::class);
    }

    /**/protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('nom', TranslationFieldList::class)
            // You may also specify the actions you want to be displayed in the list
            ->add('_action', 'actions', array(
                    'actions' => array(
                //    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }
}