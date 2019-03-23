    <? 
    
    require 'validate-login.php';
    require 'student.php';


    echo json_encode(unserialize($_SESSION['user'])); 
    ?>