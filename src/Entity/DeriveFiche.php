<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeriveFicheRepository")
 */
class DeriveFiche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fiche")
     */
    private $fiche;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $preparation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFiche(): ?Fiche
    {
        return $this->fiche;
    }

    public function setFiche(?Fiche $ifiche): self
    {
        $this->id_fiche = $fiche;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(?string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }
}
