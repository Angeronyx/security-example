<?php

declare(strict_types=1);

namespace App\Core\Mail\EmailTypes;

abstract class AEmail implements IEmail
{
    use TEmail;

    public const string DOMAIN = 'localhost';

    protected string $sender = 'no-reply';

    protected string $template = '\default.latte';

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
        $this->subject = $subject;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): void
    {
        $this->recipient = $recipient;
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