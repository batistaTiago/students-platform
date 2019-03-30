<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	private function validarSessao() {
		AuthController::validarSessao();
	}

	public function main() {
		$this->validarSessao();
		$this->view->user = $_SESSION;
		$this->render('main', 'layout-logado');
	}

	public function editarCadastro() {
		
	}
}