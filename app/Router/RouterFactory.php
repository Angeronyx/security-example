<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router->addRoute('Error', 'Error:default');
        $router->addRoute('error', 'Error:default');
        $router->addRoute('<presenter>/<action>', 'Homepage:default');
		return $router;
	}
}
