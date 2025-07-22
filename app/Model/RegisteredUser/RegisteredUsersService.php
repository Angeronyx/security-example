<?php

declare(strict_types=1);

namespace App\Model\RegisteredUser;

use App\Model\AEntityService;
use App\Model\Orm;
use Exception;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;
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
        //TODO encapsulale usages in security class
        $passwords = new Passwords(PASSWORD_ARGON2ID, ['cost' => 11]);
        $registeredUser->passwordHash = $passwords->hash($password);

        $registeredUser->activationToken = Uuid::uuid4()->toString();
        $registeredUser->registrationStatus = 1;
        $registeredUser->activationExpires = DateTime::from('+7 days');
        $this->orm->persistAndFlush($registeredUser);

        return $registeredUser;
    }

    /**
     * @param string $activationToken
     * @return RegisteredUser
     */
    public function getRegisteredUserByActivationToken(string $activationToken): RegisteredUser
    {
        return $this->orm->registeredUsers->findBy(['activationToken' => $activationToken])->fetch();
    }

    public function persist(RegisteredUser $registeredUser): void
    {
        $this->orm->registeredUsers->persistAndFlush($registeredUser);
    }

    /**
     */
    public function resetActivation(RegisteredUser $registeredUser): RegisteredUser
    {
        //TODO retype the exception
        try
        {
            $registeredUser->setRegistrationStatus(1)
                ->setActivationExpires(DateTime::from('+7 days'));
        }
        catch (Exception $e)
        {
            //TODO throw some kind of dateTimeUtils exception
        }
        $this->persist($registeredUser);
        return $registeredUser;
    }
}