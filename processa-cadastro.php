<?php 

echo '<pre>';
print_r($_POST);
echo '</pre>';

	/* QUERY DE CRIAÇÃO DA TABELA

CREATE TABLE students_table (
	student_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,    
    student_email VARCHAR(60) NOT NULL,
    student_password VARCHAR(32) NOT NULL,
    student_age INT NOT NULL,
    student_school_level VARCHAR(20),
    student_is_experienced boolean NOT NULL,
    student_preferred_area VARCHAR(20) NOT NULL
)

	   if ( !isset($_POST['studentName']) ) ||
	   (!isset($_POST['studentPassword'])) || 
	   (!isset($_POST['studentAge'])) || 
	   (!isset($_POST['studentSchoolLevel'])) || 
	   (!isset($_POST['studentIsExperienced'])) || 
	   (!isset($_POST['studentPreferredArea'])) 


	*/



	   	$nome = utf8_decode($_POST['studentName']);
	   	$senha = utf8_decode($_POST['studentPassword']);
	   	$idade = $_POST['studentAge'];
	   	$escolaridade = utf8_decode($_POST['studentSchoolLevel']);
	   	$experiente = $_POST['studentIsExperienced'] == "Sim" ? true : false;
	   	$area = utf8_decode($_POST['studentPreferredArea']);




	   	$dataSourceName = 'mysql:host=localhost;dbname=web_students_db';
	   	$userName = 'root';
	   	$password = '';

	   	try {

	   		$dataBase = new PDO($dataSourceName, $userName, $password);


	   		$query = 'SELECT student_email FROM students_table WHERE student_email = ?';
	   		$statement = $dataBase->prepare($query);
	   		$statement->bindValue(1, $nome);

	   		$statement->execute();


	   		if($statement->fetch(PDO::FETCH_OBJ) != null) { // ja existe um usuario - exibir erro

   				echo '<script>alert("usuario já existe no banco")</script>';;

	   		} else { //nao existe esse usuario - cadastrar
	   			$query = 'INSERT INTO students_table (
										    student_email, student_password, student_age,
											student_school_level, student_is_experienced, 
											student_preferred_area) VALUES (?, ?, ?, ?, ?, ?)';

				$statement = $dataBase->prepare($query);
				$statement->bindValue(1, $nome);
				$statement->bindValue(2, $senha);
				$statement->bindValue(3, $idade);
				$statement->bindValue(4, $escolaridade);
				$statement->bindValue(5, $experiente);
				$statement->bindValue(6, $area);

				echo $statement->execute();
	   		}


	   	} catch (PDOException $e) {
	   		echo "houve um erro <br>";
	   		echo '<hr><pre>';
	   		print_r($e);
	   		echo '</pre>';
	   	}
	   ?>