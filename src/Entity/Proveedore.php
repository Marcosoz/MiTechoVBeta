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
 * Entity class for "proveedores" table
 */

#[Entity]
#[Table("proveedores", options: ["dbId" => "DB"])]
class Proveedore extends AbstractEntity
{
    #[Id]
    #[Column(name: "id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $Id;

    #[Column(name: "nombre", type: "string")]
    private string $Nombre;

    #[Column(name: "contacto", type: "string", nullable: true)]
    private ?string $Contacto;

    #[Column(name: "telefono", type: "string", nullable: true)]
    private ?string $Telefono;

    #[Column(name: "email", type: "string", nullable: true)]
    private ?string $Email;

    #[Column(name: "direccion", type: "text", nullable: true)]
    private ?string $Direccion;

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

    public function getContacto(): ?string
    {
        return HtmlDecode($this->Contacto);
    }

    public function setContacto(?string $value): static
    {
        $this->Contacto = RemoveXss($value);
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

    public function getDireccion(): ?string
    {
        return HtmlDecode($this->Direccion);
    }

    public function setDireccion(?string $value): static
    {
        $this->Direccion = RemoveXss($value);
        return $this;
    }
}
