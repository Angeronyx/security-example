<?php

declare(strict_types=1);

namespace App\Core\Mail\EmailTypes;

use App\Core\Mail\AEmail;

class ActivationEmail extends AEmail
{

    public function getTemplate(): string
    {
        // TODO: Implement getTemplate() method.
        //vraci odkaz na template
    }

    public function getSubject(): string
    {
        // TODO: Implement getSubject() method.
        //statickej subject?
    }

    public function getRecipient(): string
    {
        // TODO: Implement getRecipient() method.
        //tohle musi bejt set pres konstruktor
    }

    public function getData(): array
    {
        // TODO: Implement getData() method.
        //tohle musi bejt set pres konstruktor
            //taky to bude chtit nejakou validaci, jedna moznost je pouzit data objekt, pokud pouziju datovej objekt tak by struktura mela bejt emailTypes/xyzEmail/xyzEmail, xyzEmailData, xyzTemplate
    }
}