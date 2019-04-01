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
		$this->render('esqueci_minha_senha', 'layout-small');
	}

	public function redefinirSenha() {

		if (isset($_GET['uid']) && isset($_GET['confirmation']) && isset($_GET['uem']) && ($_GET['uid'] != '') && ($_GET['confirmation'] != '') && ($_GET['uem'] != '')) {

			$requisicao = Container::getModel('PasswordResetRequest');
			$requisicao->__set('userEmail', $_GET['uem']);
			$requisicao->__set('securityCode', $_GET['confirmation']);

			// echo '<br><br><br><br><br><br><br><br><br><br><br><br><pre>';
			// print_r($requisicao);
			// echo '</pre>';

			if ($requisicao->requisicaoExiste()) {
				$this->view->pageTitle = 'Redefinição de senha';
				$this->view->hashedUserEmail = $_GET['uem'];
				$this->view->confirmation = $_GET['confirmation'];
				$this->render('redefinir_senha', 'layout-small');
				return;
			}

		}

		echo 'request invalido';
	}

}


?>