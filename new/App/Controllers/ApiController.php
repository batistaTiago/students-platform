<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class ApiController extends Action {

	public function emailDisponivel() {
		$usuario = Container::getModel('Estudante');
		$usuario->__set('email', $_POST['email']);

		$disponivel = $usuario->getUserByEmail() == null ? true : false;

		print_r(json_encode(array('disponivel' => $disponivel)));
	}

	public function initDB() {
		Container::getModel('DataBaseManager')->initDataBase();
	}

}