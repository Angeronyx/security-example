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
        $router->addRoute('activation', 'Registration:ActivationApi:default');
        $router->addRoute('Login', 'Login:default');
        $router->addRoute('login', 'Login:default');
        $router->addRoute('Registration', 'Registration:default');
        $router->addRoute('registration', 'Registration:default');
        $router->addRoute('Error', 'Error:default');
        $router->addRoute('error', 'Error:default');
        $router->addRoute('<presenter>/<action>', 'Homepage:default');
		return $router;
	}
}
