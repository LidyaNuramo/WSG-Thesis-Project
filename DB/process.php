<?php
require_once('cloudsql.php');
require_once('cloudstorage.php');

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
			$time = date("Y-m-d h:i:s");
			$database=new Database();
			$where['Email'] ='="'.$email.'"';
	        $results=$database->getRows("client","*",$where);
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
				$database->insertRows("client",$data);
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
			$user=$database->getRow("client","*",$where);
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
			$user=$database->getRow("employee","*",$where);
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
			$time = date("Y-m-d h:i:s");
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
				$database->insertRows('gpslocation', $data);
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
				$whereapplication['ApplicationStatusID']= 'NOT IN (5,6,7)';
				$application=$database->getRow("rentapplication","*",$whereapplication);
				if ($application == NULL) { 
					$clientid=$user_id;
					$deviceid=$_GET['id'];
					date_default_timezone_set("Europe/Warsaw"); 
					$applicationtime = date("Y-m-d h:i:s");
					$where['id']= '="'.$deviceid.'"';
					$device=$database->getRow("assets","*",$where);
					$payment=$device['RentPricePerHour'];
					$bookpickdate = $_POST['book_pick_date']." ".$_POST['time_pick'];
					$bookoffdate = $_POST['book_off_date']." ".$_POST['time_drop'];
					$pickuplocation = $device['CurrentAssetLocationID'];
					$dropofflocation = $_POST['dropoffcity'];
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
		case 'cancelrental':
			session_start();
			$user_id = $_SESSION['userID'];
			$rentalid=$_GET['id'];
			$database=new Database();
			date_default_timezone_set("Europe/Warsaw"); 
			$returndate = date("Y-m-d h:i:s");
			$whererental['id']= '="'.$rentalid.'"';
			$data = array(
				"ActualReturnDate" => $returndate,
				"ApplicationStatusID" => 7
			);
			$database->updateRows('rentapplication', $data, $whererental);
			$whereapplication['id']= '="'.$rentalid.'"';
			$rental=$database->getRow("rentapplications","*",$whereapplication);
			$f = 'Y-m-d H:i:s';
			$applicationdate = new DateTime($rental['ApplicationDate']);
			$applicationstartdate = new DateTime($rental['PickupDate']);
			$actualreturndate = new DateTime($returndate);
			/**
			 * @var \DateInterval $diff
			 */
			if($actualreturndate > $applicationstartdate) {
				$diff= $actualreturndate->diff($applicationstartdate); 
				$hourint = $diff->h + ($diff->days * 24);
				$cancelationfee = (0.5) * $rental['PaymentPerHr'] * $hourint;
			}
			else {
				$diff= $applicationdate->diff($actualreturndate); 
				$hourint = $diff->h + ($diff->days * 24);
				$cancelationfee = (0.2) * $rental['PaymentPerHr'] * $hourint;
			}
			$total = $cancelationfee;
			$data = array(
				"RentApplicationId" => $rentalid,
				"SumRentPayment" => 0,
				"EarlyReturnDiscount" => 0,
				"LateReturnPayment" => 0,
				"CustomDescription" => "Cancelation Fee",
				"CustomDescriptionPayment" => $cancelationfee,
				"TotalAmount" => $total
			);
			$database->insertRows('clientreceipt', $data);
			$updatedevice['id']= '="'.$rental['DeviceId'].'"';
			$data = array(
				"CurrentRentStatusID" => 1
			);
			$database->updateRows('deviceinfo', $data, $updatedevice);
			header('Location: ../Client/Home/allrentals.php');
			break;
		case 'returnrental':
			session_start();
			$user_id = $_SESSION['userID'];
			$rentalid=$_GET['id'];
			$database=new Database();
			date_default_timezone_set("Europe/Warsaw"); 
			$returndate = date("Y-m-d h:i:s");
			$whererental['id']= '="'.$rentalid.'"';
			$data = array(
				"ActualReturnDate" => $returndate,
				"ApplicationStatusID" => 4
			);
			$database->updateRows('rentapplication', $data, $whererental);
			$whereapplication['id']= '="'.$rentalid.'"';
			$rental=$database->getRow("rentapplications","*",$whereapplication);
			$f = 'Y-m-d H:i:s';
			$applicationstartdate = new DateTime($rental['PickupDate']);
			$applicationreturndate = new DateTime($rental['ReturnDate']);
			$actualreturndate = new DateTime($returndate);
			/**
			 * @var \DateInterval $diff
			 */
			$diff= $applicationreturndate->diff($applicationstartdate); 
			$hourint = $diff->h + ($diff->days * 24);
			$sumrentpayment = $rental['PaymentPerHr'] * $hourint;
			if($actualreturndate < $applicationreturndate) {
				$diff= $applicationreturndate->diff($actualreturndate); 
				$hourint = $diff->h + (($diff->days * 24)-($diff->days * 12));
				$EarlyReturnDiscount = (0.99) * $rental['PaymentPerHr'] * $hourint;
				$LateReturnPayment = 0;
			}
			else {
				$diff= $actualreturndate->diff($applicationreturndate); 
				$hourint = $diff->h + (($diff->days * 24)-($diff->days * 12));
				$LateReturnPayment = (0.15) * $rental['PaymentPerHr'] * $hourint;
				$EarlyReturnDiscount = 0;
			}
			$total = $sumrentpayment - $EarlyReturnDiscount + $LateReturnPayment;
			$data = array(
				"RentApplicationId" => $rentalid,
				"SumRentPayment" => $sumrentpayment,
				"EarlyReturnDiscount" => $EarlyReturnDiscount,
				"LateReturnPayment" => $LateReturnPayment,
				"TotalAmount" => $total
			);
			$database->insertRows('clientreceipt', $data);
			$updatedevice['id']= '="'.$rental['DeviceId'].'"';
			$data = array(
				"CurrentRentStatusID" => 5
			);
			$database->updateRows('deviceinfo', $data, $updatedevice);
			header('Location: ../Client/Home/currentrental.php');
			break;
		case 'systemcancelrental':
			session_start();
			$rentalid=$_GET['id'];
			$database=new Database();
			date_default_timezone_set("Europe/Warsaw"); 
			$returndate = date("Y-m-d h:i:s");
			$wherereturnrental['id']= '='.$rentalid;
			$datareturnrental = array(
				"ActualReturnDate" => $returndate,
				"ApplicationStatusID" => 6
			);
			$database->updateRows('rentapplication', $datareturnrental, $wherereturnrental);
			$whereapplication['id']= '="'.$rentalid.'"';
			$rental=$database->getRow("rentapplications","*",$whereapplication);
			$data = array(
				"RentApplicationId" => $rentalid,
				"SumRentPayment" => 0,
				"EarlyReturnDiscount" => 0,
				"LateReturnPayment" => 0,
				"CustomDescription" => "None",
				"CustomDescriptionPayment" => 0,
				"TotalAmount" => 0
			);
			$database->insertRows('clientreceipt', $data);
			$updatedevice['id']= '="'.$rental['DeviceId'].'"';
			$data = array(
				"CurrentRentStatusID" => 1
			);
			$database->updateRows('deviceinfo', $data, $updatedevice);
			header('Location: ../Staff/Home/activeorders.php');
			break;
		case 'confirmreturn':
			session_start();
			$rentalid=$_GET['id'];
			$database=new Database();
			date_default_timezone_set("Europe/Warsaw"); 
			$returndate = date("Y-m-d h:i:s");
			$wherereturnrental['id']= '='.$rentalid;
			$datareturnrental = array(
				"ApplicationStatusID" => 5
			);
			$database->updateRows('rentapplication', $datareturnrental, $wherereturnrental);
			$whereapplication['id']= '="'.$rentalid.'"';
			$rental=$database->getRow("rentapplications","*",$whereapplication);
			$wherereceipt['RentApplicationId']= '='.$rentalid;
			$receipt=$database->getRow("clientreceipt","*",$wherereceipt);
			$customdesc = $_POST['customfeedesc'];
			$customfee = $_POST['customfee'];
			$newsum = floatval($customfee) + $receipt['TotalAmount'];
			$data = array(
				"CustomDescription" => $customdesc,
				"CustomDescriptionPayment" => $customfee,
				"TotalAmount" => $newsum
			);
			$database->updateRows('clientreceipt', $data,$wherereceipt);
			$updatedevice['id']= '="'.$rental['DeviceId'].'"';
			$data = array(
				"CurrentRentStatusID" => 1,
				"CurrentAssetLocationID" => $rental['DropOffLocation']
			);
			$database->updateRows('deviceinfo', $data, $updatedevice);
			header('Location: ../Staff/Home/completedorders.php');
			break;
		case 'newstaff':
			$fname=$_POST['name'];
			$lname=$_POST['surname'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$password=$_POST['password'];
			$city=$_POST['city'];
			$role=$_POST['jobrole'];
			date_default_timezone_set("Europe/Warsaw"); 
			$time = date("Y-m-d h:i:s");
			$database=new Database();
			$where['Email'] ='="'.$email.'"';
	        $results=$database->getRows("employee","*",$where);
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
					"Phone"=>$phone,
					"Email"=>$email,
					"Phone"=>$phone,
					"Password"=>$password,
					"CityID"=>$city,
					"CreatedOn"=>$time,
					"LastModifiedOn"=>$time,
					"RoleID"=>$role
				);
				$database->insertRows("employee",$data);
				$rr="Location: ../Staff/Home/eaccounts.php";
				header($rr);
				break;
			}
			$rr="Location: ../Staff/Home/neweaccount.php?action=no";
			header($rr);
			break;
		case 'deleteeaccount':
			session_start();
			$user_id = $_SESSION['userID'];
			$accountid = $_GET['id'];
			if ($user_id == $accountid){
				$rr="Location: ../Staff/Home/editeaccount.php?action=rejecteddelete&id=".$_GET['id'];
				header($rr);
				break;
			}
			else{
				$database=new Database();
				$where['id'] ='="'.$_GET['id'].'"';
				$results=$database->removeRows("employee",$where);
				$rr="Location: ../Staff/Home/eaccounts.php";
				header($rr);
				break;
			}
			break;
		case 'addAsset':
			$type = $_GET['type'];
			$file_name = $_FILES['fileToUpload']['name']; 
			$file_size = $_FILES['fileToUpload']['size']; 
			$file_tmpname = $_FILES['fileToUpload']['tmp_name']; 
			// $filename = pictureupload($file_name,$file_size,$file_tmpname,"../Images/");
			// removefile($filename);
			$name=$_POST['Name'];
			$AssetNumber=$_POST['AssetNumber'];
			$assetlocation=$_POST['assetlocation'];
			$Manufacturer=$_POST['Manufacturer'];
			$AssetType=$_POST['AssetType'];
			$rent=$_POST['rent'];
			$Description=$_POST['Description'];
			if ($_GET['type'] == 2){
				$Features='
Mileage: '.$_POST['Mileage'].'
Transmission: '.$_POST['Transmission'].'
Fuel: '.$_POST['Fuel'].'
Luggage: '.$_POST['Luggage'].'
Seats: '.$_POST['Seats'].'

Includes: '.$_POST['Includes'].'
Not Included: '.$_POST['NotIncluded'].'
				';
			}
			else{
				$Features='
Includes: '.$_POST['Includes'].'
Not Included: '.$_POST['NotIncluded'].'
				';
			}
			date_default_timezone_set("Europe/Warsaw"); 
			$time = date("Y-m-d h:i:s");
			$database=new Database();
			$data=array(
				"TypeId"=>$AssetType,
				"AssetNumber"=>$AssetNumber,
				"Name"=>$name,
				"Description"=>$Description,
				"Features"=>$Features,
				"ManufacturerID"=>$Manufacturer,
				"RegistrationDate"=>$time,
				"RentPricePerHour"=>$rent,
				"CurrentRentStatusID"=>7,
				"CurrentAssetLocationID"=>$assetlocation,
				"LastLocationDate"=>$time
			);
			$database->insertRows("deviceinfo",$data);
			$bucket = new Bucket();
			$filename = pictureupload($file_name,$file_size,$file_tmpname,"../Images/");
			$whichnewasset['AssetNumber']="='".$AssetNumber."'";
			$newasset = $database->getRow("deviceinfo","*",$whichnewasset);
			$assetid= $newasset['id'];
			echo "Before bucket";
			$link=$bucket->upload_file($filename, $filename, $assetid);
			removefile($filename);
			$data=array(
				"PhotoLinks" => $link
			);
			$database->updateRows("deviceinfo",$data,$whichnewasset);
			$rr="Location: ../Staff/Home/inventory.php";
			header($rr);
			break;
		case 'addPhotoGallery':
			$id = $_GET['id'];
			foreach ($_FILES['filesToUpload']['tmp_name'] as $key => $value) {
	            $file_name = $_FILES['filesToUpload']['name'][$key]; 
	            $file_size = $_FILES['filesToUpload']['size'][$key]; 
				$file_tmpname = $_FILES['filesToUpload']['tmp_name'][$key]; 
				$filename = pictureupload($file_name,$file_size,$file_tmpname,"../Images/");
				removefile($filename);
			}
			$rr="Location: ../Staff/Home/viewasset.php?id=".$id;
			header($rr);
			break;
		case 'changedisplaypic':
			$id = $_GET['id'];
			$file_name = $_FILES['fileToUpload']['name']; 
			$file_size = $_FILES['fileToUpload']['size']; 
			$file_tmpname = $_FILES['fileToUpload']['tmp_name']; 
			$filename = pictureupload($file_name,$file_size,$file_tmpname,"../Images/");
			removefile($filename);
			$rr="Location: ../Staff/Home/viewasset.php?id=".$id;
			header($rr);
			break;
		case 'changestatus':
			$id = $_GET['id'];
			$status = $_POST['assetstatus'];
			$updatedevice['id']= '='.$id;
			$database=new Database();
			$data = array(
				"CurrentRentStatusID" => $status
			);
			$database->updateRows('deviceinfo', $data, $updatedevice);
			$rr="Location: ../Staff/Home/viewasset.php?id=".$id;
			header($rr);
			break;
		case 'updateasset':
			$id = $_GET['id'];
			$name=$_POST['Name'];
			$AssetNumber=$_POST['AssetNumber'];
			$assetlocation=$_POST['assetlocation'];
			$Manufacturer=$_POST['Manufacturer'];
			$AssetType=$_POST['AssetType'];
			$rent=$_POST['rent'];
			$Description=$_POST['Description'];
			$Features=$_POST['Features'];
			$database=new Database();
			$updatedevice['id']= '='.$id;
			$data=array(
				"TypeId"=>$AssetType,
				"AssetNumber"=>$AssetNumber,
				"Name"=>$name,
				"Description"=>$Description,
				"Features"=>$Features,
				"ManufacturerID"=>$Manufacturer,
				"RentPricePerHour"=>$rent,
				"CurrentAssetLocationID"=>$assetlocation
			);
			$database->updateRows('deviceinfo', $data, $updatedevice);
			$rr="Location: ../Staff/Home/viewasset.php?id=".$id;
			header($rr);
			break;
   }
}

function pictureupload($file_name,$file_size,$file_tmpname,$target_directory){
	$target_dir = $target_directory;
	$target_file = $target_dir . basename($file_name);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($file_tmpname);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} 
		else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	// Check file size
	if ($file_size > (2 * 1024 * 1024)) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} 
	else {
		if (move_uploaded_file($file_tmpname, $target_file)) {
			echo "The file ". htmlspecialchars( basename( $file_name)). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	return $target_file;

}

function removefile($filename){
	if(file_exists($filename))
    {
        $status  = unlink($filename) ? 'The file '.$filename.' has been deleted' : 'Error deleting '.$filename;
        echo $status;
    }
 
    else
    {
        echo 'The file '.$filename.' doesnot exist';
    }
}
?>

