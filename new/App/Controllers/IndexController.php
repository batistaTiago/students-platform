<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->view->pageTitle = 'Página de Entrada';
		$this->render('index', 'layout-small');
	}

	public function cadastrar() {
		$this->view->pageTitle = 'Página de Cadastro';
		$this->render('cadastrar');
	}

	public function sucessoCadastro() {
		$this->view->pageTitle = 'Sucesso!';
		$this->render('sucesso_cadastro', 'layout-small');
	}

	public function login() {
		if (isset($_GET['info']) && $_GET['info'] != '') {
			$this->view->info = $_GET['info'];
		}
		$this->view->pageTitle = 'Página de Login';
		$this->render('login', 'layout-small');
	}

	public function recuperarSenha() {
		$this->view->pageTitle = 'Esqueci minha Senha';
		$this->render('recuperar_senha', 'layout-small');
	}
}


?>