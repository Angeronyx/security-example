<?php

declare(strict_types=1);

namespace App\Model\RegisteredUser;

use Nextras\Orm\Mapper\Dbal\DbalMapper;

/**
 * @extends DbalMapper<RegisteredUser>
 */
class RegisteredUsersMapper extends DbalMapper
{
    public function getTableName(): \Nextras\Dbal\Platforms\Data\Fqn|string
    {
        return 'registered_users';
    }
}