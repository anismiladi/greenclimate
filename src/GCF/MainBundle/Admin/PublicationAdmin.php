<?php

namespace GCF\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\TranslationBundle\Filter\TranslationFieldFilter;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

class PublicationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titre')
            ->add('contenu')
            /**/
            ->add('projet','sonata_type_model_autocomplete',
                array(
                    'required' => false,
                    'multiple' => false,
                    'minimum_input_length' => 1,
                    'property' => 'nom',
                    'to_string_callback' => function($enitity, $property) {
                        return $enitity->getNom();
                    },
                )
            )
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('titre', TranslationFieldFilter::class);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('titre', TranslationFieldList::class)
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