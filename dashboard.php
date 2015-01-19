<?php include('core/init.core.php');

if(isset($_SESSION['status']) && $_SESSION['status']=='verified') 
{
    header('Location: register-journey.php');
    die();
}
else{
    header('Location: login.php');
    die();
}
?>