<?php

namespace App\Core\Mail\EmailTypes;

trait TEmail
{
    protected string $recipient;

    protected IEmailData $data;

    protected string $subject;




    public function getData(): IEmailData
    {
        return $this->data;
    }

    public function setData(AEmailData $data): void
    {
        $this->data = $data;
    }
}