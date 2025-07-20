<?php

declare(strict_types=1);

namespace App\Core\Mail\EmailTypes;

abstract class AEmail implements IEmail
{
    use TEmail;

    public const string DOMAIN = 'localhost';

    protected string $sender = 'no-reply';

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        // TODO: Implement setSubject() method.
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): void
    {
        // TODO: Implement setRecipient() method.
    }

    public function getSender(): string
    {
        return $this->sender . '@' . AEmail::DOMAIN;
    }

    public function setSender(string $sender): void
    {
        $this->sender = $sender;
    }
}