<?php

declare(strict_types=1);

namespace App\Presentation\Login;


use App\Model\User\UsersService;
use Nette\Security\Passwords;

class LoginService
{
    public function __construct(private UsersService $usersService)
    {

    }
    /**
     * @param string $email
     * @param string $password
     * @return void
     */
    public function login(string $email, string $password): void
    {
        //TODO add mail validation/sanitization
        $user = $this->usersService->findByEmail($email);

        $passwords = new Passwords(PASSWORD_ARGON2ID, ['cost' => 11]);
        $result = $passwords->verify($password, $user->passwordHash);
        if ($result) {
            //TODO log user
            bdump($result);
        }
        else
        {
            //TODO throw InvalidCredentials?

        }

    }
}