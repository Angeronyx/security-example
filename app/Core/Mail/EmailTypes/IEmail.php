<?php

namespace App\Core\Mail\EmailTypes;

interface IEmail
{
    public function getTemplate(): string;
    public function setTemplate(string $template): void;
    public function getSubject(): string;
    public function setSubject(string $subject): void;
    public function getRecipient(): string;
    public function setRecipient(string $recipient): void;
    public function getSender(): string;
    public function setSender(string $sender): void;
    public function getData(): IEmailData;
    public function setData(AEmailData $data): void;
}