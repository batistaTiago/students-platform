<?php

require 'validate-login.php';
require 'student.php';
    // TODO:
        // estrutura da page completa

?>


<!DOCTYPE html>
<html>
<head>
	<title>Página Incial</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- Bootstrap -->
	<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
	integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous">
</script>

</head>
<body>
	<?php include 'navigation-bar.php'; ?>
	<h1>Meu Perfil</h1>

	<?php 
	// echo '<pre>';
	// print_r($_SESSION['user']);
	// echo '</pre>';

	$perfil = unserialize($_SESSION['user']);


	// echo '<pre>';
	// print_r($perfil);
	// echo '</pre>';

	$exp = "Não";
	if ($perfil->isExperienced) {
		$exp = "Sim";
	}

	echo "<h2>Email: $perfil->email </h2>";
	echo "<h2>Data de nascimento: $perfil->birthday </h2>";
	echo "<h2>Escolaridade: $perfil->schoolLevel </h2>";
	echo "<h2>Fez enem: $exp </h2>";
	echo "<h2>Area: $perfil->preferredArea </h2>";
	?>

	<a href="editar-perfil.php">Editar</a>
	<br>
	<span><span class="text-danger display-1 font-weight-bold">TODO</span>: ALTERAR IDADE PARA DATA DE NASCIMENTO! </span>

</body>
</html>