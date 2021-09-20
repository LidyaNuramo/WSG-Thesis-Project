<?php
require_once('lib/database.php');

if(!empty($_GET['action']))
{
	$action = $_GET['action'];
	
	switch($action)
	{
		case 'addlocation':
			$database=new Database();
			$device=$_GET['device'];
			$where['AssetNumber']= '="'.$device.'"';
			$dev=$database->getRow("DeviceInfo","*",$where);
			if ($dev == NULL){
				$dept=1;
				$desc="The device with the number ".$device." was not able to add location successfully.";
				$Link="Devices.php";
				$data = array(
					"id"=>null,
					"DeptID" => $dept,			
					"Description" => $desc,			
					"Link" => $Link
				);
				$database->insertRows('Notification', $data);
			}
			else{
				$devid=$dev['id'];
				$long=$_GET['long'];
				$lat=$_GET['lat'];
				$alt=$_GET['alt'];
				$vel=$_GET['vel'];
				$datetime=$_GET['datetime'];
				$data = array(
					"id"=>null,
					"DeviceId" => $devid,
					"Long" => $long,
					"Lat" => $lat,
					"Alt" => $alt,
					"Velocity" => $vel,
					"LocationDate" => $datetime
				);
				$database->insertRows('GPSLocation', $data);
			}
			break;
	}
}
exit();
?>