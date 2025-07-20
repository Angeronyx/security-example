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
     * @var Nette\Mail\Mailer
     */
    private Nette\Mail\Mailer $mailer;

    /**
     * @var Engine
     */
    private Engine $engine;

    /**
     * @param Mailer $mailer
     * @param Engine $engine
     */
    public function __construct(Nette\Mail\Mailer $mailer, Engine $engine)
    {
        $this->mailer = $mailer;
        $this->engine = $engine;
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
    public function createMessage(IEmail $email): Nette\Mail\Message
    {
        $message = new Message();
        $message->setFrom($email->getSender())
            ->addTo($email->getRecipient())
            ->setSubject($email->getSubject())
            ->setHtmlBody($this->engine->renderToString($email->getTemplate(), ['data' => $email->getData()]));
        return $message;
    }
}