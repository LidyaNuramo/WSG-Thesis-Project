<?php
    include('header.php');
    include('dashboard.php');
    include("https://lidyagnuramo.grafana.net/public-dashboards/0892ce48b7eb4c158f83b97f75be1d00?orgId=0");
    include('footer.php');
    // try {
    //     if(isset($_SESSION['role'])){
    //         $place = "dashboard-".$_SESSION['role'].".php";
    //         include($place);
    //         include('footer.php');
    //     }
    //     else{
    //         echo "Account Role error. Contact IT Administrator.";
    //     }
    // }
    // catch (Exception $e) {
    //     echo "No Role error. Contact IT Administrator.";
    // }
?>