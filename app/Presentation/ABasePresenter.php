<?php

namespace App\Presentation;

use App\Model\Orm;
use Nette\Application\BadRequestException;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

abstract class ABasePresenter extends Presenter
{
    public Orm $orm;

    /**
     * @param Orm $orm
     * @return void
     */
    public function injectABase(Orm $orm): void
    {
        $this->orm = $orm;
    }



    /**
     * @return void
     * @throws BadRequestException
     */
    public function startup(): void
    {
        parent::startup();
    }
}