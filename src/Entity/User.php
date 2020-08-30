<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */

/**
 * @ORM\Entity
 * @UniqueEntity("username")
 */

class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    //confirmation de mot de passe
    public  $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $street_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commune;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="user_id")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fiche", inversedBy="users")
     */
    private $fiche;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;









    public function __construct()
    {

        $this->commentaires = new ArrayCollection();
        $this->id_fiche = new ArrayCollection();
        $this->fiche = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername()
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */

    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return (string) $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getStreetNumber()
    {
        return $this->street_number;
    }

    public function setStreetNumber($street_number)
    {
        $this->street_number = $street_number;

        return $this;
    }

    public function getStreetType()
    {
        return $this->street_type;
    }

    public function setStreetType($street_type)
    {
        $this->street_type = $street_type;

        return $this;
    }

    public function getStreetName()
    {
        return $this->street_name;
    }

    public function setStreetName( $street_name)
    {
        $this->street_name = $street_name;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function setPostalCode( $postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCommune()
    {
        return $this->commune;
    }

    public function setCommune($commune)
    {
        $this->commune = $commune;

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
            $commentaire->setUserId($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire)
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getUserId() === $this) {
                $commentaire->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fiche[]
     */
    public function getFiche()
    {
        return $this->fiche;
    }

    public function addFiche(Fiche $fiche)
    {
        if (!$this->fiche->contains($fiche)) {
            $this->fiche[] = $fiche;
        }

        return $this;
    }

    public function removeFiche(Fiche $fiche)
    {
        if ($this->fiche->contains($fiche)) {
            $this->fiche->removeElement($fiche);
        }

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }








}
