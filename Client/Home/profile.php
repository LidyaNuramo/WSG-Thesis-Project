<?php
  include('header.php');
  require_once('../../DB/cloudsql.php');
?>

      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
				<li class="nav-item" id="nav-item-drop-down"><a href="#" class="nav-link">Catalog</a>
					<div class="dropdown-content">
						<a href="catalog.php?type=1" class="nav-link">Bicycles</a>
						<a href="catalog.php?type=2" class="nav-link">Cars</a>
						<a href="catalog.php?type=3" class="nav-link">Motorscyles</a>
						<a href="catalog.php?type=4" class="nav-link">Scooters</a>
					</div>
				</li>
				<li class="nav-item" id="nav-item-drop-down"><a href="#" class="nav-link">Orders</a>
					<div class="dropdown-content">
						<a href="currentrental.php" class="nav-link">Current Rental</a>
						<a href="allrentals.php" class="nav-link">History</a>
					</div>
				</li>
				<li class="nav-item"><a href="news.php" class="nav-link">News</a></li>
				<li class="nav-item"><a href="contact.php" class="nav-link">Help</a></li>
				<li class="nav-item active" id="nav-item-drop-down"><a href="#" class="nav-link"><?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?></a>
					<div class="dropdown-content">
						<a href="profile.php" class="nav-link">Edit Profile</a>
						<a href="#" class="nav-link">Messages</a>
						<a href="#" class="nav-link">Notifications</a>
						<a href="../../DB/process.php?action=logout" class="nav-link">Logout</a>
					</div>
				</li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/profile.png);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Profile <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread"><?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
    	<div class="container">
            <div class="row pb-4">
                <div class="col-12">
                <?php
                    if(!empty($_GET['action']))
                    {
                        switch($_GET['action'])
                        {
                        case 'addcard':
                            $where['id']= '="'.$_SESSION['userID'].'"';
                            date_default_timezone_set("Europe/Warsaw"); 
			                $updatedate = date("Y-m-d h:i:s");
                            $data=array(
                                "LastModifiedOn" => $updatedate,
                                "VerificationStatus"=>"Yes"
                            );
                            $database=new Database();
                            $database->updateRows("Client",$data,$where);
                        ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail1" style="color: green;" class="control-label">Payment Card successfully Added.</label>
                                    <br>
                                </div>
                            </div>
                            <?php
                            break;
                        case 'updateprofile':
                            $where['id']= '="'.$_SESSION['userID'].'"';
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $phone = $_POST['phone'];
                            $address = $_POST['address'];
                            $postcode = $_POST['postcode'];
                            $city = $_POST['city'];
                            date_default_timezone_set("Europe/Warsaw"); 
			                $updatedate = date("Y-m-d h:i:s");
                            $data=array(
                                "FirstName"=>$fname,
                                "LastName"=>$lname,
                                "Phone"=>$phone,
                                "Address"=>$address,
                                "PostCode"=>$postcode,
                                "CItyID"=>$city,
                                "LastModifiedOn" => $updatedate,
                            );
                            $database=new Database();
                            $database->updateRows("Client",$data,$where);
                        ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail1" style="color: green;" class="control-label">Account successfully updated.</label>
                                    <br>
                                </div>
                            </div>
                            <?php
                            break;
                        case 'missingpayment':
                            ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail1" style="color: red;" class="control-label">No payment method is set up. Set up a payment method and search a rental once again.</label>
                                    <br>
                                </div>
                            </div>
                            <?php
                            break;
                        case 'updatepassword':
                            $where['id']= '="'.$_SESSION['userID'].'"';
                            $where['Password']='="'.$_POST['oldpassword'].'"';
                            $newpassword = $_POST['newpassword'];
                            $database=new Database();
                            $user=$database->getRow("Client","*",$where);
                            if ($user==NULL){
                        ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail1" style="color: red;" class="control-label">Incorrect old password entered.</label>
                                    <br>
                                </div>
                            </div>
                        <?php
                            }
                            else{
                                date_default_timezone_set("Europe/Warsaw"); 
			                    $updatedate = date("Y-m-d h:i:s");
                                $data=array(
                                    "Password"=>$newpassword,
                                    "LastModifiedOn" => $updatedate
                                );
                                $database=new Database();
                                $database->updateRows("Client",$data,$where);
                        ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: green;" class="control-label">Account password successfully updated.</label>
                                        <br>
                                    </div>
                                </div>
                                <?php
                                break;
                            }
                        }
                    }
                ?>
                </div>
            </div>
            <div class="card">
                <form class="form-horizontal" action="profile.php?action=updateprofile" method="POST">
                    <?php
                        $where['id']= '="'.$_SESSION['userID'].'"';
                        $database=new Database();
                        $user=$database->getRow("Clients","*",$where);
                    ?>
                    <div class="card-body">
                        <h4 class="card-title">Personal Info</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $user['FirstName'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $user['LastName'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control international-inputmask" name="phone" id="international-mask" placeholder="Phone Number"style="-webkit-appearance= none; -moz-appearance= textfield;" value="<?php echo $user['Phone'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Address</label>
                            <div class="col-sm-9">
                            <input type="text" placeholder="Address 1" name="address" aria-label="Address" class="form-control form-control-lg" value="<?php echo $user['Address'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Post Code</label>
                            <div class="col-sm-9">
                                <input type="number" min="00000" max="99999" name="postcode" aria-label="Post Code" class="form-control form-control-lg" style="-webkit-appearance: none; margin: 0;-moz-appearance: textfield;" value="<?php echo $user['PostCode'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">City</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg" id="city" placeholder="City" name="city" required>
                                    <?php
                                        $db=new Database();
                                        $where['id']="";
                                        $results=$db->getRows("City","*",$where,"AND","Name");
                                        foreach($results as $result){
                                            if ($user['CItyID']==$result['id']){
                                                echo '<option value="' .$result['id'].'" selected>' . $result['Name']. '</option>';
                                            }
                                            else{
                                                echo '<option value="' .$result['id'].'">' . $result['Name']. '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <form class="form-horizontal" action="profile.php?action=updatepassword" method="POST" onsubmit="return validatePassword()">
                    <div class="card-body">
                        <h4 class="card-title">Update password</h4>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Old Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password Here" required>
                                <span id='pmessage'></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password Here" required>
                                <span id='passmessage'></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm New Password Here" required>
                                <span id='message'></span>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <form class="form-horizontal" action="profile.php?action=addcard" method="POST">
                    <div class="card-body">
                        <h4 class="card-title">Payment Info</h4>
                        <p class="fw-bold mb-4 pb-2">Saved cards:</p>

                        <div class="d-flex flex-row align-items-center mb-4 pb-1">
                        <img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" />
                        <div class="flex-fill mx-3">
                            <div class="form-outline">
                            <input type="text" id="formControlLgXc" class="form-control form-control-lg"
                                value="**** **** **** 3193" />
                            <label class="form-label" for="formControlLgXc">Card Number</label>
                            </div>
                        </div>
                        <a href="#!">Remove card</a>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4 pb-1">
                            <img class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png" />
                            <div class="flex-fill mx-3">
                                <div class="form-outline">
                                <input type="text" id="formControlLgXs" class="form-control form-control-lg"
                                    value="**** **** **** 4296" />
                                <label class="form-label" for="formControlLgXs">Card Number</label>
                                </div>
                            </div>
                            <a href="#!">Remove card</a>
                            </div>

                            <p class="fw-bold mb-4">Add new card:</p>

                            <div class="form-outline mb-4">
                            <input type="text" id="formControlLgXsd" class="form-control form-control-lg"
                                value="Anna Doe" />
                            <label class="form-label" for="formControlLgXsd">Cardholder's Name</label>
                            </div>

                            <div class="row mb-4">
                            <div class="col-7">
                                <div class="form-outline">
                                <input type="text" id="formControlLgXM" class="form-control form-control-lg"
                                    value="1234 5678 1234 5678" />
                                <label class="form-label" for="formControlLgXM">Card Number</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-outline">
                                <input type="password" id="formControlLgExpk" class="form-control form-control-lg"
                                    placeholder="MM/YYYY" />
                                <label class="form-label" for="formControlLgExpk">Expire</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-outline">
                                <input type="password" id="formControlLgcvv" class="form-control form-control-lg"
                                    placeholder="Cvv" />
                                <label class="form-label" for="formControlLgcvv">Cvv</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg btn-block">Add card</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function validatePassword() {
            if (document.getElementById('oldpassword').value.length <1 ){
					document.getElementById('pmessage').style.color = 'red';
                    document.getElementById('pmessage').innerHTML = " Enter the old account password.";
					return false;
			}
            if (document.getElementById('newpassword').value.length <6 ){
					document.getElementById('passmessage').style.color = 'red';
                    document.getElementById('passmessage').innerHTML = " Password length is less than 6.";
					return false;
			}
            else{
                if (document.getElementById('newpassword').value == document.getElementById('confirmpassword').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = ' Matching';
                    return true;
                } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = " Password doesn't match.";
                    return false;
                }
            }
        }

    </script>

<?php
    include('footer.php');
?>