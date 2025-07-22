<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\RegisteredUser\RegisteredUsersRepository;
use App\Model\Role\RolesRepository;
use App\Model\User\UsersRepository;
use Nextras\Orm\Model\Model;

/**
 * Model
 *
 * @property UsersRepository $users
 * @property RegisteredUsersRepository $registeredUsers
 * @property RolesRepository $roles
 */
class Orm extends Model
{
    /*
    public function __construct()
    {
        parent::__construct();
    }*/
}