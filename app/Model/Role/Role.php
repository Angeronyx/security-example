<?php

declare(strict_types=1);

namespace App\Model\Role;

use App\Model\User\User;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * @property int $id {primary}
 * @property string $name
 */
class Role extends Entity
{
    /** @var int @orm\Primary */
    public int $id;

    /** @var string @orm\Column */
    public string $name;

    /**
     * @var ManyHasMany<User>
     * @orm\ManyHasMany(mappedBy="roles")
     */
    public ManyHasMany $users;
}