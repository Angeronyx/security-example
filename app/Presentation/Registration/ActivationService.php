<?php

declare(strict_types=1);

namespace App\Presentation\Registration;

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
        if($registeredUser->getRegistrationStatusId() === 2 || $registeredUser->getRegistrationStatusId() === 3)
        {
            //Throw
        }
        if($registeredUser->getRegistrationStatusId() === 1 && $registeredUser->getActivationExpires() > new DateTime())
        {
            //TODO put inside transaction
            try {
                $this->usersService->createUserByRegisteredUser($registeredUser);

                $registeredUser->setRegistrationStatusId(2);
                $this->registeredUsersService->persist($registeredUser);
            }
            catch (\Exception $exception)
            {
                //TODO rollback transaction
                //TODO throw exception
            }
            //TODO commit transaction

        }
        elseif($registeredUser->getRegistrationStatusId() === 4 || $registeredUser->getActivationExpires() < new DateTime())
        {
            //TODO reset status, reset Expiration, resend email

            $this->registeredUsersService->resetActivation($registeredUser);
        }

    }
}