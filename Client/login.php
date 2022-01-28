<?php
    include('/storage/ssd1/167/17747167/public_html/Client/header.php');
?>

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <br>
        <br>
        <br>
	</div>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <a href="signup.php" style="color: white; margin-left: 70%;">Sign Up for a new account</a>
            <div id="loginform" style="margin-top:50 px;">
                <form class="form-horizontal mt-3" id="loginform" action="DB/process.php?action=login" method="POST">
                    <div class="row pb-4">
                        <div class="col-12">
    <?php
		if(!empty($_GET['action']))
		{
			switch($_GET['action'])
			{
			  case 'yes':?>
				<div class="input-group mb-3">
                    <div class="input-group-prepend">
				        <label for="exampleInputEmail1" style="color: green;" class="control-label">Account successfully created. Please log in.</label>
				        <br>
                    </div>
				</div>
				<?php
				break;
			  case 'no':
			  ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
				        <label for="exampleInputEmail1" style="color: red;" class="control-label">Incorrect email or password. Please try again.</label>
				        <br>
                    </div>
				</div>
				<?php
				break;
			  case 'noaccount':
			  ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
				        <label for="exampleInputEmail1" style="color: red;" class="control-label">Please log in first as you are currently not logged in.</label>
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
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email address" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
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
                    
                    <form class="col-12" action="DB/process.php?action=recoverpassword" method="POST">
                        
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

    <script>
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

<?php
    include('/storage/ssd1/167/17747167/public_html/Client/footer.php');
?>