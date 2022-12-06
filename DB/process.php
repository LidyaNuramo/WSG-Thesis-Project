<?php
require_once('cloudsql.php');

if(!empty($_GET['action'])){
	switch($_GET['action']){
        case 'signup':
			$fname=$_POST['firstname'];
			$lname=$_POST['lastname'];
            $dobinput=$_POST['dateofbirth'];
			$dob=strtotime($dobinput);
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$password=$_POST['password'];
			$city=$_POST['city'];
			$address=$_POST['address'];
			$postcode=$_POST['postcode'];
			date_default_timezone_set("Europe/Warsaw"); 
			$time = date("Y-m-d h:i:sa");
			$database=new Database();
			$where['Email'] ='="'.$email.'"';
	        $results=$database->getRows("Client","*",$where);
			$num=1;
			foreach($results as $result){
				if ($email == $result['Email']){
					$num=$num+1;
				}
			}
			if ($num==1){
				$data=array(
					"FirstName"=>$fname,
					"LastName"=>$lname,
					"DOB"=>$dob,
					"Phone"=>$phone,
					"Email"=>$email,
					"Phone"=>$phone,
					"Password"=>$password,
					"Address"=>$address,
					"PostCode"=>$postcode,
					"CityID"=>$city,
					"CreatedOn"=>$time,
					"LastModifiedOn"=>$time,
					"VerificationStatus"=>'No',
				);
				$database->insertRows("Client",$data);
				$rr="Location: ../Client/login.php?action=yes";
				header($rr);
				break;
			}
			$rr="Location: ../Client/signup.php?action=no";
			header($rr);
			break;
		case 'login':
			$email=$_POST['email'];
			$password=$_POST['password'];
			$where['Email']= '="'.$email.'"';
			$database=new Database();
			$user=$database->getRow("Client","*",$where);
			if ($user==NULL){
				header("Location: ../Client/login.php?action=createaccount");
				break;
			}
			else{
				if($user['Password']==$password){
					session_start();
					$_SESSION['username']=$user['FirstName'];
					$_SESSION['lastname']=$user['LastName'];
					$_SESSION['userID']=$user['id'];
					$_SESSION['type']='client';
					header("Location: ../Client/Home/");
					break;
			   }
			   else{
					header("Location: ../Client/login.php?action=no");
					break;
			   }
			}
		   break;
		case 'recoverpassword':
			header("Location: ../Client/login.php");
			break;
		case 'logout':
			session_start();
			if(isset($_SESSION['username'])){
				session_destroy();
				header('Location: ../Client/index.php');
			}
			else{
				header('Location: ../Client/index.php');
			}
			break;
		case 'stafflogin':
			$email=$_POST['email'];
			$password=$_POST['password'];
			$where['Email']= '="'.$email.'"';
			$database=new Database();
			$user=$database->getRow("Employee","*",$where);
			if ($user==NULL){
				header("Location: ../Staff/index.php?action=createaccount");
				break;
			}
			else{
				if($user['Password']==$password){
					session_start();
					$_SESSION['username']=$user['FirstName'];
					$_SESSION['lastname']=$user['LastName'];
					$_SESSION['userID']=$user['id'];
					$_SESSION['type']='staff';
					$_SESSION['role']=$user['RoleID'];
					header("Location: ../Staff/Home/");
					break;
				}
				else{
					header("Location: /Staff/index.php?action=no");
					break;
				}
			}
			break;
		case 'logoutstaff':
			session_start();
			if(isset($_SESSION['username'])){
				session_destroy();
				header('Location: ../Staff/index.php');
			}
			else{
				header('Location: ../Staff/index.php');
			}
			break;
		case 'addlocation':
			$database=new Database();
			$device=$_GET['device'];
			$where['AssetNumber']= '="'.$device.'"';
			$dev=$database->getRow("DeviceInfo","*",$where);
			date_default_timezone_set("Europe/Warsaw"); 
			$time = date("Y-m-d h:i:sa");
			if ($dev != NULL){
				$devid=$dev['id'];
				$long=$_GET['long'];
				$lat=$_GET['lat'];
				$datetime=$time;
				$data = array(
					"DeviceId" => $devid,
					"Long" => $long,
					"Lat" => $lat,
					"LocationDate" => $datetime
				);
				$database->insertRows('GPSLocation', $data);
			}
			break;
		case 'rent':
  			session_start();
			$user_id = $_SESSION['userID'];
			$where['id']= '="'.$user_id.'"';
			$database=new Database();
			$user=$database->getRow("clients","*",$where);
			if ($user['VerificationStatus']=="No"){
				header("Location: ../Client/Home/profile.php?action=missingpayment");
			}
			else{
				$whereapplication['ClientId']= '="'.$user_id.'"';
				$whereapplication['ApplicationStatusID']= '!= "5"';
				$application=$database->getRow("rentapplication","*",$whereapplication);
				if ($application == NULL) { 
					$clientid=$user_id;
					$deviceid=$_GET['id'];
					date_default_timezone_set("Europe/Warsaw"); 
					$applicationtime = date("Y-m-d h:i:sa");
					$where['id']= '="'.$deviceid.'"';
					$device=$database->getRow("assets","*",$where);
					$payment=$device['RentPricePerHour'];
					$bookpickdate = $_POST['book_pick_date']." ".$_POST['time_pick'];
					$bookoffdate = $_POST['book_off_date']." ".$_POST['time_drop'];
					$pickuplocation = $device['CurrentAssetLocationID'];
					$wherecity['CityID']= '="'.$_POST['dropoffcity'].'"';
					$location=$database->getRow("assetlocation","*",$wherecity);
					$dropofflocation = $location['id'];
					$data = array(
						"ClientId" => $clientid,
						"DeviceId" => $deviceid,
						"ApplicationDate" => $applicationtime,
						"PaymentPerHr" => $payment,
						"PickupDate" => $bookpickdate,
						"ReturnDate" => $bookoffdate,
						"PickupLocation" => $pickuplocation,
						"DropOffLocation" => $dropofflocation,
						"ApplicationStatusID" => 1
					);
					$database->insertRows('rentapplication', $data);
					$updatedevice['id']= '="'.$deviceid.'"';
					$data = array(
						"CurrentRentStatusID" => 2
					);
					$database->updateRows('deviceinfo', $data, $updatedevice);
					header('Location: ../Client/Home/currentrental.php');
				}
				else {
					header('Location: ../Client/Home/currentrental.php?action=declinedrental');
				}
			}
			break;
   }
}
?>

