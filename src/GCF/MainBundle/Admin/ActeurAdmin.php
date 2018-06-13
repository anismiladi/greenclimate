<?php

namespace GCF\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\TranslationBundle\Filter\TranslationFieldFilter;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;


class ActeurAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Gestion les Acteurs ', ['class' => 'col-md-8'])
                ->add('logo', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'default'
                ))
                ->add('nom')
                ->add('nomcomplet')
                ->add('description')
                ->add('hierarchie')
                ->add('mission')
                ->add('contact')
                /*->add('adresse', SimpleFormatterType::class, [
                    'format' => 'markdown',
                    'ckeditor_context' => 'default'])*/
                ->add('tel')
                ->add('fax')
                ->add('siteweb')            
                ->add('acteurParent','sonata_type_model_autocomplete',
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
                ->add('secteurActeur', ModelType::class, [
                    'attr' => [
                        'data-sonata-select2' => 'true'
                    ]
                ])
            ->end()


                
            ->with('Responsable accès à l\'information', ['class' => 'col-md-4'])
                ->add('responsable', 'text', array('label' => "Nom")) 
                ->add('telresponsable', 'text', array('label' => "Téléphone"))
                ->add('emailresponsable', 'text', array('label' => "Email"))
            ->end();
//->add('critique')

            
            /*  
            ->add('secteurActeur','sonata_type_model_autocomplete',
                array(
                    'required' => false,
                    'multiple' => false,
                    'property' => 'nom',
                    'to_string_callback' => function($enitity, $property) {
                        return $enitity->getNom();
                    },
                )
            )
        
             */


            /*
            ->add('secteurActeur', ModelType::class, [
                'attr' => [
                    'data-sonata-select2' => 'true'
                ]
            ])*/
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

    public function prePersist($page)
    {
        $this->manageEmbeddedImageAdmins($page);
    }

    public function preUpdate($page)
    {
        $this->manageEmbeddedImageAdmins($page);
    }

    private function manageEmbeddedImageAdmins($page)
    {
        // Cycle through each field
        foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {
            // detect embedded Admins that manage Images
            if ($fieldDescription->getType() === 'sonata_type_admin' &&
                ($associationMapping = $fieldDescription->getAssociationMapping()) &&
                $associationMapping['targetEntity'] === 'GCF\MainBundle\Entity\Image'
            ) {
                $getter = 'get'.$fieldName;
                $setter = 'set'.$fieldName;

                /** @var Image $image */
                $image = $page->$getter();

                if ($image) {
                    if ($image->getFile()) {
                        // update the Image to trigger file management
                        $image->refreshUpdated();
                    } elseif (!$image->getFile() && !$image->getFilename()) {
                        // prevent Sf/Sonata trying to create and persist an empty Image
                        $page->$setter(null);
                    }
                }
            }
        }
    }
}