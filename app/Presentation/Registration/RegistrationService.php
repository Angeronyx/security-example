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

    public function __construct(private RegisteredUsersService $registeredUsersService, private MailService $mailService, private ActivationService $activationService)
    {

    }

    /**
     * @param $emailAddress
     * @param $password
     * @return void
     */
    public function registerUser($emailAddress, #[\SensitiveParameter]  $password): void
    {

        $registeredUser = $this->registeredUsersService->createRegisteredUser($emailAddress, $password);

        $activationToken = $registeredUser->getActivationToken();

        $activationEmailData = new ActivationEmailData($this->activationService->createActivationLink($activationToken));

        $activationEmail = new ActivationEmail($emailAddress, $activationEmailData);

        $this->mailService->sendMail($activationEmail);
    }

}