<?php

declare(strict_types=1);

namespace App\Model\User;

use App\Model\Role\Role;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;


/**
 * @property int $id {primary}
 * @property string $name
 * @property string $email
 * @property string $passwordHash
 */
class User extends Entity
{

    /**
     * @var ManyHasMany<Role>
     * @orm\ManyHasMany(targetEntity=Role::class)
     * @orm\JoinTable(name="users_to_roles")
     */
    public ManyHasMany $roles;

    public function getRoles(): ManyHasMany
    {
        return $this->roles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): self
    {
        $this->passwordHash = $passwordHash;
        return $this;
    }
}
