<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	private function validaSessao() {
		AuthController::validaSessao();
	}

	public function main() {
		echo 'chegamos até aqui';
	}
}