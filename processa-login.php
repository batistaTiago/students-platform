<?php

	session_start();

	require 'database-manager.php';
	require 'student.php';

		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';

	$userEmail = $_POST['userEmail'];
	$userPassword = $_POST['userPassword'];

	$manager = DatabaseManager::getInstance();

	$resultado = $manager->checkLoginInformation($userEmail, $userPassword);

	 // 	echo '<pre>';
		// print_r($resultado);
		// echo '</pre>';


	if ($resultado == null) {
		$_SESSION['userIsAuthenticated'] = 'false';
		$_SESSION['userId'] = -1;
		$_SESSION['user'] = null;
		header('Location: login.php?info=resultado-invalido');
	} else {
		$_SESSION['userId'] = $resultado->student_id;
		$_SESSION['userIsAuthenticated'] = 'true';


		$_SESSION['user'] = serialize(
			new Student(
				$resultado->student_email,
				$resultado->student_age,
				$resultado->student_school_level,
				$resultado->student_is_experienced,
				$resultado->student_preferred_area,
				$resultado->student_id));


		header('Location: home.php');
	}

?>