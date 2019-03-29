<?php

namespace App\Models;

use MF\Model\Model;

class Estudante extends Model {

	private $id = null;
	private $email = null;
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
		//verificar se existe o email ta disponivel para cadastro
		if ($this->emailDisponivel()) {
			$query = '
			INSERT INTO students_table (
			student_email, student_password, student_birthday,
			student_school_level, student_is_experienced, 
			student_preferred_area) VALUES (?, ?, ?, ?, ?, ?)
			';

			$statement = $this->connection->prepare($query);
			$statement->bindValue(1, $this->email);
			$statement->bindValue(2, md5($senha));
			$statement->bindValue(3, $this->birthday);
			$statement->bindValue(4, $this->schoolLevel);
			$statement->bindValue(5, $this->isExperienced);
			$statement->bindValue(6, $this->preferredArea);

			return $statement->execute();
		}
	}

	public function autenticar($senha) {
		//verificar se existe o email ta disponivel para cadastro
		$query = 'SELECT student_id, student_birthday, student_school_level, student_is_experienced, student_preferred_area FROM students_table WHERE student_email = ? AND student_password = ?';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->email);
		$statement->bindValue(2, md5($senha));

		$statement->execute();

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		if ($result != null) {
			$this->__set('id', $result['student_id']);
			$this->__set('birthday', $result['student_birthday']);
			$this->__set('schoolLevel', $result['student_school_level']);
			$this->__set('isExperienced', $result['student_is_experienced']);
			$this->__set('preferredArea', $result['student_preferred_area']);
			return true;
		} else {
			$this->__set('nome', '');
			$this->__set('id', '');
			$this->__set('email', '');
			$this->__set('senha', '');
			return false;
		}
	}

}

?>