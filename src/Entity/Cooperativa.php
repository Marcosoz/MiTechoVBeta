<?php

namespace PHPMaker2025\project1\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2025\project1\AdvancedUserInterface;
use PHPMaker2025\project1\AbstractEntity;
use PHPMaker2025\project1\AdvancedSecurity;
use PHPMaker2025\project1\UserProfile;
use PHPMaker2025\project1\UserRepository;
use function PHPMaker2025\project1\Config;
use function PHPMaker2025\project1\EntityManager;
use function PHPMaker2025\project1\RemoveXss;
use function PHPMaker2025\project1\HtmlDecode;
use function PHPMaker2025\project1\HashPassword;
use function PHPMaker2025\project1\Security;

/**
 * Entity class for "cooperativas" table
 */

#[Entity]
#[Table("cooperativas", options: ["dbId" => "DB"])]
class Cooperativa extends AbstractEntity
{
    #[Id]
    #[Column(name: "id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $Id;

    #[Column(name: "nombre", type: "string")]
    private string $Nombre;

    #[Column(name: "departamento", type: "string")]
    private string $Departamento;

    #[Column(name: "ciudad", type: "string")]
    private string $Ciudad;

    #[Column(name: "direccion", type: "string", nullable: true)]
    private ?string $Direccion;

    #[Column(name: "telefono", type: "string", nullable: true)]
    private ?string $Telefono;

    #[Column(name: "email", type: "string", nullable: true)]
    private ?string $Email;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $CreatedAt;

    public function getId(): int
    {
        return $this->Id;
    }

    public function setId(int $value): static
    {
        $this->Id = $value;
        return $this;
    }

    public function getNombre(): string
    {
        return HtmlDecode($this->Nombre);
    }

    public function setNombre(string $value): static
    {
        $this->Nombre = RemoveXss($value);
        return $this;
    }

    public function getDepartamento(): string
    {
        return HtmlDecode($this->Departamento);
    }

    public function setDepartamento(string $value): static
    {
        $this->Departamento = RemoveXss($value);
        return $this;
    }

    public function getCiudad(): string
    {
        return HtmlDecode($this->Ciudad);
    }

    public function setCiudad(string $value): static
    {
        $this->Ciudad = RemoveXss($value);
        return $this;
    }

    public function getDireccion(): ?string
    {
        return HtmlDecode($this->Direccion);
    }

    public function setDireccion(?string $value): static
    {
        $this->Direccion = RemoveXss($value);
        return $this;
    }

    public function getTelefono(): ?string
    {
        return HtmlDecode($this->Telefono);
    }

    public function setTelefono(?string $value): static
    {
        $this->Telefono = RemoveXss($value);
        return $this;
    }

    public function getEmail(): ?string
    {
        return HtmlDecode($this->Email);
    }

    public function setEmail(?string $value): static
    {
        $this->Email = RemoveXss($value);
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?DateTime $value): static
    {
        $this->CreatedAt = $value;
        return $this;
    }
}
