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
				);
				$database->insertRows("Client",$data);
				$rr="Location: ../login.php?action=yes";
				header($rr);
				break;
			}
			$rr="Location: ../signup.php?action=no";
			header($rr);
			break;
		case 'login':
			$email=$_POST['email'];
			$password=$_POST['password'];
			$where['Email']= '="'.$email.'"';
			$database=new Database();
			$user=$database->getRow("Client","*",$where);
			if ($user==NULL){
				header("Location: ../login.php?action=createaccount");
				break;
			}
			else{
				if($user['Password']==$password){
					session_start();
					$_SESSION['username']=$user['FirstName'];
					$_SESSION['lastname']=$user['LastName'];
					$_SESSION['userID']=$user['id'];
					$_SESSION['AccountStatus']=$user['VerificationStatus'];
					header("Location: ../Home/");
					break;
			   }
			   else{
					header("Location: ../login.php?action=no");
					break;
			   }
			}
		   break;
		case 'recoverpassword':
			header("Location: ../login.php");
			break;
		case 'logout':
			session_start();
			if(isset($_SESSION['username'])){
				session_destroy();
				header('Location: ../index.php');
			}
			else{
				header('Location: ../index.php');
			}
			break;
		case 'deleteHost':
			$id=$_GET['id'];
			$where['id']= '='.$id;
			$database=new Database();
			$database->removeRows("hosts",$where);
			header('Location: ../Exercise1');
			break;
		case 'addhost':
			$address=$_POST['name'];
			$port=$_POST['lastname'];
			$failedattempts=0;
			$failedtime=NULL;
			$totaldowntime=0;
			session_start();
			$addedby=$_SESSION['userID'];
			$database=new Database();
			$data=array(
				"ID"=>null,
				"FirstName"=>$fname,
				"LastName"=>$lname,
				"AccountType"=>"standard",
				"Email"=>$email,
				"Phone"=>$phone,
				"Password"=>$password,
			);
			$database->insertRows("hosts",$data);
			$rr="Location: ../Exercise2";
			header($rr);
			break;
   }
}
?>

