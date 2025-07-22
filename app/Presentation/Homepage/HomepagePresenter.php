<?php

declare(strict_types=1);

namespace App\Presentation\Homepage;

use Nette\DI\Attributes\Inject;
use App\Model\Orm;
use App\Presentation\ABasePresenter;
use Nette;

final class HomepagePresenter extends ABasePresenter
{



    public function __construct() {
        parent::__construct();
    }

    public function actionDefault() {

        bdump($this->orm->users->findBy(['id' => 1])->fetch());
    }
}