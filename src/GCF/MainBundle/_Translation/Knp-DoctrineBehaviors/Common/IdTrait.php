<?php

declare(strict_types=1);

namespace GCF\MainBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

trait IdTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
