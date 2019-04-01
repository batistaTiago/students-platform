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
			$estudante->__set('name', $_POST['studentName']);
			$estudante->__set('birthday', $_POST['studentBirthday']);
			$estudante->__set('schoolLevel', $_POST['studentSchoolLevel']);
			$estudante->__set('isExperienced', $_POST['studentIsExperienced']);
			$estudante->__set('preferredArea', $_POST['studentPreferredArea']);

			echo '<pre>';
			print_r($_POST);
			echo '</pre>';

			$sucesso = $estudante->registrar($_POST['studentPassword']);

			if ($sucesso) {
				header('Location: /sucesso_cadastro');
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
			if ($estudante->__get('isActive')) {
				session_start();
				$_SESSION['id'] = $estudante->__get('id');
				$_SESSION['email'] = $estudante->__get('email');
				$_SESSION['name'] = ucwords($estudante->__get('name'));
				$_SESSION['birthday'] = $estudante->__get('birthday');
				$_SESSION['schoolLevel'] = $estudante->__get('schoolLevel');
				$_SESSION['isExperienced'] = $estudante->__get('isExperienced');
				$_SESSION['preferredArea'] = $estudante->__get('preferredArea');
				header('Location: /main');
			} else {
				header('Location: /login?info=usuario_inativo');
			}
			
		} else {
			header('Location: /login?info=erro');
		}
	}

	public function processarValidacaoEmail() {
		if (isset($_GET['confirmation']) && isset($_GET['user'])) {
			$email = $_GET['user'];
			$hash = $_GET['confirmation'];
			if (Container::getModel('Estudante')->validarEmailUsuario($hash, $email)) {
				header('Location: /login?info=conta_ativada');
			} else {
				header('Location: /');
			}	
		} else {
			echo 'um dos parametros veio errado';
		}
	}


	public static function validarSessao() {
		session_start();
		if (isset($_SESSION['id']) && isset($_SESSION['birthday']) && isset($_SESSION['schoolLevel'])) {
			if (isset($_SESSION['isExperienced']) && isset($_SESSION['preferredArea'])) {
				if (($_SESSION['id'] != '') && ($_SESSION['birthday'] != '') && ($_SESSION['schoolLevel'] != '')) {
					if (($_SESSION['isExperienced'] != '') && ($_SESSION['preferredArea'] != '')) {
						if (isset($_SESSION['name']) && $_SESSION['name'] != '') {
							return;	
						}
					}
				}
			}
		}

		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';

		header('Location: /login?info=sessao_expirada');
	}

	public function processarEsqueciMinhaSenha() {
		$estudante = Container::getModel('Estudante');
		$estudante->__set('email', $_POST['studentEmail']);
		$id = $estudante->getUserIdByEmail();

		if (!$estudante->emailDisponivel()) {
			echo '<br>usuario existe<br>';
			echo '<hr>registrando nova requisição';


			$requisicao = Container::getModel('PasswordResetRequest');
			$requisicao->__set('userEmail', $_POST['studentEmail']);
			$requisicao->__set('userId', $id);
			$requisicao->registrarNovaRequisicao();



			header('Location: /login?info=verificar_email');
		} else {
			echo '<br>usuario não existe!';
		}
	}

	public function processarRedefinicaoSenha() {
		$requisicao = Container::getModel('PasswordResetRequest');
		$requisicao->__set('userEmail', $_POST['uem']);
		$requisicao->__set('securityCode', $_POST['confirmation']);

		if ($requisicao->requisicaoExiste()) {
			if (isset($_POST['studentPassword']) && $_POST['studentPassword'] != '') {
				$requisicao->fetchUserId();
				$estudante = Container::getModel('Estudante');
				$estudante->__set('id', $requisicao->__get('userId'));
				$estudante->trocarSenha($_POST['studentPassword']);
				$requisicao->removerDoBanco();

				header('Location: /login?info=senha_alterada');
				
			} else {
				echo 'nova senha invalida! tente novamente <br>';
			}
		} else {
			echo 'requisicao invalida';
		}
	}

	public function processarLogout() {
		session_start();
		session_destroy();
		header('Location: /');
	}

}