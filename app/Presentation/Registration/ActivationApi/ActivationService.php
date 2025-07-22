<?php

declare(strict_types=1);

namespace App\Presentation\Registration\ActivationApi;

use App\Model\RegisteredUser\RegisteredUsersService;
use App\Model\User\UsersService;
use Nette\Utils\DateTime;

class ActivationService
{
    /**
     * @var RegisteredUsersService
     */
    private RegisteredUsersService $registeredUsersService;
    private UsersService $usersService;

    /**
     * @param RegisteredUsersService $registeredUsersService
     * @param UsersService $usersService
     */
    public function __construct(RegisteredUsersService $registeredUsersService, UsersService $usersService)
    {
        $this->registeredUsersService = $registeredUsersService;
        $this->usersService = $usersService;
    }


    /**
     * @param string $activationToken
     */
    public function activateRegisteredUser(string $activationToken)
    {
        $registeredUser = $this->registeredUsersService->getRegisteredUserByActivationToken($activationToken);
        //TODO check for activationToken & expiration & registration status = pending
        bdump($registeredUser);
        if($registeredUser->getRegistrationStatus() === 2 || $registeredUser->getRegistrationStatus() === 3)
        {
            //Throw
        }

        if($registeredUser->getRegistrationStatus() === 1 && $registeredUser->getActivationExpires() > new DateTime())
        {
            //TODO put inside transaction
            try {
                $user = $this->usersService->createUserByRegisteredUser($registeredUser);
                bdump($user);
                $registeredUser->setRegistrationStatus(2);
                $this->registeredUsersService->persist($registeredUser);
            }
            catch (\Exception $exception)
            {
                bdump($exception->getMessage());
                //TODO rollback transaction
                //TODO throw exception
            }
            //TODO commit transaction

        }
        elseif($registeredUser->getRegistrationStatus() === 4 || $registeredUser->getActivationExpires() < new DateTime())
        {
            //TODO reset status, reset Expiration, resend email

            $this->registeredUsersService->resetActivation($registeredUser);
        }

    }

    public function createActivationLink($activationToken): string
    {
        //TODO rethink URL design
        return '127.0.0.1:8080/activation?token=' . $activationToken;
    }
}