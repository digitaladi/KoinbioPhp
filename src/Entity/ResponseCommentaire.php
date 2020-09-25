<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponseCommentaireRepository")
 */
class ResponseCommentaire
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
    private $response;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commentaire", inversedBy="responseCommentaires")
     */
    private $commentaire;

    public function getId()
    {
        return $this->id;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
