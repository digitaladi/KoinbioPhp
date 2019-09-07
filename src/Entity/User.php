<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(type="string", length=180, unique=true)
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
     * @ORM\Column(type="integer")
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
        return (string) $this->email;
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
}
