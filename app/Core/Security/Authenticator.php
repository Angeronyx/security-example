<?php

declare(strict_types=1);

namespace App\Core\Security;

use App\Model\User\UsersService;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;

class Authenticator
{
    /**
     * @param UsersService $usersService
     * @return void
     */
    public function __construct(private UsersService $usersService)
    {

    }

    function authenticate(string $identifier, string $password): IIdentity
    {
        //get user by identifier username/email?
        $user = $this->usersService->findByIdentifier($identifier);
        if ($user === null)
        {
            throw new \Exception('User not found');
        }
        $passwords = new Passwords(PASSWORD_ARGON2ID, ['cost' => 11]);
        $result = $passwords->verify($password, $user->passwordHash);
        if ($result)
        {
            return new Identity($user->getId(), $user->getRoles());
        }
        else
        {
            //TODO throw InvalidCredentials?
            throw new \Exception('Login failed');
        }
    }
}