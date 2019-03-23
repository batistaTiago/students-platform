<?php

	session_start();
	$_SESSION['userIsAuthenticated'] = 'false';
	$_SESSION['userId'] = -1;
	$_SESSION['user'] = null;
	header('Location: login.php?info=logout');


?>