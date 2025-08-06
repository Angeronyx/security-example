<?php

declare(strict_types=1);

namespace App\Presentation\Login;


use App\Core\Security\Authenticator;
use App\Model\User\User;
use App\Model\User\UsersService;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;

class LoginService
{
    public function __construct(private UsersService $usersService, private Authenticator $authenticator)
    {

    }

    /**
     * @param string $identifier
     * @param string $password
     * @return User|null
     * @throws \Exception
     */
    public function login(string $identifier, #[\SensitiveParameter] string $password): ?IIdentity
    {

        //$user = $this->usersService->findByEmail($email);
        $user = $this->usersService->findByIdentifier($identifier);
        $identity = $this->authenticator->authenticate($user->getName(), $password);

        return $identity;
    }
}