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

class ProjetAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('description')
            /**/
            ->add('focus','sonata_type_model_autocomplete',
                array(
                    'required' => false,
                    'multiple' => true,
                    'minimum_input_length' => 1,
                    'property' => 'nom',
                    'to_string_callback' => function($enitity, $property) {
                        return $enitity->getNom();
                    },
                )
            )
            ->add('fichier', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.file',
                'context'  => 'default',
            ))
            ->add('secteurProjet','sonata_type_model_autocomplete',
                array(
                    'required' => true,
                    'multiple' => false,
                    'minimum_input_length' => 1,
                    'property' => 'nom',
                    'to_string_callback' => function($enitity, $property) {
                        return $enitity->getNom();
                    }
                )
            )
                       
            ->add('acteur','sonata_type_model_autocomplete',
                array(
                    'required' => false,
                    'multiple' => false,
                    'minimum_input_length' => 1,
                    'property' => 'nom',
                    'to_string_callback' => function($enitity, $property) {
                        return $enitity->getNom();
                    }
                )
            )

            /*
            ->add('gouvernorat', 'sonata_type_model', array(
                'multiple' => true, 
                'expanded' => true
                ))
            */
            ->add('gouvernorat','sonata_type_model_autocomplete',
                array(
                    'required' => false,
                    'multiple' => true,
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
        $datagridMapper->add('nom', TranslationFieldFilter::class);
    }

    protected function configureListFields(ListMapper $listMapper)
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