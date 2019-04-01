<?php

namespace App\Models;

use MF\Model\Model;
use App\Controllers\MailController;

class Estudante extends Model {

	private $id = null;
	private $email = null;
	private $isActive = null;
	private $name = null;
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
		
		$query = '
		SELECT 
		* 
		FROM 
		students_table 
		WHERE 
		student_email = ?
		';

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

	public function getUserIdByEmail() {
		
		$query = '
		SELECT 
		student_id
		FROM 
		students_table 
		WHERE 
		student_email = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->__get('email'));
		$statement->execute();

		$results = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$count = count($results);

		if ($count > 1) {
			die('erro interno - mais de um usuario com o mesmo email');
		} else if ($count == 1) {
			return $results[0]['student_id'];
		} else {
			return null;
		}
	}

	public function getUserById() {
		
		$query = '
		SELECT 
		* 
		FROM 
		students_table 
		WHERE 
		student_id = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->id);
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
			INSERT INTO 
			students_table (
			student_email, student_password, student_name, student_birthday,
			student_school_level_id, student_is_experienced, 
			student_preferred_area_id, student_account_confirmation_hash) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?)
			';

			$hash = md5(rand(0,10000));

			$this->enviarEmailDeConfirmacao($hash);

			$statement = $this->connection->prepare($query);
			$statement->bindValue(1, $this->email);
			$statement->bindValue(2, md5($senha));
			$statement->bindValue(3, $this->name);
			$statement->bindValue(4, $this->birthday);
			$statement->bindValue(5, $this->schoolLevel);
			$statement->bindValue(6, $this->isExperienced);
			$statement->bindValue(7, $this->preferredArea);
			$statement->bindValue(8, $hash);

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
		student_account_confirmation_hash = ?
		';

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
				student_account_confirmation_hash = ?
				';

				$statement = $this->connection->prepare($query);
				$statement->bindValue(1, $estudante['student_email']);
				$statement->bindValue(2, $hash);
				$sucesso = ($statement->execute() == 1);

				return $sucesso;


			} else {
				// erro critico!
				die('erro critico no sistema de verificação de email');
			}
		}
	}

	public function autenticar($senha) {
		$query = '
		SELECT 
		student_id as id, 
		student_name as name,
		student_is_active as isActive, 
		student_birthday as birthday, 
		student_is_experienced as isExperienced,
		school_levels_table.description as schoolLevel, 
		preferred_areas_table.description as preferredArea
		FROM 
		students_table 

		LEFT JOIN
		school_levels_table
		ON
		students_table.student_school_level_id = school_levels_table.school_level_id

		LEFT JOIN
		preferred_areas_table
		ON
		students_table.student_preferred_area_id = preferred_areas_table.preferred_area_id

		WHERE 
		student_email = ? 
		AND 
		student_password = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->email);
		$statement->bindValue(2, md5($senha));

		$statement->execute();

		// TODO: TROCAR PARA FETCH ALL COM ERRO INTERNO

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		if ($result != null) {
			foreach ($result as $key => $value) {
				$this->__set($key, $value);
			}
			return true;
		} else {
			$this->__set('nome', '');
			$this->__set('id', '');
			$this->__set('email', '');
			$this->__set('senha', '');
			return false;
		}
	}

	public function trocarSenha($newPassword) {



		$query = '
			UPDATE 
				students_table 
			SET 
				student_password = ? 
			WHERE 
				student_id = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, md5($newPassword));
		$statement->bindValue(2, $this->__get('id'));
		$result = $statement->execute();

		echo 'meuId: ' . $this->__get('id');
		echo '<br>newPassword: ' . $newPassword;

		echo '<br>tentando mudar senha, resultado: ' . $result;
	}
}


?>