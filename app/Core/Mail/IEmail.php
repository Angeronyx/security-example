<?php

namespace App\Core\Mail;

interface IEmail
{
    public function getTemplate(): string;
    public function getSubject(): string;
    public function getRecipient(): string;
    public function getData(): array;
}