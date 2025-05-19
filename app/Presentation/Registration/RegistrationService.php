<?php

declare(strict_types=1);

namespace App\Presentation\Registration;

use App\Model\RegisteredUser\RegisteredUsersService;

class RegistrationService
{
    /**
     * @var RegisteredUsersService
     */
    private RegisteredUsersService $registeredUsersService;

    public function __construct(RegisteredUsersService $registeredUsersService) {
        $this->registeredUsersService = $registeredUsersService;
    }

    /**
     * @param $email
     * @param $password
     * @return void
     */
    public function registerUser($email, $password): void
    {
        //TODO createEntity
        $this->registeredUsersService->createRegisteredUser($email, $password);
        //TODO send activation mail
        //custom class pro email type, v ktere bude odkaz na template, subject, konstruktor bude zrat data a recipienta, ta se passne mailSenderService
    }
}