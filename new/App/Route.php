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

		$routes['sucesso_cadastro'] = array(
			'route' => '/sucesso_cadastro',
			'controller' => 'IndexController',
			'action' => 'sucessoCadastro'
		);

		$routes['esqueci_minha_senha'] = array(
			'route' => '/esqueci_minha_senha',
			'controller' => 'IndexController',
			'action' => 'recuperarSenha'
		);

		$routes['redefinir_senha'] = array(
			'route' => '/redefinir_senha',
			'controller' => 'IndexController',
			'action' => 'redefinirSenha'
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

		$routes['validar_email'] = array(
			'route' => '/validar_email',
			'controller' => 'AuthController',
			'action' => 'processarValidacaoEmail'
		);

		$routes['processar_esqueci_minha_senha'] = array(
			'route' => '/processar_esqueci_minha_senha',
			'controller' => 'AuthController',
			'action' => 'processarEsqueciMinhaSenha'
		);

		$routes['processar_redefinicao_senha'] = array(
			'route' => '/processar_redefinicao_senha',
			'controller' => 'AuthController',
			'action' => 'processarRedefinicaoSenha'
		);

		$routes['processar_login'] = array(
			'route' => '/processar_login',
			'controller' => 'AuthController',
			'action' => 'processarLogin'
		);

		$routes['logout'] = array(
			'route' => '/logout',
			'controller' => 'AuthController',
			'action' => 'processarLogout'
		);

		/* ROTAS DA APLICAÇÃO */

		$routes['main'] = array(
			'route' => '/main',
			'controller' => 'AppController',
			'action' => 'main'
		);

		$routes['editar_cadastro'] = array(
			'route' => '/editar_cadastro',
			'controller' => 'AppController',
			'action' => 'editarCadastro'
		);

		/* ROTAS DE API */

		$routes['get_user'] = array(
			'route' => '/get_user',
			'controller' => 'ApiController',
			'action' => 'emailDisponivel'
		);

		$routes['init_db'] = array(
			'route' => '/init_db',
			'controller' => 'ApiController',
			'action' => 'initDB'
		);		

		$this->setRoutes($routes);
	}

}

?>