<?php
require_once('lib/database.php');

if(!empty($_GET['action']))
{
	$action = $_GET['action'];
	
	switch($action)
	{
		case 'login':
			if(empty($_GET['login'])) {
				echo 'ERROR';
				exit();
			}
			$login = $_GET['login'];
			
			$database = new Database();
			$user_data = $database->getRow("DeviceInfo", "*", array("USER_LOGIN" => "= '".$login."'"));

			if($pass == $user_data["USER_PASSWORD"])	{
				echo $user_data['USER_ID'];
			}
			else {			
				echo 'ERROR';
			}
			
		break;
		
		case 'restaurants':
			if(empty($_GET['user'])) {
				echo 'ERROR';
				exit();
			}
			$user = $_GET['user'];
			$database = new Database();
			$user_data = $database->getRows("RESTAURANT", "*", array("RESTAURANT_USER" => "= '".$user."'"));
            echo json_encode($user_data);
			
		break;
		
		case 'addrestaurant':
			if(empty($_POST['user']) || empty($_POST['name']) || empty($_POST['phone'])) {
				echo 'ERROR';
				exit();
			}
			$user = $_POST['user'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$lat = $_POST['lat'];
			$long = $_POST['long'];
			
			$database = new Database();
			$data = array(
				"RESTAURANT_ID"=>null,
				"RESTAURANT_NAME" => $name,			
				"RESTAURANT_PHONE" => $phone,			
				"RESTAURANT_LAT" => $lat,			
				"RESTAURANT_LONG" => $long,			
				"RESTAURANT_USER" => $user	
			);
			$database = new Database();

			 $database->insertRows('RESTAURANT', $data);
			 echo 'OK';
			
		break;
		
		case 'delrestaurant':
			if(!isset($_GET['user']) || !is_numeric($_GET['user']) || ($_GET['user'] < 1) || !isset($_GET['restaurant']) || !is_numeric($_GET['restaurant']) || ($_GET['restaurant'] < 1)) {
				echo 'ERROR';
				exit;
			}
			$database = new Database();	
			$restaurant = $_GET['restaurant'];	
			$user = $_GET['user'];
			$where_restaurant['RESTAURANT_ID']="=".$restaurant."";
			$where_restaurant['RESTAURANT_USER']="=".$user."";
			$restaurant_data = $database->getRow("RESTAURANT", "*", $where_restaurant);
			
			if($restaurant_data['RESTAURANT_ID'] > 0) {
                $data_where = array(
                    "RESTAURANT_ID" => "='".$restaurant."'"
                );

                $database->removeRows('RESTAURANT', $data_where);		
                echo 'OK';
            } else {
                echo 'ERROR';
            }
		break;
	}
}
exit();
?>