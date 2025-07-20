<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Model\AEntityService;
use App\Model\Orm;
use App\Model\RegisteredUser\RegisteredUser;

class UsersService extends AEntityService
{
    private Orm $orm;

    /**
     * @param Orm $orm
     */
    public function __construct(Orm $orm)
    {
        $this->orm = $orm;
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
        return $this->orm->registeredUsers->findBy(['email' => $email])->fetch();
    }


    public function createUserByRegisteredUser(RegisteredUser $registeredUser): User
    {
        $user = new User();
        $user->setEmail($registeredUser->getEmail());
        $user->setPasswordHash($registeredUser->getPasswordHash());

        $this->orm->persistAndFlush($user);

        return $user;
    }
}