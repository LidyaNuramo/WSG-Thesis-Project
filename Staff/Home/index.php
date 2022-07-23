<?php
    include('header.php');
    try {
        if(isset($_SESSION['role'])){
            $place = "dashboard-".$_SESSION['role'].".php";
            include($place);
        }
        else{
            echo "Account Role error. Contact IT Administrator.";
        }
    }
    catch (Exception $e) {
        echo "Account Role error. Contact IT Administrator.";
    }
    include('footer.php');
?>