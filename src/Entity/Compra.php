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
 * Entity class for "compras" table
 */

#[Entity]
#[Table("compras", options: ["dbId" => "DB"])]
class Compra extends AbstractEntity
{
    #[Id]
    #[Column(name: "id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $Id;

    #[Column(name: "proveedor_id", type: "integer")]
    private int $ProveedorId;

    #[Column(name: "fecha", type: "date")]
    private DateTime $Fecha;

    #[Column(name: "descripcion", type: "text", nullable: true)]
    private ?string $Descripcion;

    #[Column(name: "monto", type: "decimal")]
    private string $Monto;

    #[Column(name: "saldo_pendiente", type: "decimal", nullable: true)]
    private ?string $SaldoPendiente;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $CreatedAt;

    public function __construct()
    {
        $this->SaldoPendiente = "0.00";
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

    public function getProveedorId(): int
    {
        return $this->ProveedorId;
    }

    public function setProveedorId(int $value): static
    {
        $this->ProveedorId = $value;
        return $this;
    }

    public function getFecha(): DateTime
    {
        return $this->Fecha;
    }

    public function setFecha(DateTime $value): static
    {
        $this->Fecha = $value;
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

    public function getMonto(): string
    {
        return $this->Monto;
    }

    public function setMonto(string $value): static
    {
        $this->Monto = $value;
        return $this;
    }

    public function getSaldoPendiente(): ?string
    {
        return $this->SaldoPendiente;
    }

    public function setSaldoPendiente(?string $value): static
    {
        $this->SaldoPendiente = $value;
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
