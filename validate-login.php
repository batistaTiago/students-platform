<?php
    session_start();

    // echo '<pre>';
    // print_r($_SESSION);
    // echo '<pre>';

    // echo $_SESSION['userId'];
    // echo '<hr>';

    if (isset($_SESSION)) {
    	if ($_SESSION['userId'] == -1) {
    		header('Location: login.php');
    	} else if ($_SESSION['userId'] == 'false') {
    		header('Location: login.php');
    	} else if ($_SESSION['user'] == null) {
    		header('Location: login.php');
    	}
    }
    
?>