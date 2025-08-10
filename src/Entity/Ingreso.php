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
 * Entity class for "ingresos" table
 */

#[Entity]
#[Table("ingresos", options: ["dbId" => "DB"])]
class Ingreso extends AbstractEntity
{
    #[Id]
    #[Column(name: "id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $Id;

    #[Column(name: "socio_id", type: "integer")]
    private int $SocioId;

    #[Column(name: "tipo_ingreso", type: "string")]
    private string $TipoIngreso;

    #[Column(name: "descripcion", type: "text", nullable: true)]
    private ?string $Descripcion;

    #[Column(name: "monto", type: "decimal")]
    private string $Monto;

    #[Column(name: "fecha", type: "date")]
    private DateTime $Fecha;

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

    public function getSocioId(): int
    {
        return $this->SocioId;
    }

    public function setSocioId(int $value): static
    {
        $this->SocioId = $value;
        return $this;
    }

    public function getTipoIngreso(): string
    {
        return $this->TipoIngreso;
    }

    public function setTipoIngreso(string $value): static
    {
        if (!in_array($value, ["rifa", "beneficio", "trabajo", "cuota", "otros"])) {
            throw new \InvalidArgumentException("Invalid 'tipo_ingreso' value");
        }
        $this->TipoIngreso = $value;
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

    public function getFecha(): DateTime
    {
        return $this->Fecha;
    }

    public function setFecha(DateTime $value): static
    {
        $this->Fecha = $value;
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
