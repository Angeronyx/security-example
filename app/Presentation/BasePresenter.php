<?php

namespace App\Presentation;

use Nette\Application\BadRequestException;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{

    /**
     * @return void
     * @throws BadRequestException
     */
    public function startup(): void
    {
        parent::startup();
    }
}