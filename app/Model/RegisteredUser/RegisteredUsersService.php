<?php

declare(strict_types=1);

namespace App\Model\RegisteredUser;

use App\Model\AEntityService;
use App\Model\Orm;
use Nette\DI\Attributes\Inject;
use Nette\Security\Authenticator;
use Nette\Security\Authorizator;
use Nette\Security\Passwords;
use Ramsey\Uuid\Uuid;

class RegisteredUsersService
{
    private Orm $orm;

    /**
     * @param Orm $orm
     */
    public function __construct(Orm $orm) {
        $this->orm = $orm;
    }

    public function createRegisteredUser(string $email, string $password): RegisteredUser
    {
        $registeredUser = new RegisteredUser();
        $registeredUser->email = $email;
        $passwords = new Passwords(PASSWORD_ARGON2ID, ['cost' => 11]);
        $registeredUser->passwordHash = $passwords->hash($password);
        bdump($registeredUser->passwordHash);
        $registeredUser->activationToken = Uuid::uuid4()->toString();

        //$this->orm->persistAndFlush($registeredUser);

        return $registeredUser;
    }
}