<?php
    include('header.php');
    try {
        if(isset($_SESSION['role']) && !empty($_GET['id'])){
            $role = $_SESSION['role'];
            $where['id']= '="'.$role.'"';
			$database=new Database();
            $dept=$database->getRow("Role","*",$where);
            $allow = array("1", "2", "5", "6");
			if (in_array($dept['DeptID'], $allow)){
				?>
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Edit staff account</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="eaccounts.php">Employees</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <br>
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <div class="ms-auto text-end">
                        <a href="../../DB/process.php?action=deleteeaccount&id=<?php echo $_GET['id'];?>">
                            <button class="btn btn-danger"> Delete account </button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row pb-4">
                    <div class="col-12">
                    <?php
                        if(!empty($_GET['action']))
                        {
                            switch($_GET['action'])
                            {
                            case 'updateprofile':
                                $where['id']= '="'.$_GET['id'].'"';
                                $fname = $_POST['fname'];
                                $lname = $_POST['lname'];
                                $phone = $_POST['phone'];
                                $city = $_POST['city'];
                                date_default_timezone_set("Europe/Warsaw"); 
                                $updatedate = date("Y-m-d h:i:s");
                                $data=array(
                                    "FirstName"=>$fname,
                                    "LastName"=>$lname,
                                    "Phone"=>$phone,
                                    "CItyID"=>$city,
                                    "LastModifiedOn" => $updatedate
                                );
                                $database=new Database();
                                $database->updateRows("Employee",$data,$where);
                            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: green;" class="control-label">Account successfully updated.</label>
                                        <br>
                                    </div>
                                </div>
                                <?php
                                break;
                            case 'updateemail':
                                $email= $_POST['email'];
                                date_default_timezone_set("Europe/Warsaw"); 
                                $updatedate = date("Y-m-d h:i:s");
                                $database=new Database();
                                $where1['Email']= '="'.$email.'"';
                                $results=$database->getRows("employee","*",$where1);
                                $num=1;
                                foreach($results as $result){
                                    if ($email == $result['Email']){
                                        $num=$num+1;
                                    }
                                }
                                if ($num==1){
                                        
                                    $whereuser['id']= '="'.$_GET['id'].'"';
                                    $data=array(
                                        "Email"=>$email,
                                        "LastModifiedOn" => $updatedate
                                    );
                                    $database->updateRows("employee",$data,$whereuser);
                                    break;
                                }
                                else{
                                    echo '
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label for="exampleInputEmail1" style="color: red;" class="control-label">Cannot change account email. Another account already exists with this email ('.$email.').</label>
                                            <br>
                                        </div>
                                    </div>';
                                }
                                break;
                            case 'updatepassword':
                                $where['id']= '="'.$_GET['id'].'"';
                                $newpassword = $_POST['newpassword'];
                                $database=new Database();
                                date_default_timezone_set("Europe/Warsaw"); 
                                $updatedate = date("Y-m-d h:i:s");
                                $data=array(
                                    "Password"=>$newpassword,
                                    "LastModifiedOn" => $updatedate
                                );
                                $database->updateRows("employee",$data,$where);
                            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: green;" class="control-label">Account password successfully updated.</label>
                                        <br>
                                    </div>
                                </div>
                                <?php
                                break;
                            case 'rejecteddelete':
                                echo '
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: red;" class="control-label">Cannot delete your own account while logged in.</label>
                                        <br>
                                    </div>
                                </div>';
                                break;
                            }
                        }
                    ?>
                    </div>
                </div>
                <div class="card">
                    <form class="form-horizontal" action="editeaccount.php?action=updateprofile&id=<?php echo $_GET['id'];?>" method="POST">
                        <?php
                            $where['id']= '="'.$_GET['id'].'"';
                            $database=new Database();
                            $user=$database->getRow("Employees","*",$where);
                        ?>
                        <div class="form-group row">
                        <div class="card-body">
                            <h4 class="card-title">Update user details</h4>
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
                                <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Office City</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="city" placeholder="City" name="city" required>
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
                            <div class="form-group row">
                                <label for="jobrole" class="col-sm-3 text-end control-label col-form-label">Job role:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jobrole" name="jobrole">
                                        <?php
                                            $database=new Database();
                                            $where['id']="";
                                            $depts=$database->getRows("dept","*",$where,"AND","Name");
                                            foreach($depts as $dept){
                                                echo '<optgroup label="'.$dept['Name'].'">';
                                                $whererole['id']='="'.$dept['id'].'"';
                                                $roles=$database->getRows("role","*",$whererole,"AND","Name");
                                                foreach($roles as $role){
                                                    if ($user['RoleID']==$role['id']){
                                                        echo '<option value="' .$role['id'].'" selected>' . $role['Name']. '</option>';
                                                    }
                                                    else{
                                                        echo '<option value="' .$role['id'].'">' . $role['Name']. '</option>';
                                                    }
                                                }
                                                echo '</optgroup>';
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
                    <div class="card-body">
                        <h4 class="card-title">Update Account login</h4>
                    </div>
                    <div class="border-top">
                        <form class="form-horizontal" action="editeaccount.php?action=updateemail&id=<?php echo $_GET['id'];?>" method="POST">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 text-end control-label col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input id="email" name="email" type="text" class="required email form-control" value="<?php echo $user['Email'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <div>
                    <div class="border-top">
                        <form class="form-horizontal" action="editeaccount.php?action=updatepassword&id=<?php echo $_GET['id'];?>" method="POST" onsubmit="return validatePassword()">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="newpassword" class="col-sm-3 text-end control-label col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password Here" required>
                                        <span id='passmessage'></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmpassword" class="col-sm-3 text-end control-label col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm New Password Here" required>
                                        <span id='message'></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>  
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
			}
            else{
                header("Location: index.php");
            }
        }
        else{
            echo "Account Role error. Contact IT Administrator.";
        }
    }
    catch (Exception $e) {
        echo "No Role error. Contact IT Administrator.";
    }
    include('footer.php');
?>