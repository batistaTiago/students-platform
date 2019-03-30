<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index', 'layout-small');
	}

	public function cadastrar() {
		$this->render('cadastrar');
	}

	public function sucessoCadastro() {
		$this->render('sucesso_cadastro', 'layout-small');
	}

	public function login() {
		if (isset($_GET['info']) && $_GET['info'] != '') {
			$this->view->info = $_GET['info'];
		}
		
		$this->render('login', 'layout-small');
	}
}


?>