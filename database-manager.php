<?php

class DataBaseManager {

	private static $instance = null;

	public static function getInstance() {

		if (self::$instance == null) {
			self::$instance = new DataBaseManager();
		}
		return self::$instance;
	}


	private $dsn = 'mysql:host=localhost;dbname=web_students_db';
	private $user = 'root';
	private $password = '';

	private $connection = null;

	private function __construct() {
		try {
			$dataBase = new PDO($this->dsn, $this->user, $this->password);
			$this->connection = $dataBase;
		} catch(PDOException $e) {
			echo "houve um erro <br>";
			echo '<hr><pre>';
			print_r($e);
			echo '</pre>';
		}
	}

	// public function getStudent($email) {
	// 	$query = 'SELECT * FROM students_table WHERE student_email = ?';
	// 	$statement = $this->connection->prepare($query);
	// 	$statement->bindValue(1, $email);
	// 	$statement->execute();
	// 	return $statement->fetch(PDO::FETCH_OBJ);
	// }


	// public function getStudents($email) {
	// 	$query = 'SELECT * FROM students_table WHERE student_email = ?';
	// 	$statement = $this->connection->prepare($query);
	// 	$statement->bindValue(1, $email);
	// 	$statement->execute();
	// 	return $statement->fetchAll(PDO::FETCH_OBJ);
	// }



	public function checkLoginInformation($email, $password) {
		$query = 'SELECT * FROM students_table WHERE student_email = ? AND student_password = ?';
		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $email);
		$statement->bindValue(2, $password);
		$statement->execute();

		$resultado = $statement->fetch(PDO::FETCH_OBJ);

		if ($resultado == null) {
			header('Location: login.php?info=resultado-invalido');
		} else {
			header('Location: home.php');
		}
	}


}

?>