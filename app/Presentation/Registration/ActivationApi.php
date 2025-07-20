<?php

declare(strict_types=1);

namespace App\Presentation\Registration;

use App\Presentation\ABaseApi;

class ActivationApi extends ABaseApi
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

    public function actionDefault() {
        //TODO try catch around the activation
        $this->activationService->activateRegisteredUser();
    }

    public function actionReset() {
        //TODO reset only in status pending/expired
        //TODO reset activationTokens and set expiration
        //TODO send email with the new tokens
    }
}