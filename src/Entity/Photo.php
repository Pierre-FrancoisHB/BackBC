<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 *
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"display:vehicule"})
     */
    private $photoLink;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"display:vehicule"})
     */
    private $mainPhoto;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class, inversedBy="photos")
     */
    private $vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoLink(): ?string
    {
        return $this->photoLink;
    }

    public function setPhotoLink(?string $photoLink): self
    {
        $this->photoLink = $photoLink;

        return $this;
    }

    public function getMainPhoto(): ?bool
    {
        return $this->mainPhoto;
    }

    public function setMainPhoto(bool $mainPhoto): self
    {
        $this->mainPhoto = $mainPhoto;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}
