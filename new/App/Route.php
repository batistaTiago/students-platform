<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		/* ROTAS DO INDEX */
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'IndexController',
			'action' => 'index'
		);


		$routes['cadastrar'] = array(
			'route' => '/cadastrar',
			'controller' => 'IndexController',
			'action' => 'cadastrar'
		);

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'IndexController',
			'action' => 'login'
		);


		/* ROTAS DE AUTENTICAÇÃO */

		$routes['processar_cadastro'] = array(
			'route' => '/processar_cadastro',
			'controller' => 'AuthController',
			'action' => 'processarCadastro'
		);

		$routes['processar_login'] = array(
			'route' => '/processar_login',
			'controller' => 'AuthController',
			'action' => 'processarLogin'
		);

		/* ROTAS DA APLICAÇÃO */

		$routes['main'] = array(
			'route' => '/main',
			'controller' => 'AppController',
			'action' => 'main'
		);

		/* ROTAS DE API */

		$routes['get_user'] = array(
			'route' => '/get_user',
			'controller' => 'ApiController',
			'action' => 'emailDisponivel'
		);

		$this->setRoutes($routes);
	}

}

?>