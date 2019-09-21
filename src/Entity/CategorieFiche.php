<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieFicheRepository")
 */
class CategorieFiche
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Fiche", mappedBy="categorieFiche")
     */
    private $fiches;




    public function __construct()
    {
        $this->fiches = new ArrayCollection();
    }

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

    /**
     * @return Collection|Fiche[]
     */
    public function getFiches()
    {
        return $this->fiches;
    }

    public function addFich(Fiche $fich)
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setCategorieFiche($this);
        }

        return $this;
    }

    public function removeFich(Fiche $fich)
    {
        if ($this->fiches->contains($fich)) {
            $this->fiches->removeElement($fich);
            // set the owning side to null (unless already changed)
            if ($fich->getCategorieFiche() === $this) {
                $fich->setCategorieFiche(null);
            }
        }

        return $this;
    }
}
