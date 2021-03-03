<?php

namespace App\Entity;

use App\Repository\ComputersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ComputersRepository::class)
 */
class Computers
{
    const AVAILABLE_TYPES =[
        'Desktop' => 'Ordinateur de bureau',
        'Laptop' => 'Ordinateur Portable',
        'tablet' => 'Tablette',
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
     * @ORM\Column(type="text")
     */
    private $description;

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
     * @ORM\ManyToMany(targetEntity=Devices::class, inversedBy="computers")
     */
    private $Devices;

    /**
     * @ORM\ManyToMany(targetEntity=Component::class, inversedBy="computers")
     */
    private $Component;

    public function __construct()
    {
        $this->Devices = new ArrayCollection();
        $this->Component = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getTypes(): array
    {
        return self::AVAILABLE_TYPES;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Devices[]
     */
    public function getDevices(): Collection
    {
        return $this->Devices;
    }

    public function addDevice(Devices $device): self
    {
        if (!$this->Devices->contains($device)) {
            $this->Devices[] = $device;
        }

        return $this;
    }

    public function removeDevice(Devices $device): self
    {
        $this->Devices->removeElement($device);

        return $this;
    }

    /**
     * @return Collection|Component[]
     */
    public function getComponent(): Collection
    {
        return $this->Component;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->Component->contains($component)) {
            $this->Component[] = $component;
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        $this->Component->removeElement($component);

        return $this;
    }
}
