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
						<a href="#" class="nav-link">Current Rental</a>
						<a href="#" class="nav-link">History</a>
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
		$result=$database->getRow("Assets","*",$where);
		echo '
		<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/'.$result['PhotoLinks'].');" data-stellar-background-ratio="0.5">
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
					Location: 
					<h2 class="mb-0"><?php echo $result['AssetCityName']; ?></h2>
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
												$catagory=  $_POST['catagory'];
												break;
										}
									}
								?>
						      	<div class="row">
								  	<form action="../../DB/process.php?action=rent" class="request-form ftco-animate bg-primary" method="POST" onsubmit="return validateDate()" autofocus>
									  <div class="form-group">
									<label for="" class="label">Drop-off location</label>
									<select class="form-control" id="city" id="dropoffcity" name="dropoffcity" placeholder="City" name="city" required>
										<?php
											if(!empty($catagory)){
												?><option disabled>City</option><?php
											}
											else{
												?><option disabled selected>City</option><?php
											}
                                            $database=new Database();
                                            $where['id']="";
                                            $results=$database->getRows("assetlocations","DISTINCT id, CityID, CityName",$where,"AND","CityName");
                                            foreach($results as $result){
												if(!empty($catagory) && $result['CityID']==$dropoffcity){
													echo '<option value="'.$result['CityID'].'" selected style="color: black; size:6;">'.$result['CityName'].'</option>';
												}
												else{
													echo '<option value="'.$result['CityID'].'" style="color: black; size:6;">'.$result['CityName'].'</option>';
												}
                                            }
                                        ?>
                                    </select>
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
									$photoresults=$database->getRows("DevicePhotoGallery","*",$where2);
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
				<h2 class="mb-2"><?php echo $result['CatalogType']; ?> in similar location.</h2>
			</div>
			</div>
			<div class="row">
				<?php
					$database=new Database();
					$where['id']='<>"'.$result['id'].'"';
					$where['CatalogTypeID']='="'.$result['CatalogTypeID'].'"';
					$where['CurrentRentStatus']='="Available"';
					$resultrows="3;";
					$relatedresults=$database->getRows("Assets","*",$where,"AND","AssetCityID",$resultrows);
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
    
<?php
    include('footer.php');
?>