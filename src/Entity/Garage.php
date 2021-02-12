<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 */
class Garage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $garageName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $garagePhone;

    /**
     * @ORM\ManyToOne(targetEntity=Professional::class, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professional;

    /**
     * @ORM\OneToMany(targetEntity=Vehicule::class, mappedBy="garage", orphanRemoval=true)
     */
    private $vehicules;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarageName(): ?string
    {
        return $this->garageName;
    }

    public function setGarageName(string $garageName): self
    {
        $this->garageName = $garageName;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getGaragePhone(): ?string
    {
        return $this->garagePhone;
    }

    public function setGaragePhone(string $garagePhone): self
    {
        $this->garagePhone = $garagePhone;

        return $this;
    }

    public function getProfessional(): ?Professional
    {
        return $this->professional;
    }

    public function setProfessional(?Professional $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    /**
     * @return Collection|Vehicule[]
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules[] = $vehicule;
            $vehicule->setGarage($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getGarage() === $this) {
                $vehicule->setGarage(null);
            }
        }

        return $this;
    }
}
