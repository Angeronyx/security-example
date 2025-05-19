<?php

declare(strict_types=1);

namespace App\Model\RegisteredUser;

use Nextras\Orm\Entity\Entity;


/**
 * @property int $id {primary}
 * @property string $email
 * @property string $passwordHash
 * @property string $activationToken
 * @property int $registrationStatusId {default 1}
 */
class RegisteredUser extends Entity
{

}