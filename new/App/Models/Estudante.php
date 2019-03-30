<?php

namespace App\Models;

use MF\Model\Model;
use App\Controllers\MailController;

class Estudante extends Model {

	private $id = null;
	private $email = null;
	private $isActive = null;
	private $birthday = null;
	private $schoolLevel = null;
	private $isExperienced = null;
	private $preferredArea = null;

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		return $this->$attribute = $value;
	}

	public function getUserByEmail() {
		$query = 'SELECT * FROM students_table WHERE student_email = ?';
		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->email);
		$statement->execute();

		$results = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$count = count($results);

		if ($count > 1) {
			die('erro interno - mais de um usuario com o mesmo email');
		} else if ($count == 0) {
			return null;
		} else {
			return $results[0];
		}
	}

	public function emailDisponivel() {
		$user = $this->getUserByEmail();

		if ($user == null) {
			return true;
		} else {
			return false;
		}
	}


	public function registrar($senha) {
		// verificar se existe o email ta disponivel para cadastro
		if ($this->emailDisponivel()) {
			$query = '
			INSERT INTO students_table (
			student_email, student_password, student_birthday,
			student_school_level_id, student_is_experienced, 
			student_preferred_area_id, student_account_confirmation_hash) VALUES (?, ?, ?, ?, ?, ?, ?)
			';

			$hash = md5(rand(0,10000));

			$this->enviarEmailDeConfirmacao($hash);

			$statement = $this->connection->prepare($query);
			$statement->bindValue(1, $this->email);
			$statement->bindValue(2, md5($senha));
			$statement->bindValue(3, $this->birthday);
			$statement->bindValue(4, $this->schoolLevel);
			$statement->bindValue(5, $this->isExperienced);
			$statement->bindValue(6, $this->preferredArea);
			$statement->bindValue(7, $hash);

			return $statement->execute();
		}
	}

	public function enviarEmailDeConfirmacao($hash) {
		MailController::enviarConfirmacaoDeCadastro($this->__get('email'), $hash);
	}

	public function validarEmailUsuario($hash, $hashEncodedEmail) {
		$query = '
		SELECT 
			student_email, student_is_active
		FROM 
			students_table 
		WHERE 
			student_account_confirmation_hash = ?';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $hash);
		$statement->execute();

		$resultados = $statement->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($resultados as $id => $estudante) {
			if (md5($estudante['student_email']) == $hashEncodedEmail){

				$query = '
				UPDATE students_table 
				SET
					student_is_active = TRUE
				WHERE
					student_email = ?
				AND
					student_account_confirmation_hash = ?';

				$statement = $this->connection->prepare($query);
				$statement->bindValue(1, $estudante['student_email']);
				$statement->bindValue(2, $hash);
				$sucesso = ($statement->execute() == 1);

				if ($sucesso) {
					header('Location: /login');
				} else {
					echo 'erro';
				}


			} else {
				// erro critico!
				die('erro critico no sistema de verificação de email');
			}
		}
	}

	public function autenticar($senha) {
		//verificar se existe o email ta disponivel para cadastro
		$query = 'SELECT student_id, student_is_active, student_birthday, student_school_level_id, student_is_experienced, student_preferred_area_id FROM students_table WHERE student_email = ? AND student_password = ?';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->email);
		$statement->bindValue(2, md5($senha));

		$statement->execute();

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		if ($result != null) {
			$this->__set('id', $result['student_id']);
			$this->__set('birthday', $result['student_birthday']);
			$this->__set('schoolLevel', $result['student_school_level_id']);
			$this->__set('isExperienced', $result['student_is_experienced']);
			$this->__set('preferredArea', $result['student_preferred_area_id']);
			$this->__set('isActive', ((boolean)$result['student_is_active']) === true);


			 return true;
		} else {
			echo 'jeje';
			$this->__set('nome', '');
			$this->__set('id', '');
			$this->__set('email', '');
			$this->__set('senha', '');
			// return false;
		}
	}

}


?>