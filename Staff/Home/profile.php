<?php
    include('header.php');
?>
    <div class="container">
        <div class="row pb-4">
            <div class="col-12">
            <?php
                if(!empty($_GET['action']))
                {
                    switch($_GET['action'])
                    {
                    case 'updateprofile':
                        $where['id']= '="'.$_SESSION['userID'].'"';
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
                        $database->updateRows("employee",$data,$where);
                    ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label for="exampleInputEmail1" style="color: green;" class="control-label">Account successfully updated.</label>
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
                        $user=$database->getRow("employee","*",$where);
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
                    $user=$database->getRow("Employees","*",$where);
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
    include('footer.php');
?>