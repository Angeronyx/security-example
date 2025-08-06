<?php

declare(strict_types=1);

namespace App\Model\RegistrationStatus;

class RegistrationStatus
{
    public const int STATUS_PENDING = 1;
    public const int STATUS_COMPLETED = 2;
    public const int STATUS_DELETED = 3;
    public const int STATUS_EXPIRED = 4;
}