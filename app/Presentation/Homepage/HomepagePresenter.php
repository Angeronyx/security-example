<?php

declare(strict_types=1);

namespace App\Presentation\Homepage;

use Nette\DI\Attributes\Inject;
use App\Model\Orm;
use App\Presentation\BasePresenter;
use Nette;

final class HomepagePresenter extends BasePresenter
{
    #[Inject]
    public Orm $orm;


    public function __construct(Orm $orm) {
        parent::__construct();
        $this->orm = $orm;
        bdump($this->orm->users->findBy(['id' => 1])->fetch());
    }
}