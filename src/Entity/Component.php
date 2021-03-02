<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComponentRepository::class)
 */
class Component
{
    const AVAILABLE_TYPES = [
        'Cpu' => 'Processeur',
        'Ram' => 'Ram',
        'Processor' => 'Processeur',
        'Mother Board' => 'Carte Mère',
        'Hard drive' => 'Disque dur',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uptated_at;

    /**
     * @ORM\ManyToMany(targetEntity=Computers::class, mappedBy="Component")
     */
    private $computers;

    public function __construct()
    {
        $this->computers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getUptatedAt(): ?\DateTimeInterface
    {
        return $this->uptated_at;
    }

    public function setUptatedAt(\DateTimeInterface $uptated_at): self
    {
        $this->uptated_at = $uptated_at;

        return $this;
    }

    /**
     * @return Collection|Computers[]
     */
    public function getComputers(): Collection
    {
        return $this->computers;
    }

    public function addComputer(Computers $computer): self
    {
        if (!$this->computers->contains($computer)) {
            $this->computers[] = $computer;
            $computer->addComponent($this);
        }

        return $this;
    }

    public function removeComputer(Computers $computer): self
    {
        if ($this->computers->removeElement($computer)) {
            $computer->removeComponent($this);
        }

        return $this;
    }
}
