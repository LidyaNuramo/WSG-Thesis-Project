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
				<li class="nav-item active" id="nav-item-drop-down"><a href="#" class="nav-link">Orders</a>
					<div class="dropdown-content">
						<a href="currentrental.php" class="nav-link">Current Rental</a>
						<a href="allrentals.php" class="nav-link">History</a>
					</div>
				</li>
				<li class="nav-item"><a href="news.php" class="nav-link">News</a></li>
				<li class="nav-item"><a href="contact.php" class="nav-link">Help</a></li>
				<li class="nav-item" id="nav-item-drop-down"><a href="#" class="nav-link"><?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?></a>
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

	<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/order-arrow.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Current Rental <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Your current rental</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
    	<div class="container">
			<?php
				if(!empty($_GET['action']))
				{
					switch($_GET['action'])
					{
					case 'declinedrental':
						echo '
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label for="exampleInputEmail1" style="color: red;" class="control-label">Request not accepted as there is an existing rental in progress. Please complete this order or cancel this order before making a new one.</label>
									<br>
								</div>
							</div>
						';
						break;
					}
				}

				$database=new Database();
				$whereapplication['ClientId']= '="'.$_SESSION['userID'].'"';
				$whereapplication['ApplicationStatusID']= '!= "5"';
				$rental=$database->getRow("rentapplications","*",$whereapplication);
				
			?>
            <div class="form-group row">
                <div class="col-md-4" style=""> Contact us via phone </div>
            </div>
            
        </div>
    </section>


<?php
    include('footer.php');
?>