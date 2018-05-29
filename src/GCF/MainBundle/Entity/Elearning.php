<?php

namespace GCF\MainBundle\Entity;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Elearning
 *
 * @ORM\Table(name="elearning")
 * @ORM\Entity(repositoryClass="GCF\MainBundle\Repository\ElearningRepository")
 * @Gedmo\TranslationEntity(class="GCF\MainBundle\Entity\ElearningTranslation")
 */
class Elearning extends AbstractPersonalTranslatable implements TranslatableInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"} )
     * @ORM\JoinColumn(name="youtube", nullable=true)
     */
    private $youtube;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"} )
     * @ORM\JoinColumn(name="fichier", nullable=true)
     */
    private $fichier;
    
    /**
     * @ORM\ManyToOne(targetEntity="GCF\MainBundle\Entity\CatLearning", inversedBy="elearning")
     * @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     */
    private $catLearning;

    /**
     * @ORM\ManyToOne(targetEntity="GCF\MainBundle\Entity\EtatPub", inversedBy="elearning")
     * @ORM\JoinColumn(name="etat", referencedColumnName="id")
     */
    private $etatPub;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="GCF\MainBundle\Entity\ElearningTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;
    
    /**
     * @return mixed
     */
    public function getCatLearning()
    {
        return $this->catLearning;
    }

    /**
     * @param mixed $catLearning
     */
    public function setCatLearning($catLearning)
    {
        $this->catLearning = $catLearning;
    }

    /**
     * @return mixed
     */
    public function getEtatPub()
    {
        return $this->etatPub;
    }

    /**
     * @param mixed $etatPub
     */
    public function setEtatPub($etatPub)
    {
        $this->etatPub = $etatPub;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Elearning
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Elearning
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Elearning
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set fichier.
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media|null $fichier
     *
     * @return Elearning
     */
    public function setFichier(\Application\Sonata\MediaBundle\Entity\Media $fichier = null)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier.
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media|null
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set youtube.
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media|null $youtube
     *
     * @return Elearning
     */
    public function setYoutube(\Application\Sonata\MediaBundle\Entity\Media $youtube = null)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube.
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media|null
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Remove translation.
     *
     * @param \GCF\MainBundle\Entity\ElearningTranslation $translation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTranslation(\GCF\MainBundle\Entity\ElearningTranslation $translation)
    {
        return $this->translations->removeElement($translation);
    }
}
