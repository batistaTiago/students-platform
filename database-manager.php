<?php

class DataBaseManager {

	private static $instance = null;

	public static function getInstance() {

		if (self::$instance == null) {
			self::$instance = new DataBaseManager();
		}
		return self::$instance;
	}

	private $dsn = 'mysql:host=localhost;dbname=web_students;charset=utf8';
	private $user = 'root';
	private $password = '';

	private $connection = null;

	private function __construct() {
		try {
			$this->connection = new PDO($this->dsn, $this->user, $this->password);
		} catch(PDOException $e) {
			echo "houve um erro <br>";
			echo '<hr><pre>';
			print_r($e);
			echo '</pre>';
		}
	}

	private function studentExists($email) {
		$query = 'SELECT * FROM students_table WHERE student_email = ?';
		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $email);
		$statement->execute();

		//entry eh null se não houver um estudante com o email informado
		$entry = $statement->fetch(PDO::FETCH_OBJ);
		return ($entry != null);
	}


	public function checkLoginInformation($email, $password) {
		$query = 'SELECT * FROM students_table WHERE student_email = ? AND student_password = ?';
		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $email);
		$statement->bindValue(2, $password);
		$statement->execute();

		return $statement->fetch(PDO::FETCH_OBJ);
	}

	public function registerNewEntry($email, $password, $age, $schoolLevel, $isExperienced, $area) {
		if ($this->studentExists($email)) {
			// exibir alerta com erro -> usuario ja existe (redirecionar pra login?)
			header('Location: login.php?info=user-exists');
		} else {
			$query = '
			INSERT INTO students_table (
			student_email, student_password, student_age,
			student_school_level, student_is_experienced, 
			student_preferred_area) VALUES (?, ?, ?, ?, ?, ?)
			';

			$statement = $this->connection->prepare($query);
			$statement->bindValue(1, $email);
			$statement->bindValue(2, $password);
			$statement->bindValue(3, $age);
			$statement->bindValue(4, $schoolLevel);
			$statement->bindValue(5, $isExperienced);
			$statement->bindValue(6, $area);

			echo $statement->execute();
		}
	}


	public function editEntry($id, $email, $password, $age, $schoolLevel, $isExperienced, $area) {
		if ($this->studentExists($email)) {
			$query = '
				UPDATE students_table 
				SET
					student_email = ?,
					student_password = ?,
					student_age = ?,
					student_school_level = ?,
					student_is_experienced = ?,
					student_preferred_area = ?
				WHERE
					student_id = ?';

			$statement = $this->connection->prepare($query);
			$statement->bindValue(1, $email);
			$statement->bindValue(2, $password);
			$statement->bindValue(3, $age);
			$statement->bindValue(4, $schoolLevel);
			$statement->bindValue(5, $isExperienced);
			$statement->bindValue(6, $area);
			$statement->bindValue(7, $id);

			return ($statement->execute() == 1);
		} else {
			//erro
		}
	}
}

?>
