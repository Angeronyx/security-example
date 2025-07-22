<?php

declare(strict_types=1);

namespace App\Presentation\Registration\ActivationApi;

use App\Presentation\ABaseApi;
use Ramsey\Uuid\Uuid;

class ActivationApiPresenter extends ABaseApi
{

    /**
     * @var ActivationService
     */
    private ActivationService $activationService;

    /**
     * @param ActivationService $activationService
     */
    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    public function actionDefault()
    {
        $token = $this->getParameter('token');

        if(!Uuid::isValid($token))
        {
            //TODO retype exception
            throw new \Exception('invalid token');
        }

        //TODO try catch around the activation
        $this->activationService->activateRegisteredUser($token);
    }

    public function actionReset() {
        //TODO reset only in status pending/expired
        //TODO reset activationTokens and set expiration
        //TODO send email with the new tokens
    }
}