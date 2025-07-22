<?php

declare(strict_types=1);

namespace App\Model\Role;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<Role>
 */
class RolesRepository extends Repository
{

    /**
     * @return class-string[]
     */
    public static function getEntityClassNames(): array
    {
        return [Role::class];
    }
}