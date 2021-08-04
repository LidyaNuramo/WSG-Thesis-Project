//<?php
//require_once('main.php');
//$database=new Database();
//echo $database;
//}
//?>
<?php
$servername = "10.82.144.4";
$username = "root";
$password = "password";
$dbname="mytravelrental_RBAC";

$response=array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
