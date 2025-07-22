<?php
declare(strict_types=1);

namespace App\Model\User;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<User>
 */
final class UsersRepository extends Repository
{

    /**
     * @return class-string[]
     */
    public static function getEntityClassNames(): array
    {
        return [User::class];
    }
}