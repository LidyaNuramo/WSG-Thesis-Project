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
					$_SESSION['role']=strval($user['RoleID']);
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

