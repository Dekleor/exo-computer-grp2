<?php

namespace App\Entity;

use App\Repository\DevicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DevicesRepository::class)
 */
class Devices
{
    const AVAILABLE_TYPES = [
        'Clavier' => 'keyboard',
        'Écran' => 'screen',
        'Enceintes' => 'speakers',
        'Souris' => 'mouse',
        'Webcam' => 'webcam',
        //'keyboard' => 'Clavier',
        //'screen' => 'Écran',
        //'speakers' => 'Enceintes',
        //'mouse' => 'Souris',
        //'webcam' => 'Webcam',
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $brand;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback="getTypes")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Computers::class, mappedBy="Devices")
     */
    private $Computers;

    public function __construct()
    {
        $this->Computers = new ArrayCollection();
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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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

    /**
     * @return Collection|Computers[]
     */
    public function getComputers(): Collection
    {
        return $this->Computers;
    }

    public function addComputers(Computers $computers): self
    {
        if (!$this->Computers->contains($computers)) {
            $this->Computers[] = $computers;
            $computers->addDevice($this);
        }

        return $this;
    }

    public function removeComputers(Computers $computers): self
    {
        if ($this->Computers->removeElement($computers)) {
            $computers->removeDevice($this);
        }

        return $this;
    }
    public function getTypes(): array
    {
        return self::AVAILABLE_TYPES;
    }
}
