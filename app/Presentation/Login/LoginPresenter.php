<?php

declare(strict_types=1);

namespace App\Presentation\Login;

use App\Core\Mail\MailService;
use App\Presentation\ABasePresenter;
use Nette\Application\UI\Form;

class LoginPresenter extends ABasePresenter
{

    /**
     * @var LoginService
     */
    private LoginService $loginService;

    /**
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        parent::__construct();
        $this->loginService = $loginService;
    }

    public function createComponentLoginForm(): Form
    {
        $form = new Form();
        $form->addProtection();
        $form->addText('email', 'Email:')
            //->addRule($form::Email, 'Please enter a valid email address.')
            ->setRequired('Please enter a valid email address.');
        $form->addText('password', 'Password:')
            ->setRequired('Please enter a valid password.');
        $form->addSubmit('send', 'LOGIN');
        $form->onSuccess[] = function (Form $form, $data): void {
            //TODO validate inputs

            $this->loginService->login($data['email'], $data['password']);

        };
        return $form;
    }
}