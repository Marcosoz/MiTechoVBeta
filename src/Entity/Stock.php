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
 * Entity class for "stock" table
 */

#[Entity]
#[Table("stock", options: ["dbId" => "DB"])]
class Stock extends AbstractEntity
{
    #[Id]
    #[Column(name: "id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $Id;

    #[Column(name: "nombre_material", type: "string")]
    private string $NombreMaterial;

    #[Column(name: "unidad", type: "string", nullable: true)]
    private ?string $Unidad;

    #[Column(name: "cantidad", type: "decimal", nullable: true)]
    private ?string $Cantidad;

    #[Column(name: "descripcion", type: "text", nullable: true)]
    private ?string $Descripcion;

    public function __construct()
    {
        $this->Cantidad = "0.00";
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

    public function getNombreMaterial(): string
    {
        return HtmlDecode($this->NombreMaterial);
    }

    public function setNombreMaterial(string $value): static
    {
        $this->NombreMaterial = RemoveXss($value);
        return $this;
    }

    public function getUnidad(): ?string
    {
        return HtmlDecode($this->Unidad);
    }

    public function setUnidad(?string $value): static
    {
        $this->Unidad = RemoveXss($value);
        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->Cantidad;
    }

    public function setCantidad(?string $value): static
    {
        $this->Cantidad = $value;
        return $this;
    }

    public function getDescripcion(): ?string
    {
        return HtmlDecode($this->Descripcion);
    }

    public function setDescripcion(?string $value): static
    {
        $this->Descripcion = RemoveXss($value);
        return $this;
    }
}
