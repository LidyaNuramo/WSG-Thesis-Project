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
					case 'startrental':
						$database=new Database();
						$whereapplication['id']= '="'.$_GET['id'].'"';
						$currentrental=$database->getRow("rentapplications","*",$whereapplication);
						date_default_timezone_set("Europe/Warsaw"); 
						$pickuptime = $currentrental['PickupDate'];
						$pickupdate = date('d/M/Y H:i:s', strtotime($pickuptime));
						$nowdate = date("Y-m-d h:i:sa");
						if ($pickupdate > $nowdate){
							echo '
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label for="exampleInputEmail1" style="color: red;" class="control-label">Pick up time has not yet arrived.</label>
										<br>
									</div>
								</div>
							';
						}
						else{
							$updaterent['id']= '="'.$_GET['id'].'"';
							$data = array(
								"ApplicationStatusID" => 3
							);
							$database->updateRows('rentapplication', $data, $updaterent);
							echo '
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label for="exampleInputEmail1" style="color: Green;" class="control-label">Rental now in progress.</label>
										<br>
									</div>
								</div>
							';
						}
						break;
					}
				}

				$database=new Database();
				$whereapplication['ClientId']= '="'.$_SESSION['userID'].'"';
				$whereapplication['ApplicationStatusID']= '!= "5"';
				$rental=$database->getRow("rentapplications","*",$whereapplication);

				if(!empty($rental)){
				?>
				
				<div class="form-group row">
					<div class="col-md-4"> Status: <font color="black"> <?php echo $rental['RentApplicationStatus']; ?> </font> </div>
				</div>

				<?php
					if ($rental['ApplicationStatusID'] == "1"){
					?>
						<div class="form-group row">
							<div class="col-md-4"> 
								<a href="../../DB/process.php?action=cancelrental&id=<?php echo $rental['id']; ?>"> 
									<button class="btn btn-danger">Cancel</button> 
								</a>
								<a href="currentrental.php?action=startrental&id=<?php echo $rental['id']; ?>">
									<button class="btn btn-secondary">Start</button>
								</a>
							</div>
						</div>
					<?php
					}
					else{
					?>
						<div class="form-group row">
							<div class="col-md-4">  
								<a href="../../DB/process.php?action=returnrental&id=<?php echo $rental['id']; ?>"> 
									<button class="btn btn-primary">Return Rental</button>
								</a>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					$wheredevice['DeviceId']= '="'.$rental['DeviceId'].'"';
					$wherepickup['id']= '="'.$rental['PickUpLocation'].'"';
					$wheredropoff['id']= '="'.$rental['DropOffLocation'].'"';
					$device=$database->getRow("rentapplications","*",$wheredevice);
					$pickup=$database->getRow("assetlocations","*",$wherepickup);
					$dropoff=$database->getRow("assetlocations","*",$wheredropoff);
				?>

				<div class="row">
					<div class="col-md-4">
						Pick-up Location: 
						<p class="mb-0" style="color: black;"><span id="Address"><?php echo $pickup['Address'].", ".$pickup['PostCode'].", ".$pickup['CityName'].", ".$pickup['CountryName']; ?></span></p>
						<!--div id="map"></div-->
					</div>
					<div class="col-md-4">
						Drop-Off Location: 
						<p class="mb-0" style="color: black;"><?php echo $dropoff['Address'].", ".$dropoff['PostCode'].", ".$dropoff['CityName'].", ".$dropoff['CountryName']; ?></p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-4">
						Pick-up Time: 
						<p class="mb-0" style="color: black;"><?php echo $rental['PickupDate']; ?></p>
					</div>
					<div class="col-md-4">
						Drop-Off Time: 
						<p class="mb-0" style="color: black;"><?php echo $rental['ReturnDate']; ?></p>
					</div>
				</div>

				<?php 
				}
				else{
				?>
				<div class="form-group row">
					<div class="col-md-4" style=""> No active rental is available. </div>
				</div>

				<?php
				}
				?>
            
        </div>
    </section>
	
	<script src="https://unpkg.com/@googlemaps/js-api-loader@1.0.0/dist/index.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script>
		var geocoder = new google.maps.Geocoder(); // initialize google map object
		var address = document.getElementById('Address').innerHTML;

		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();
				var myCenter=new google.maps.LatLng(latitude,longitude);
				function initialize()
				{
					var mapProp = {
						center:myCenter,
						zoom:7,
						mapTypeId:google.maps.MapTypeId.ROADMAP
					};
					
					var map=new google.maps.Map(document.getElementById("map"),mapProp);
					
					var marker=new google.maps.Marker({
						position:myCenter,
					});
					
					marker.setMap(map);
				}
				google.maps.event.addDomListener(window, 'load', initialize); 
			} 
		}); 
	</script>

<?php
    include('footer.php');
?>