<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $corp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_actif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="article")
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieArticle")
     */
    private $categorieArticle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $source;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre(string $titre)
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCorp()
    {
        return $this->corp;
    }

    public function setCorp($corp)
    {
        $this->corp = $corp;

        return $this;
    }

    public function getIsActif()
    {
        return $this->is_actif;
    }

    public function setIsActif($is_actif)
    {
        $this->is_actif = $is_actif;

        return $this;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire)
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire)
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdArticle() === $this) {
                $commentaire->setIdArticle(null);
            }
        }

        return $this;
    }

    public function getCategorieArticle()
    {
        return $this->categorieArticle;
    }

    public function setCategorieArticle(CategorieArticle $categorieArticle)
    {
        $this->categorieArticle = $categorieArticle;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
