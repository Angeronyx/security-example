<?php

declare(strict_types=1);

namespace App\Presentation\Registration;

use App\Core\Mail\EmailTypes\ActivationEmail\ActivationEmail;
use App\Core\Mail\EmailTypes\ActivationEmail\ActivationEmailData;
use App\Core\Mail\MailService;
use App\Model\RegisteredUser\RegisteredUsersService;
use App\Presentation\Registration\ActivationApi\ActivationService;

class RegistrationService
{
    /**
     * @var RegisteredUsersService
     */
    private RegisteredUsersService $registeredUsersService;
    private MailService $mailService;
    private ActivationService $activationService;

    public function __construct(RegisteredUsersService $registeredUsersService, MailService $mailService, ActivationService $activationService) {
        $this->registeredUsersService = $registeredUsersService;
        $this->mailService = $mailService;
        $this->activationService = $activationService;
    }

    /**
     * @param $email
     * @param $password
     * @return void
     */
    public function registerUser($emailAddress, $password): void
    {
        //TODO createEntity
        $registeredUser = $this->registeredUsersService->createRegisteredUser($emailAddress, $password);
        //TODO send activation mail
        $activationToken = $registeredUser->getActivationToken();
        //custom class pro email type, v ktere bude odkaz na template, subject, konstruktor bude zrat data a recipienta, ta se passne mailSenderService
        $activationEmailData = new ActivationEmailData($this->activationService->createActivationLink($activationToken));

        $email = new ActivationEmail($emailAddress, $activationEmailData);

        $this->mailService->sendMail($email);
    }

}