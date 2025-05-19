<?php

declare(strict_types=1);

namespace App\Model\RegisteredUser;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<RegisteredUser>
 */
class RegisteredUsersRepository extends Repository
{

    /**
     * @return class-string[]
     */
    public static function getEntityClassNames(): array
    {
        return [RegisteredUser::class];
    }
}