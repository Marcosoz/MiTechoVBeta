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
 * Entity class for "socios" table
 */

#[Entity]
#[Table("socios", options: ["dbId" => "DB"])]
class Socio extends AbstractEntity
{
    #[Id]
    #[Column(name: "id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $Id;

    #[Column(name: "cooperativa_id", type: "integer")]
    private int $CooperativaId;

    #[Column(name: "nombre_completo", type: "string")]
    private string $NombreCompleto;

    #[Column(name: "cedula", type: "string", nullable: true)]
    private ?string $Cedula;

    #[Column(name: "telefono", type: "string", nullable: true)]
    private ?string $Telefono;

    #[Column(name: "email", type: "string", nullable: true)]
    private ?string $Email;

    #[Column(name: "fecha_ingreso", type: "date", nullable: true)]
    private ?DateTime $FechaIngreso;

    #[Column(name: "activo", type: "boolean", nullable: true)]
    private ?bool $Activo;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $CreatedAt;

    public function __construct()
    {
        $this->Activo = true;
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function setId(int $value): static
    {
        $this->Id = $value;
        return $this;
    }

    public function getCooperativaId(): int
    {
        return $this->CooperativaId;
    }

    public function setCooperativaId(int $value): static
    {
        $this->CooperativaId = $value;
        return $this;
    }

    public function getNombreCompleto(): string
    {
        return HtmlDecode($this->NombreCompleto);
    }

    public function setNombreCompleto(string $value): static
    {
        $this->NombreCompleto = RemoveXss($value);
        return $this;
    }

    public function getCedula(): ?string
    {
        return HtmlDecode($this->Cedula);
    }

    public function setCedula(?string $value): static
    {
        $this->Cedula = RemoveXss($value);
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

    public function getFechaIngreso(): ?DateTime
    {
        return $this->FechaIngreso;
    }

    public function setFechaIngreso(?DateTime $value): static
    {
        $this->FechaIngreso = $value;
        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->Activo;
    }

    public function setActivo(?bool $value): static
    {
        $this->Activo = $value;
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
