<?php

declare(strict_types=1);

namespace App\Presentation\Registration;

use App\Presentation\ABasePresenter;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends ABasePresenter
{

    /**
     * @var RegistrationService
     */
    private RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        parent::__construct();
        $this->registrationService = $registrationService;
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
            $this->registrationService->registerUser($data['email'], $data['password']);
            //TODO show message waiting for activation through mail
        };
        return $form;
    }
}