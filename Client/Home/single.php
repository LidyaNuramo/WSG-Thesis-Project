<?php
  include('/storage/ssd1/167/17747167/public_html/Client/Home/header.php');
  require_once('/storage/ssd1/167/17747167/public_html/Client/DB/main.php');
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
						<a href="#" class="nav-link">Edit Profile</a>
						<a href="#" class="nav-link">Messages</a>
						<a href="#" class="nav-link">Notifications</a>
						<a href="../DB/process.php?action=logout" class="nav-link">Logout</a>
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
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="catalog.php?type='.$result['AssetTypeID'].'">'.$result['CatalogType'].' <i class="ion-ios-arrow-forward"></i></a></span> <span>'.$result['CatalogType'].' details <i class="ion-ios-arrow-forward"></i></span></p>
						<h1 class="mb-3 bread">'.$result['AssetName'].'</h1>
					</div>
				</div>
			</div>
		</section>';

	?>
		

	<section class="ftco-section ftco-car-details">
      	<div class="container">
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
				<span class="subheading">Choose Car</span>
				<h2 class="mb-2">Related Cars</h2>
			</div>
			</div>
			<div class="row">
				<div class="col-md-4">
						<div class="car-wrap rounded ftco-animate">
							<div class="img rounded d-flex align-items-end" style="background-image: url(images/car-1.jpg);">
							</div>
							<div class="text">
								<h2 class="mb-0"><a href="car-single.html">Mercedes Grand Sedan</a></h2>
								<div class="d-flex mb-3">
									<span class="cat">Cheverolet</span>
									<p class="price ml-auto">$500 <span>/day</span></p>
								</div>
								<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="car-single.html" class="btn btn-secondary py-2 ml-1">Details</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="car-wrap rounded ftco-animate">
							<div class="img rounded d-flex align-items-end" style="background-image: url(images/car-2.jpg);">
							</div>
							<div class="text">
								<h2 class="mb-0"><a href="car-single.html">Range Rover</a></h2>
								<div class="d-flex mb-3">
									<span class="cat">Subaru</span>
									<p class="price ml-auto">$500 <span>/day</span></p>
								</div>
								<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="car-single.html" class="btn btn-secondary py-2 ml-1">Details</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="car-wrap rounded ftco-animate">
							<div class="img rounded d-flex align-items-end" style="background-image: url(images/car-3.jpg);">
							</div>
							<div class="text">
								<h2 class="mb-0"><a href="car-single.html">Mercedes Grand Sedan</a></h2>
								<div class="d-flex mb-3">
									<span class="cat">Cheverolet</span>
									<p class="price ml-auto">$500 <span>/day</span></p>
								</div>
								<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="car-single.html" class="btn btn-secondary py-2 ml-1">Details</a></p>
							</div>
						</div>
					</div>
			</div>
    	</div>
    </section>
    
<?php
    include('/storage/ssd1/167/17747167/public_html/Client/Home/footer.php');
?>