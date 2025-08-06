<?php

declare(strict_types=1);

namespace App\Core\Mail;

use App\Core\Mail\EmailTypes\IEmail;
use Latte\Engine;
use Nette;
use Nette\Mail\Mailer;
use Nette\Mail\Message;

class MailService
{

    /**
     * @param Mailer $mailer
     * @param Engine $engine
     */
    public function __construct(private Nette\Mail\Mailer $mailer, private Engine $engine)
    {
    }

    /**
     * @param IEmail $email
     * @return void
     */
    public function sendMail(IEmail $email) {
        $message = $this->createMessage($email);
        $this->mailer->send($message);
    }

    /**
     * @param IEmail $email
     * @return Message
     */
    protected function createMessage(IEmail $email): Nette\Mail\Message
    {
        $message = new Message();
        $ref = new \ReflectionClass($email);
        $path = $ref->getFileName();
        $sub = substr($path, 0, strrpos($path, '\\'));

        $message->setFrom($email->getSender())
            ->addTo($email->getRecipient())
            ->setSubject($email->getSubject())
            ->setHtmlBody($this->engine->renderToString($sub . $email->getTemplate(), ['data' => $email->getData()]));
        return $message;
    }
}