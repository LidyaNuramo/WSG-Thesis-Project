<?php
  include('header.php');
  require_once('../../DB/cloudsql.php');
?>

<?php 
	if(!empty($_GET['assetID'])){
		$assetid=$_GET['assetID'];
	}
	else{
		header('index.php');
	}
?>
      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
				<li class="nav-item active" id="nav-item-drop-down"><a href="#" class="nav-link">Catalog</a>
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
    
    <?php
		$database=new Database();
		$where['id']='="'.$assetid.'"';
		$result=$database->getRow("assets","*",$where);
		echo '
		<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('.$result['PhotoLinks'].');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
					<div class="col-md-9 ftco-animate pb-5">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="catalog.php?type='.$result['CatalogTypeID'].'">'.$result['CatalogType'].' <i class="ion-ios-arrow-forward"></i></a></span> <span>'.$result['CatalogType'].' details <i class="ion-ios-arrow-forward"></i></span></p>
						<h1 class="mb-3 bread">'.$result['AssetName'].'</h1>
					</div>
				</div>
			</div>
		</section>';

	?>
		

	<section class="ftco-section ftco-car-details">
      	<div class="container">
			<div class="row">
				<div class="col-md-4">
					Pick-up Location: 
					<p class="mb-0" style="color: black;"><?php echo $result['AssetAddress'].", ".$result['AssetPostCode'].", ".$result['AssetCityName']; ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 pills">
					<div class="bd-example bd-example-tabs">
						<div class="d-flex justify-content-center">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
								</li>
								<li class="nav-item">
							      <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Rent</a>
							    </li>
							</ul>
						</div>

						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								<div class="row">
									<ul class="features">
										<li class="check" style="text-align: justify; white-space: pre-line;"><?php echo $result['Features'] ?>
									</ul>
								</div>
							</div>

							<div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
								<p style="text-align: justify; white-space: pre-line;"><?php echo $result['Description'] ?></p>
							</div>

							<div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
						      	<div class="row">
								  	<form action="../../DB/process.php?action=rent&id=<?php echo $result['id'] ?>" class="form-horizontal mt-3" method="POST" onsubmit="return validateDate()" autofocus>
										<?php
											$pickupcity = $result['AssetCityID'];
											$dropoffcity = NULL;
											$book_pick_date = NULL;
											$book_off_date = NULL;
											$time_pick = NULL;
											$catagory=  NULL;
											if(!empty($_GET['action'])){
												switch($_GET['action']){
													case 'loadform':
														$pickupcity = $_POST['pickupcity'];
														$dropoffcity = $_POST['dropoffcity'];
														$bookpickdate = $_POST['book_pick_date'];
														$bookoffdate = $_POST['book_off_date'];
														$timepick = $_POST['time_pick'];
														$time_drop = $_POST['time_drop'];
														$catagory=  $_POST['catagory'];
														break;
												}
											}
										?>
										<div class="form-group">
											<label for="" class="label">Drop-off location</label>
											<select class="form-control" id="city" id="dropoffcity" name="dropoffcity" placeholder="City" name="city" required>
												<?php
													if(!empty($catagory)){
														?>
														<option disabled>City</option><?php
													}
													else{
														?>
														<option disabled selected>City</option><?php
													}
													$database=new Database();
													$wherecity['id']="";
													$cities=$database->getRows("assetlocations","DISTINCT CityID, CityName",$wherecity,"AND","CityName");
													foreach($cities as $city) {
														$wherelocation['CityName']='="'.$city['CityName'].'"';
														$locations=$database->getRows("assetlocations","*",$wherelocation,"AND","CityName");
														if(!empty($catagory) && $city['CityID']==$dropoffcity){
															echo '<optgroup label="'.$city['CityName'].'" selected>';
														}
														else{
															echo '<optgroup label="'.$city['CityName'].'">';
														}
														foreach($locations as $location){
															echo '<option value="'.$location['id'].'" >'.$location['Address'].'</option>';
														}
														echo '</optgroup>';
													}
												?>
											</select>
											<div class="d-flex">
												<div class="form-group mr-2">
													<label for="" class="label">Pick-up date</label>
													<input type="text" class="form-control" id="book_pick_date" name="book_pick_date" placeholder="Date" value="<?php if(!empty($bookpickdate)){echo $bookpickdate;}?>" required>
												</div>
												<div class="form-group ml-2">
													<label for="" class="label">Drop-off date</label>
													<input type="text" class="form-control" id="book_off_date" name="book_off_date" placeholder="Date" value="<?php if(!empty($bookoffdate)){echo $bookoffdate;}?>" required>
												</div>
											</div>
											<span id='message'style="font-size:10pt;"></span>
											<div class="form-group">
												<label for="" class="label">Pick-up time</label>
												<input type="time" class="form-control" id="time_pick_up" name="time_pick" placeholder="Time" value="<?php if(!empty($timepick)){echo $timepick;}?>" required>
											</div>
											<div class="form-group">
												<label for="" class="label">Drop-Off time</label>
												<input type="time" class="form-control" id="time_drop_off" name="time_drop" placeholder="Time" value="<?php if(!empty($time_drop)){echo $time_drop;}?>" required>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-secondary py-3 px-4">Rent</button>
											</div>
										</div>
									</form>
								</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="lightbox-gallery">
						<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
						<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"-->
						<div class="photo-gallery">
							<div class="container">
								<div class="intro">
									<h2 class="text-center"><?php echo $result['CatalogType'];?> Gallery</h2>
								</div>
								<div class="row photos">
									<?php
									$database=new Database();
									$where2['DeviceID']='="'.$assetid.'"';
									$photoresults=$database->getRows("devicephotogallery","*",$where2);
									$gallery = "";
									foreach ($photoresults as $photoresult){
										$gallery = $gallery.'<div class="col-sm-6 col-md-4 col-lg-3 item"><a href="'.$photoresult['Photolink'].'" data-lightbox="photos"><img class="img-fluid" src="'.$photoresult['Photolink'].'"></a></div>';
									}
									echo $gallery;
									?>
								</div>
							</div>
						</div>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
					</div>
				</div>
			</div>
		</div>
		</section>

		<section class="ftco-section ftco-no-pt">
			<div class="container">
				<div class="row justify-content-center">
			<div class="col-md-12 heading-section text-center ftco-animate mb-5">
				<span class="subheading">Choose <?php echo $result['CatalogType']; ?></span>
				<h2 class="mb-2"><?php echo $result['CatalogType']; ?>s in similar City</h2>
			</div>
			</div>
			<div class="row">
				<?php
					$database=new Database();
					$where['id']='<>"'.$result['id'].'"';
					$where['CatalogTypeID']='="'.$result['CatalogTypeID'].'"';
					$where['CurrentRentStatus']='="Available"';
					$resultrows="3;";
					$relatedresults=$database->getRows("assets","*",$where,"AND","AssetCityID",$resultrows);
					foreach ($relatedresults as $related){
						echo '
						<div class="col-md-4">
							<div class="car-wrap rounded ftco-animate">
								<div class="img rounded d-flex align-items-end" style="background-image: url('.$related['PhotoLinks'].');"  alt="'.$related['AssetTypeName'].'">
								</div>
								<div class="text">
									<h2 class="mb-0"><a href="car-single.html">'.$related['AssetName'].'</a></h2>
									<div class="d-flex mb-3">
										<span class="cat">'.$related['ManufacturerName'].'</span>
										<p class="price ml-auto">'.$related['RentPricePerHour'].' zl <span>/ Hour</span></p>
									</div>
									<p class="d-flex mb-0 d-block"><a href="single.php?assetID='.$related['id'].'" class="btn btn-secondary py-2 ml-1">Select</a></p>
								</div>
							</div>
						</div>
						';
					}
				?>
			</div>
    	</div>
    </section>

	<script>

		function validateDate(){
			var startDate = document.getElementById("book_pick_date").value;
    		var endDate = document.getElementById("book_off_date").value;
			var now = new Date();
  			now.setHours(0,0,0,0);
			var sdate = new Date(startDate);
			const msBetweenDates = Math.abs(sdate.getTime() - now.getTime());
			const daysBetweenDates = msBetweenDates / (24 * 60 * 60 * 1000);
			if (daysBetweenDates < 10) {
				if (Date.parse(startDate) < now){
					document.getElementById('message').style.color = 'red';
					document.getElementById('message').innerHTML = " Selected pickup date is in the past. ";
					return false;
				}
			}
			else {
				document.getElementById('message').style.color = 'red';
				document.getElementById('message').innerHTML = " Selected pickup date should be within 10 days. ";
				return false;
			}
			if (Date.parse(startDate) > Date.parse(endDate)){
				document.getElementById('message').style.color = 'red';
				document.getElementById('message').innerHTML = " Drop off date should be equal to or greater than Pick up date. ";
				return false;
			}
            else{
                return true;
            }
		}

	</script>
    
<?php
    include('footer.php');
?>