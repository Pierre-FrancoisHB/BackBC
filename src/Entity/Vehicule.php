<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 * @ApiResource(
 *      attributes={
 *          "order"={"createdAt":"DESC"},
 *          },
 *      paginationItemsPerPage=7,
 *      normalizationContext={"groups"={"display:vehicule"}}
 * )
 */

class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"display:vehicule"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"display:vehicule"})
     */
    private $referenceAd;

    /**
     * @ORM\Column(type="text")
     * @Groups({"display:vehicule"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"display:vehicule"})
     */
    private $kilometer;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"display:vehicule"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"display:vehicule"})
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="vehicule")
     * @Groups({"display:vehicule"})
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="vehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garage;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="vehicules")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"display:vehicule"})
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Energy::class, inversedBy="vehicules")
     * @Groups({"display:vehicule"})
     */
    private $energy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceAd(): ?string
    {
        return $this->referenceAd;
    }

    public function setReferenceAd(string $referenceAd): self
    {
        $this->referenceAd = $referenceAd;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKilometer(): ?int
    {
        return $this->kilometer;
    }

    public function setKilometer(int $kilometer): self
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setVehicule($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getVehicule() === $this) {
                $photo->setVehicule(null);
            }
        }

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getEnergy(): ?Energy
    {
        return $this->energy;
    }

    public function setEnergy(?Energy $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
