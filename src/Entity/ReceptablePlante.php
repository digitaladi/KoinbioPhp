<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReceptablePlanteRepository")
 */
class ReceptablePlante
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matiere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $forme;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function getMatiere()
    {
        return $this->matiere;
    }

    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getForme()
    {
        return $this->forme;
    }

    public function setForme($forme)
    {
        $this->forme = $forme;

        return $this;
    }
}
