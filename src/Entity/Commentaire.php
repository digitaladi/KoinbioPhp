<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{




    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentaires")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ResponseCommentaire", mappedBy="id_commentaire")
     */
    private $responseCommentaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="commentaires")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fiche", inversedBy="commentaires")
     */
    private $fiche;

    public function __construct()
    {
        $this->responseCommentaires = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser( User $user)
    {
        $this->user = $user;

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

    /**
     * @return Collection|ResponseCommentaire[]
     */
    public function getResponseCommentaires()
    {
        return $this->responseCommentaires;
    }

    public function addResponseCommentaire(ResponseCommentaire $responseCommentaire)
    {
        if (!$this->responseCommentaires->contains($responseCommentaire)) {
            $this->responseCommentaires[] = $responseCommentaire;
            $responseCommentaire->setIdCommentaire($this);
        }

        return $this;
    }

    public function removeResponseCommentaire(ResponseCommentaire $responseCommentaire)
    {
        if ($this->responseCommentaires->contains($responseCommentaire)) {
            $this->responseCommentaires->removeElement($responseCommentaire);
            // set the owning side to null (unless already changed)
            if ($responseCommentaire->getIdCommentaire() === $this) {
                $responseCommentaire->setIdCommentaire(null);
            }
        }

        return $this;
    }

    public function getIdArticle()
    {
        return $this->article;
    }

    public function setIdArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

    public function getFicheId(): ?Fiche
    {
        return $this->fiche;
    }

    public function setFicheId(?Fiche $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }


    public function getFiche(): ?Fiche
    {
        return $this->fiche;
    }

    public function setFiche(?Fiche $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }
}
