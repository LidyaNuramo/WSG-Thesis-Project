<?php

include('/storage/ssd1/167/17747167/public_html/DB/main.php');
include('/storage/ssd1/167/17747167/public_html/DB/process.php');

if(!empty($_GET['action']))
{
  switch($_GET['action'])
  {
    case 'no':
      echo '<script language="javascript">';
      echo 'alert("An account already exists with this email address.")';
      echo '</script>';
      break;
  }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="rentals, cars, motors, bicycles, scooters, online payment">
    <meta name="description" content="Travel Rental is plaform where you can rent, pay for and get rental cars, motors, bicycles, and scooters through the Internet.">
    <meta name="robots" content="noindex,nofollow">
    <title>My Travel Rentals</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../Images/Logo.png">
    <link href="../../Staff/Home/dist/css/style.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../Staff/Home/assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../Staff/Home/assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" href="../Staff/Home/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="../Staff/Home/assets/libs/quill/dist/quill.snow.css">
    <link href="../../Staff/Home/dist/css/style.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="text-left pt-2 pb-2">
            <a href="index.php" style="color: gray;"><span class="db"><h2><img src="../Images/Logo.png" alt="Logo" style="width: 40px; height: 40 px;"/>My Travel Rentals</h2></span></a>
        </div>
    </div>



    <div>
        <div class="auth-wrapper d-flex no-block justify-content-left align-items-left bg-dark">
            <a href="login.php" style="color: white;margin-left: 80%;"><span class="db">Sign into existing account</span></a>
            <br>
            <br>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <form class="form-horizontal mt-3" action="DB/process.php?action=signup" method="POST" onsubmit="return checkPassword()">
                        <div class="row pb-4">
                            <div class="col-12">
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
                                    <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="dateofbirth">
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
        <footer class="footer text-center">
            All Rights Reserved. Thesis project by Lidya Nuramo. Website templates from <a href="https://matrixadmin.wrappixel.com/">WrapPixel</a> and <a href="https://themewagon.com/themes/free-bootstrap-4-html5-car-rental-website-template-carbook/">Themewagon</a>.
        </footer>
    </div>

    <script src="../Staff/Home/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../Staff/Home/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Staff/Home/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../Staff/Home/assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../Staff/Home/dist/js/waves.js"></script>
    <script src="../Staff/Home/dist/js/sidebarmenu.js"></script>
    <script src="../Staff/Home/dist/js/custom.min.js"></script>
    <script src="../Staff/Home/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../Staff/Home/dist/js/pages/mask/mask.init.js"></script>
    <script src="../Staff/Home/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../Staff/Home/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../Staff/Home/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="../Staff/Home/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="../Staff/Home/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="../Staff/Home/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="../Staff/Home/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../Staff/Home/assets/libs/quill/dist/quill.min.js"></script>
    <script>
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

        function checkPassword() {
            if (document.getElementById('password').value.length <6 ){
					document.getElementById('passmessage').style.color = 'red';
                    document.getElementById('passmessage').innerHTML = " Password length is less than 6.";
					return false;
			}
            else{
                if (document.getElementById('password').value ==
                    document.getElementById('confirm_password').value) {
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
    <script>
    $(".preloader").fadeOut();
    </script>
</body>

</html>

<?php

?>