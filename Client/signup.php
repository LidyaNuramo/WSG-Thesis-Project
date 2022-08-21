<?php
    include('header.php');
    include('../DB/cloudsql.php');
?>

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <br>
        <br>
        <br>
	</div>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <a href="login.php" style="color: white; margin-left: 60%;">Sign into existing account</a>
                <div>
                    <form class="form-horizontal mt-3" action="../DB/process.php?action=signup" method="POST" onsubmit="return validateForm()">
                        <div class="row pb-4">
                            <div class="col-12">
                                <?php
                            if(!empty($_GET['action']))
                            {
                                switch($_GET['action'])
                                {
                                    case 'no':
                                    ?>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label for="exampleInputEmail1" style="color: red;" class="control-label">An account already exists with this email address.</label>
                                            <br>
                                        </div>
                                    </div>
                                    <?php 
                                    break;
                                }
                            }
                            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" placeholder="First name" aria-label="First name" name="firstname" class="form-control form-control-lg" required>
                                    <input type="text" placeholder="Last name" aria-label="Last name" name="lastname" class="form-control form-control-lg" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-secondary text-white h-100" id="basic-addon1"><i class="ti-calendar"></i></span>
                                    </div>
                                    <input type="text" id ="dateofbirth" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="dateofbirth">
                                    <span id='agemessage'></span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white h-100" id="basic-addon1"><i class="ti-mobile"></i></span>
                                    </div>
                                    <input type="text" class="form-control international-inputmask" name="phone" id="international-mask" placeholder="Phone Number"style="-webkit-appearance= none; -moz-appearance= textfield;" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="email" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <span id='passmessage'></span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="confirm_password" placeholder=" Confirm Password" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <span id='message'></span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-location-pin"></i></span>
                                    </div>
                                    <input type="text" placeholder="Address 1" name="address" aria-label="Address" class="form-control form-control-lg" required>
                                </div>
                                <div class="input-group mb-3">
                                <!--div class="input-group mb-3"--> 
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="me-2 mdi mdi-mailbox"></i></span>
                                    </div>
                                    <input type="number" min="00000" max="99999" placeholder="Post Code" name="postcode" aria-label="Post Code" class="form-control form-control-lg" style="-webkit-appearance: none; margin: 0;-moz-appearance: textfield;" required>
                                <!--/div-->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-secondary text-white h-100" id="basic-addon1"><i class="me-2 mdi mdi-city"></i></span>
                                    </div>
                                    <select class="form-control form-control-lg" id="city" placeholder="City" name="city" required>
                                        <option disabled selected>City</option>
                                        <?php
                                            $database=new Database();
                                            $where['id']="";
                                            $results=$database->getRows("City","*",$where,"AND","Name");
                                            foreach($results as $result){
                                                echo '<option value="' .$result['id'].'">' . $result['Name']. '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-secondary text-white h-100" id="basic-addon1"> 
                                            <input id="acceptTerms" name="acceptTerms" type="checkbox" required> I agree with the Terms and Conditions.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3 d-grid">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ============================================================== 
        // Sign up form
        // ============================================================== 
        $(".select2").select2();
        $('.demo').each(function () {
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function (value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        function validateForm() {
            var dob = document.getElementById("dateofbirth").value;
            var now = new Date();
            var birthdate = dob.split("/");
            var born = new Date(birthdate[2], birthdate[0]-1, birthdate[1]);
            age=get_age(born,now);
            if (age<18)
            {
                document.getElementById('agemessage').style.color = 'red';
                document.getElementById('agemessage').innerHTML = " You must be of 18+ age to create an account.";
                return false;
            }
            if (document.getElementById('password').value.length <6 ){
					document.getElementById('passmessage').style.color = 'red';
                    document.getElementById('passmessage').innerHTML = " Password length is less than 6.";
					return false;
			}
            else{
                if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
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

        function get_age(born, now) {
            var birthday = new Date(now.getFullYear(), born.getMonth(), born.getDate());
            if (now >= birthday) 
                return now.getFullYear() - born.getFullYear();
            else
                return now.getFullYear() - born.getFullYear() - 1;
        }

    </script>

<?php
    include('footer.php');
?>