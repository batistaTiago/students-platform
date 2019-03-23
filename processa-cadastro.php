<?php 

	require 'database-manager.php';

	
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

	*/

	$nome = $_POST['studentName'];
	$senha = $_POST['studentPassword'];
	$idade = $_POST['studentAge'];
	$escolaridade = $_POST['studentSchoolLevel'];
	$experiente = $_POST['studentIsExperienced'] == "Sim" ? true : false;
	$area = $_POST['studentPreferredArea'];
	
	$manager = DataBaseManager::getInstance();
	$manager->registerNewEntry($nome, $senha, $idade, $escolaridade, $experiente, $area);

?>