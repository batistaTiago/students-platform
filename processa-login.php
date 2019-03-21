<?php

	require 'database-manager.php';
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

	$nome_do_aluno = utf8_decode($_POST['userEmail']);
	$senha_do_aluno = utf8_decode($_POST['userPassword']);

 	$manager = DatabaseManager::getInstance();

 	$manager->checkLoginInformation($nome_do_aluno, $senha_do_aluno);

?>