<?php

declare(strict_types=1);

namespace App\Presentation\Login;

use App\Core\Mail\MailService;
use App\Presentation\ABasePresenter;
use Nette\Application\UI\Form;

class LoginPresenter extends ABasePresenter
{

    /**
     * @param LoginService $loginService
     */
    public function __construct(private LoginService $loginService)
    {
        parent::__construct();
    }

    public function createComponentLoginForm(): Form
    {
        $form = new Form();
        $form->addProtection();
        $form->addText('identifier', 'Email:')
            //TODO uncomment->addRule($form::Email, 'Please enter a valid email address.')
            ->setRequired('Please enter a valid email address.');
        $form->addText('password', 'Password:')
            ->setRequired('Please enter a valid password.');
        $form->addSubmit('send', 'LOGIN');
        $form->onSuccess[] = function (Form $form, $data): void {
            $identifier = strtolower(
                trim($data['identifier'])
            );//filter_var(trim($data['identifier']), FILTER_SANITIZE_EMAIL);
            try {
                $identity = $this->loginService->login($identifier, $data['password']);

                $this->getUser()->login($identity);
            } catch (\Exception $e) {
                $this->error('', 401);
            }
        };
        return $form;
    }
}