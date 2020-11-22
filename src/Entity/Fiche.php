<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//use Vich\UploaderBundle\Entity\File;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheRepository")
 *  @Vich\Uploadable
 */
class Fiche implements \Serializable
{



    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="fiches", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plant_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plant_scientist_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origin;







    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $exposed_temperature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $arrosage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $relative_humidity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $saison_floraison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ground;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $servicing;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insolation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_semis;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_medicinale;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conseil;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePlantes", inversedBy="fiches")
     */
    private $typePlante;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ReceptablePlante", cascade={"persist", "remove"})
     */
    private $receptablePlante;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieFiche", inversedBy="fiches")
     */
    private $categorieFiche;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="fiche",cascade={"persist", "remove"})
     */
    private $commentaires;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateBirthOrBuy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $poid;



    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_actif;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDeath;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reasonDeath;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $WhyFiche;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bienfaits;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fiches")
     */
    private $user;





    public function __construct()
    {

        $this->commentaires = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPlantName()
    {
        return $this->plant_name;
    }

    public function setPlantName($plant_name)
    {
        $this->plant_name = $plant_name;

        return $this;
    }

    public function getPlantScientistName()
    {
        return $this->plant_scientist_name;
    }

    public function setPlantScientistName( $plant_scientist_name)
    {
        $this->plant_scientist_name = $plant_scientist_name;

        return $this;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }







    public function getExposedTemperature()
    {
        return $this->exposed_temperature;
    }

    public function setExposedTemperature( $exposed_temperature)
    {
        $this->exposed_temperature = $exposed_temperature;

        return $this;
    }
    public function getArrosage()
    {
        return $this->arrosage;
    }

    public function setArrosage($arrosage)
    {
        $this->arrosage = $arrosage;

        return $this;
    }

    public function getRelativeHumidity()
    {
        return $this->relative_humidity;
    }

    public function setRelativeHumidity($relative_humidity)
    {
        $this->relative_humidity = $relative_humidity;

        return $this;
    }

    public function getEmplacement()
    {
        return $this->emplacement;
    }

    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getDescriptif()
    {
        return $this->descriptif;
    }

    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getSaisonFloraison()
    {
        return $this->saison_floraison;
    }

    public function setSaisonFloraison($saison_floraison)
    {
        $this->saison_floraison = $saison_floraison;

        return $this;
    }

    public function getGround()
    {
        return $this->ground;
    }

    public function setGround($ground)
    {
        $this->ground = $ground;

        return $this;
    }

    public function getServicing()
    {
        return $this->servicing;
    }

    public function setServicing($servicing)
    {
        $this->servicing = $servicing;

        return $this;
    }

    public function getInsolation()
    {
        return $this->insolation;
    }

    public function setInsolation($insolation)
    {
        $this->insolation = $insolation;

        return $this;
    }

    public function getIsSemis()
    {
        return $this->is_semis;
    }

    public function setIsSemis($is_semis)
    {
        $this->is_semis = $is_semis;

        return $this;
    }

    public function getIsMedicinale()
    {
        return $this->is_medicinale;
    }

    public function setIsMedicinale($is_medicinale)
    {
        $this->is_medicinale = $is_medicinale;

        return $this;
    }

    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at)
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getConseil()
    {
        return $this->conseil;
    }

    public function setConseil($conseil)
    {
        $this->conseil = $conseil;

        return $this;
    }



    public function getTypePlante()
    {
        return $this->typePlante;
    }

    public function setTypePlante($typePlante)
    {
        $this->typePlante = $typePlante;

        return $this;
    }

    public function getReceptablePlante()
    {
        return $this->receptablePlante;
    }

    public function setReceptablePlante($receptablePlante)
    {
        $this->receptablePlante = $receptablePlante;

        return $this;
    }

    public function getCategorieFiche()
    {
        return $this->categorieFiche;
    }

    public function setCategorieFiche($categorieFiche)
    {
        $this->categorieFiche = $categorieFiche;

        return $this;
    }



    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire)
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setFiche($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire)
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFiche() === $this) {
                $commentaire->setFiche(null);
            }
        }

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }


    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(?int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getDateBirthOrBuy(): ?\DateTimeInterface
    {
        return $this->dateBirthOrBuy;
    }

    public function setDateBirthOrBuy(\DateTimeInterface $dateBirthOrBuy): self
    {
        $this->dateBirthOrBuy = $dateBirthOrBuy;

        return $this;
    }

    public function getPoid(): ?int
    {
        return $this->poid;
    }

    public function setPoid(?int $poid): self
    {
        $this->poid = $poid;

        return $this;
    }



    public function getIsActif(): ?bool
    {
        return $this->is_actif;
    }

    public function setIsActif(?bool $is_actif): self
    {
        $this->is_actif = $is_actif;

        return $this;
    }

    public function getDateDeath(): ?\DateTimeInterface
    {
        return $this->dateDeath;
    }

    public function setDateDeath(?\DateTimeInterface $dateDeath): self
    {
        $this->dateDeath = $dateDeath;

        return $this;
    }

    public function getReasonDeath(): ?string
    {
        return $this->reasonDeath;
    }

    public function setReasonDeath(?string $reasonDeath): self
    {
        $this->reasonDeath = $reasonDeath;

        return $this;
    }

    public function getWhyFiche(): ?string
    {
        return $this->WhyFiche;
    }

    public function setWhyFiche(?string $WhyFiche): self
    {
        $this->WhyFiche = $WhyFiche;

        return $this;
    }

    public function getBienfaits(): ?string
    {
        return $this->bienfaits;
    }

    public function setBienfaits(?string $bienfaits): self
    {
        $this->bienfaits = $bienfaits;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
