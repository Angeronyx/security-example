<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Model\AEntityService;
use App\Model\Orm;
use App\Model\RegisteredUser\RegisteredUser;

class UsersService extends AEntityService
{
    /**
     * @param Orm $orm
     */
    public function __construct(private Orm $orm)
    {
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->orm->registeredUsers->findBy(['id' => $id])->fetch();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->orm->users->findBy(['email' => $email])->fetch();
    }

    public function findByName(string $username): ?User
    {
        return $this->orm->users->findBy(['name' => $username])->fetch();
    }

    public function findByIdentifier(string $identifier): ?User
    {
        $identifier = trim(strtolower($identifier));

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return $this->findByEmail($identifier);
        }

        return $this->findByName($identifier);
    }

    public function createUserByRegisteredUser(RegisteredUser $registeredUser): User
    {
        $user = new User();
        $user->setEmail($registeredUser->getEmail());
        $user->setPasswordHash($registeredUser->getPasswordHash());

        $this->orm->persistAndFlush($user);

        bdump($user);
        return $user;
    }
}