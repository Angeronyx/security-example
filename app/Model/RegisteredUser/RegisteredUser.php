<?php

declare(strict_types=1);

namespace App\Model\RegisteredUser;

use Nette\Database\DateTime;
use Nextras\Orm\Entity\Entity;


/**
 * @property int $id {primary}
 * @property string $email
 * @property string $passwordHash
 * @property string $activationToken
 * @property DateTime $activationExpires
 * @property int $registrationStatus {default 1}
 */
class RegisteredUser extends Entity
{
    public function getId(): int
    {
        return $this->id;
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

    public function getActivationToken(): string
    {
        return $this->activationToken;
    }

    public function setActivationToken(string $activationToken): self
    {
        $this->activationToken = $activationToken;
        return $this;
    }

    public function getActivationExpires(): DateTime
    {
        return $this->activationExpires;
    }

    public function setActivationExpires(DateTime $activationExpires): self
    {
        $this->activationExpires = $activationExpires;
        return $this;
    }

    public function getRegistrationStatus(): int
    {
        return $this->registrationStatus;
    }

    public function setRegistrationStatus(int $registrationStatusId): self
    {
        $this->registrationStatus = $registrationStatusId;
        return $this;
    }
}
