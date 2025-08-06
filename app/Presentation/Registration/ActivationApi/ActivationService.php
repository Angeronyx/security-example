<?php

declare(strict_types=1);

namespace App\Presentation\Registration\ActivationApi;

use App\Model\RegisteredUser\RegisteredUsersService;
use App\Model\RegistrationStatus\RegistrationStatus;
use App\Model\User\UsersService;
use Nette\Utils\DateTime;

class ActivationService
{
    /**
     * @param RegisteredUsersService $registeredUsersService
     * @param UsersService $usersService
     */
    public function __construct(private RegisteredUsersService $registeredUsersService,private UsersService $usersService)
    {
    }


    /**
     * @param string $activationToken
     */
    public function activateRegisteredUser(string $activationToken)
    {
        $registeredUser = $this->registeredUsersService->getRegisteredUserByActivationToken($activationToken);
        //TODO check for activationToken & expiration & registration status = pending

        if($registeredUser->getRegistrationStatus() === RegistrationStatus::STATUS_COMPLETED || $registeredUser->getRegistrationStatus() === RegistrationStatus::STATUS_DELETED)
        {
            //TODO Throw
        }

        if($registeredUser->getRegistrationStatus() === RegistrationStatus::STATUS_PENDING && $registeredUser->getActivationExpires() > new DateTime())
        {
            //TODO put inside transaction
            try {
                $user = $this->usersService->createUserByRegisteredUser($registeredUser);

                $registeredUser->setRegistrationStatus(RegistrationStatus::STATUS_COMPLETED);
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
        elseif($registeredUser->getRegistrationStatus() === RegistrationStatus::STATUS_EXPIRED || $registeredUser->getActivationExpires() < new DateTime())
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