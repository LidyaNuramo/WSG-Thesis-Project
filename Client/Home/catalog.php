<?php
  include('header.php');
  require_once('../../DB/cloudsql.php');
?>

<?php 
	if(!empty($_GET['type'])){
		$type=$_GET['type'];
		if(!empty($_GET['page'])){
			$page=$_GET['page'];
		}
		else{
			$page=1;
		}
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
				<!--li class="nav-item"><a href="news.php" class="nav-link">News</a></li>
				<li class="nav-item"><a href="contact.php" class="nav-link">Help</a></li-->
				<li class="nav-item" id="nav-item-drop-down"><a href="#" class="nav-link"><?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?></a>
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

	<?php 
		switch($type){
			case '1':
				echo '<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/parkedcycles.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
					<div class="col-md-9 ftco-animate pb-5">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Bicyles <i class="ion-ios-arrow-forward"></i></span></p>
						<h1 class="mb-3 bread">Choose a Bicyle</h1>';
				break;
			case '2':
				echo '<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/parkedcars.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
					<div class="col-md-9 ftco-animate pb-5">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
						<h1 class="mb-3 bread">Choose a Car</h1>';
				break;
			case '3':
				echo '<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/parkedmotorcycles.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
					<div class="col-md-9 ftco-animate pb-5">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Motorcycles <i class="ion-ios-arrow-forward"></i></span></p>
						<h1 class="mb-3 bread">Choose a Motorcycle</h1>';
				break;
			case '4':
				echo '<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(../Images/parkedscooters.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
					<div class="col-md-9 ftco-animate pb-5">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Scooters <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
						<h1 class="mb-3 bread">Choose a Scooter</h1>';
				break;
			}
	?>
          </div>
        </div>
      </div>
    </section>
	
	<section class="ftco-section bg-light">
    	<div class="container">
				<?php
					$i=15;
					$k= $i*($page-1);
					$resultrows="".$k.",".$i.";";
					$database=new Database();
					$where['CatalogTypeID']='="'.$type.'"';
					$where['CurrentRentStatus']='="Available"';
					$results=$database->getRows("Assets","*",$where,"AND",null,$resultrows);
					$count=count($results);
					echo '<div class="row"> 
							<div class="col-md-4" style=""> Results: '.$count.'</div>
							<div class="col-md-4" style=""></div>
							<div class="col-md-4" style=""> Showing: '.$i.' items / page </div>
						</div> <div class="row">';
					foreach ($results as $result){
						echo '
						<div class="col-md-4">
							<div class="car-wrap rounded ftco-animate">
								<div class="img rounded d-flex align-items-end" style="background-image: url('.$result['PhotoLinks'].');"  alt="'.$result['AssetTypeName'].'">
								</div>
								<div class="text">
									<h2 class="mb-0"><a href="car-single.html">'.$result['AssetName'].'</a></h2>
									<div class="d-flex mb-3">
										<span class="cat">'.$result['ManufacturerName'].'</span>
										<p class="price ml-auto">'.$result['RentPricePerHour'].' zl <span>/ Hour</span></p>
									</div>
									<p class="d-flex mb-0 d-block"><a href="single.php?assetID='.$result['id'].'" class="btn btn-secondary py-2 ml-1">Select</a></p>
								</div>
							</div>
						</div>';
					}
				?>
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
				<?php
					$q = $count / $i;
					$f = floor($q);
					$r = $count % $i;
					$j = $f;
					while ($j>0){
						if ($j == $page){
							echo '<li class="active"><span>'.$j.'</span></li>';
						}
						else{
							echo '<li><a href="catalog.php?type='.$type.'&page='.$j.'">'.$j.'</a></li>';
						}
						$j = $j - 1;
					}
					if ($r != 0){
						if ($page == ($f+1)){
							echo '<li class="active"><span>'.($f+1).'</span></li>';
						}
						else{
							echo '<li><a href="catalog.php?type='.$type.'&page='.($f+1).'">2</a></li>';
						}
					}
				?>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>
<?php
    include('footer.php');
?>