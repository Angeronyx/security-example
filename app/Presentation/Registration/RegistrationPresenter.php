<?php

declare(strict_types=1);

namespace App\Presentation\Registration;

use App\Presentation\ABasePresenter;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends ABasePresenter
{
    public function __construct(private RegistrationService $registrationService)
    {
        parent::__construct();
    }

    public function createComponentRegistrationForm(): Form
    {
        $form = new Form();
        $form->addProtection();
        $form->addText('email', 'Email:')
            //->addRule($form::Email, 'Please enter a valid email address.')
            ->setRequired('Please enter a valid email address.');
        $form->addText('password', 'Password:')
            ->setRequired('Please enter a valid password.');
        $form->addSubmit('send', 'SEND');
        $form->onSuccess[] = function (Form $form, $data): void {
            //TODO validate inputs
            $email = strtolower(trim($data['email']));

            //filter_var(trim($data['identifier']), FILTER_SANITIZE_EMAIL);

            $this->registrationService->registerUser($email, $data['password']);
            //TODO show message waiting for activation through mail
        };
        return $form;
    }
}