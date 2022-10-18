<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PowerRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PowerRepository::class)
 * @UniqueEntity(
 *     fields={"name"},
 *     errorPath="name",
 *     message="This name already exists."
 * )
 * @UniqueEntity(
 *     fields={"code"},
 *     errorPath="code",
 *     message="This code already exists."
 * )
 */
class Power
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
