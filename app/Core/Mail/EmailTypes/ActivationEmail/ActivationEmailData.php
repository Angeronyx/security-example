<?php

declare(strict_types=1);

namespace App\Core\Mail\EmailTypes\ActivationEmail;

use App\Core\Mail\EmailTypes\AEmailData;

class ActivationEmailData extends AEmailData
{
    public string $activationLink;

    public function __construct($activationLink) {
        $this->activationLink = $activationLink;
    }
}