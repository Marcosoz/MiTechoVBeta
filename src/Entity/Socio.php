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
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
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

#[Entity(repositoryClass: UserRepository::class)]
#[Table("socios", options: ["dbId" => "DB"])]
class Socio extends AbstractEntity implements AdvancedUserInterface, EquatableInterface, PasswordAuthenticatedUserInterface
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

    #[Column(name: "`contraseña`", options: ["name" => "contraseña"], type: "string")]
    private string $Contraseña;

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
        return $this->Cedula;
    }

    public function setCedula(?string $value): static
    {
        $this->Cedula = $value;
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

    public function getContraseña(): string
    {
        return HtmlDecode($this->Contraseña);
    }

    public function setContraseña(string $value): static
    {
        $this->Contraseña = RemoveXss($value);
        return $this;
    }

    /**
     * Get user name
     *
     * @return string
     */
    public function userName(): string
    {
        return $this->get('cedula');
    }

    /**
     * Get user ID
     *
     * @return mixed
     */
    public function userId(): mixed
    {
        return null;
    }

    /**
     * Get parent user ID
     *
     * @return mixed
     */
    public function parentUserId(): mixed
    {
        return null;
    }

    /**
     * Get user level
     *
     * @return int|string
     */
    public function userLevel(): int|string
    {
        return $this->get('cedula') ?? AdvancedSecurity::ANONYMOUS_USER_LEVEL_ID;
    }

    /**
     * Roles
     */
    protected array $roles = ['ROLE_USER'];

    /**
     * Get the roles granted to the user, e.g. ['ROLE_USER']
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        $userLevelId = $this->get('cedula');
        $roles = Security()->getAllRoles($userLevelId);
        return array_unique([...$this->roles, ...$roles]);
    }

    /**
     * Add a role
     *
     * @param string $role Role
     * @return void
     */
    public function addRole(string $role): void
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }
    }

    /**
     * Remove a role
     *
     * @param string $role Role
     * @return void
     */
    public function removeRole(string $role): void
    {
        if (in_array($role, $this->roles)) {
            unset($this->roles[$role]);
        }
    }

    /**
     * Remove sensitive data from the user
     */
    public function eraseCredentials(): void
    {
        // Don't erase
    }

    /**
     * Get the identifier for this user (e.g. username or email address)
     */
    public function getUserIdentifier(): string
    {
        return $this->Cedula;
    }

    /**
     * Get the hashed password for this user
     */
    public function getPassword(): ?string
    {
        return $this->Contraseña;
    }

    /**
     * Upgrade password
     */
    public function upgradePassword(string $newHashedPassword): void
    {
        $this->Contraseña = $newHashedPassword;
    }

    /**
     * Compare users by attributes that are relevant for assessing whether re-authentication is required
     * See https://symfony.com/doc/current/security.html#understanding-how-users-are-refreshed-from-the-session
     */
    public function isEqualTo(UserInterface $user): bool
    {
        if (!$user instanceof self) {
            return false;
        }

        // if ($this->getPassword() !== $user->getPassword()) {
        //     return false;
        // }
        $currentRoles = array_map("strval", (array) $this->getRoles());
        $newRoles = array_map("strval", (array) $user->getRoles());
        $rolesChanged = count($currentRoles) !== count($newRoles) || count($currentRoles) !== count(array_intersect($currentRoles, $newRoles));
        if ($rolesChanged) {
            return false;
        }
        if ($this->getUserIdentifier() !== $user->getUserIdentifier()) {
            return false;
        }
        return true;
    }
}
