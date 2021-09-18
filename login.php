<?php
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
    <link href="../Staff/Home/dist/css/style.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
            <a href="signup.php" style="color: white;margin-left: 80%;"><span class="db">Sign Up for a new account</span></a>
            <br>
            <br>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <form class="form-horizontal mt-3" id="loginform" action="index.html">
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email address" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock me-1"></i> Lost password?</button>
                                        <button class="btn btn-success float-end text-white" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row mt-3">
                        
                        <form class="col-12" action="index.html">
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            
                            <div class="row mt-3 pt-3 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success text-white" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-end" type="button" name="action">Recover</button>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer text-center">
            All Rights Reserved. Thesis project by Lidya Nuramo. Website templates from <a href="https://matrixadmin.wrappixel.com/">WrapPixel</a> and <a href="https://themewagon.com/themes/free-bootstrap-4-html5-car-rental-website-template-carbook/">Themewagon</a>.
        </footer>
    </div>

    <script src="../Staff/Home/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../Staff/Home/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function(){
            
            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

</body>

</html>

<?php

?>