<?php

declare(strict_types=1);

namespace App\Core\Mail\EmailTypes\ActivationEmail;

use App\Core\Mail\EmailTypes\AEmail;
use App\Core\Mail\EmailTypes\IEmailData;

class ActivationEmail extends AEmail
{
    protected string $recipient;

    protected IEmailData $data;

    protected string $subject = 'Activation email';

    public function __construct($recipient, ActivationEmailData $data) {
        $this->setRecipient($recipient);
        $this->setData($data);
    }

}