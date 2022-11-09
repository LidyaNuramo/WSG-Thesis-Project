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
						<a href="#" class="nav-link">Current Rental</a>
						<a href="#" class="nav-link">History</a>
					</div>
				</li>
				<!--li class="nav-item"><a href="news.php" class="nav-link">News</a></li>
				<li class="nav-item"><a href="contact.php" class="nav-link">Help</a></li-->
				<li class="nav-item active" id="nav-item-drop-down"><a href="#" class="nav-link"><?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?></a>
					<div class="dropdown-content">
						<a href="profile.php" class="nav-link">Edit Profile</a>
						<!--a href="#" class="nav-link">Messages</a>
						<a href="#" class="nav-link">Notifications</a-->
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
                            $data=array(
                                "VerificationStatus"=>"Yes"
                            )
                            $database=new Database();
                            $database->updateRows("Client",$data,$where);
                        ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label for="exampleInputEmail1" style="color: green;" class="control-label">Payment Card Successfully Added.</label>
                                    <br>
                                </div>
                            </div>
                            <?php
                            break;
                        case 'updateprofile':
                            $where['id']= '="'.$_SESSION['userID'].'"';
                            $data=array(
                                "VerificationStatus"=>"Yes"
                            )
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
                        }
                    }
                ?>
                </div>
            </div>
            <div class="card">
                <form class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Personal Info</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fname" placeholder="First Name Here">
                            </div>
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname"
                                    placeholder="Last Name Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname"
                                class="col-sm-3 text-end control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="lname"
                                    placeholder="Password Here">
                            </div>
                            <label for="lname"
                                class="col-sm-3 text-end control-label col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="lname" placeholder="Password Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">Company</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email1" placeholder="Company Name Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Contact No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cono1" placeholder="Contact No Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Message</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <a href="profile.php?action=updateprofile"><button type="button" class="btn btn-primary">Save</button></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <form class="form-horizontal" action="POST">
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
                        <a href="profile.php?action=addcard"><button class="btn btn-success btn-lg btn-block">Add card</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php
    include('footer.php');
?>