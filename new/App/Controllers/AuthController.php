<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function processarCadastro() {
		$estudante = Container::getModel('Estudante');
		$estudante->__set('email', $_POST['studentEmail']);

		if ($estudante->emailDisponivel()) {
			$estudante->__set('birthday', $_POST['studentBirthday']);
			$estudante->__set('schoolLevel', $_POST['studentSchoolLevel']);
			$estudante->__set('isExperienced', $_POST['studentIsExperienced']);
			$estudante->__set('preferredArea', $_POST['studentPreferredArea']);

			$sucesso = $estudante->registrar($_POST['studentPassword']);

			if ($sucesso) {
				echo 'sucesso';
			} else {
				echo 'erro';
			}

		} else {
			header('Location: /cadastrar?erro=email_indisponivel');
		}
	}


	public function processarLogin() {

		$estudante = Container::getModel('Estudante');
		$estudante->__set('email', $_POST['studentEmail']);
		$sucesso = $estudante->autenticar($_POST['studentPassword']);
		
		if ($sucesso) {
			session_start();
			$_SESSION['id'] = $estudante->__get('id');
			$_SESSION['birthday'] = $estudante->__get('birthday');
			$_SESSION['schoolLevel'] = $estudante->__get('schoolLevel');
			$_SESSION['isExperienced'] = $estudante->__get('isExperienced');
			$_SESSION['preferredArea'] = $estudante->__get('preferredArea');
			header('Location: /main');
		} else {
			header('Location: /login?info=erro');
		}
	}


	public static function validarSessao() {
		session_start();
		if ((!isset($_SESSION['id'])) || (!isset($_SESSION['birthday'])) || (!isset($_SESSION['schoolLevel'])) || (!isset($_SESSION['isExperienced'])) || (!isset($_SESSION['preferredArea'])) || ($_SESSION['id'] == '') || ($_SESSION['birthday'] == '') || ($_SESSION['schoolLevel'] == '') || ($_SESSION['isExperienced'] == '') || ($_SESSION['preferredArea'] == '')) {

			header('Location: /?login=erro');

		}
	}

	public function sair() {
		session_start();
		session_destroy();
		header('Location: /');
	}

}