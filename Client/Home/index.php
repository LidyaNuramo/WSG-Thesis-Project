<?php
	require_once('header.php');
?>

      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
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
				<!--li class="nav-item"><a href="news.php" class="nav-link">News</a></li-->
				<li class="nav-item"><a href="contact.php" class="nav-link">Help</a></li>
				<li class="nav-item" id="nav-item-drop-down"><a href="#" class="nav-link"><?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?></a>
					<div class="dropdown-content">
						<a href="#" class="nav-link">Edit Profile</a>
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
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('../Images/car1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">Rent &amp; Travel at your convienience</h1>
	            <p style="font-size: 18px;">Browser the catalog to see which items meets your travel needs and rent online.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-12	featured-top">
    				<div class="row no-gutters">
	  					<div class="col-md-4 d-flex align-items-center">
						  	<?php 
							  	$pickupcity = NULL;
								$dropoffcity = NULL;
								$book_pick_date = NULL;
								$book_off_date = NULL;
								$time_pick = NULL;
								$catagory=  NULL;
								if(!empty($_GET['action'])){
									switch($_GET['action']){
										case 'load':
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
							<form action="index.php?action=load" class="request-form ftco-animate bg-primary" method="POST" onsubmit="return validateDate()" autofocus>
								<h2>Search your trip</h2>
								<div class="form-group">
									<label for="" class="label">Pick-up location</label>
									<select class="form-control" id="city" id="pickupcity" name="pickupcity" placeholder="City" name="city" required>
										<?php
											if(!empty($catagory)){
												?><option disabled>City</option><?php
											}
											else{
												?><option disabled selected>City</option><?php
											}
                                            $database=new Database();
                                            $where['id']="";
                                            $results=$database->getRows("City","*",$where,"AND","Name");
                                            foreach($results as $result){
												if(!empty($catagory) && $result['id']==$pickupcity){
													echo '<option value="' .$result['id'].'" selected style="color: black; size:6;">' . $result['Name']. '</option>';
												}
												else{
													echo '<option value="' .$result['id'].'" style="color: black; size:6;">' . $result['Name']. '</option>';
												}
                                            }
                                        ?>
                                    </select>
								</div>
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
                                            $results=$database->getRows("City","*",$where,"AND","Name");
                                            foreach($results as $result){
												if(!empty($catagory) && $result['id']==$dropoffcity){
													echo '<option value="' .$result['id'].'" selected style="color: black; size:6;">' . $result['Name']. '</option>';
												}
												else{
													echo '<option value="' .$result['id'].'" style="color: black; size:6;">' . $result['Name']. '</option>';
												}
                                            }
                                        ?>
                                    </select>
								</div>
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
									<input type="text" class="form-control" id="time_pick" name="time_pick" placeholder="Time" value="<?php if(!empty($timepick)){echo $timepick;}?>" required>
								</div>
								<div class="form-group">
									<label for="" class="label">I'm looking for a </label>
									<select class="form-control" id="catagory" name="catagory" style="color: black; size:6;" required>
										<?php
											if(!empty($catagory)){
												?>
												<option disabled style='color: black; size:6;'> </option>
												<?php
												$items=['Bicycle','car','Motorscyle','Scooter'];
												$i=0;
												while ($i<4){
													if (($i+1)==$catagory){
														echo "<option value=".($i+1)." selected style='color: black; size:6;'>".$items[$i]."</option>";
													}
													else{
														echo "<option value=".($i+1)." style='color: black; size:6;'>".$items[$i]."</option>";
													}
													$i=$i+1;
												}
											}
											else{
											?>
												<option disabled selected style="color: black; size:6;"> </option>
												<option value="1" style="color: black; size:6;">Bicycle</option>
												<option value="2" style="color: black; size:6;">Car</option>
												<option value="3" style="color: black; size:6;">Motorscyle</option>
												<option value="4" style="color: black; size:6;">Scooter</option>
											<?php
											}
										?>
                                    </select>
								</div>
								<div class="form-group">
									<input type="submit" value="Rent A Car Now" class="btn btn-secondary py-3 px-4">
								</div>
							</form>
						</div>
						<div class="col-md-8 d-flex align-items-center">
							<div class="services-wrap rounded-right w-100" id="here">
								<h3 class="heading-section mb-4">
									<?php 
										if(!empty($_GET['action'])){
											switch($_GET['action']){
												case 'load':
													$pickupcity = $_POST['pickupcity'];
													$dropoffcity = $_POST['dropoffcity'];
													$bookpickdate = $_POST['book_pick_date'];
													$bookoffdate = $_POST['book_off_date'];
													$timepick = $_POST['time_pick'];
													$catagory=  $_POST['catagory'];
													$database=new Database();
													$where['AssetTypeID']='="'.$catagory.'"';
													$results=$database->getRows("Assets","*",$where);
													$carouselIndicators='';
													$carouselInner='<h5 style="font-weight: bold;">No result available with these requirements.</h5>';
													$i=0;
													foreach($results as $result){
														if ($i==0){
															$carouselIndicators='<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
															$carouselInner='<div class="carousel-item active">
																<h5 style="font-weight: bold;">'.$result['AssetName'].'</h5>
																<img class="d-block w-100" src="'.$result['PhotoLinks'].'" alt="'.$result['AssetTypeName'].'" style="width:100px;height:300px;">
																<div style="width: 100%; display:table;">
																	<div class="introwrapper" style="float:left;height:100%; width:50%;display:table-cell;">
																		<button id="info" class="btn btn-block btn-lg btn-info" type="submit" onclick="showInfo()">Show features</button>
																	</div>
																	<div class="introwrapper" style="float:left;height:100%; width:50%;display:table-cell;">
																		<a href="single.php?assetID='.$result['id'].'"><button id="info" class="btn btn-block btn-lg btn-success" type="submit">View full '.$result['CatalogType'].' Info</button></a>
																	</div>
																</div>
																<p style="font-weight: bold;"> Price: '.$result['RentPricePerHour'].' zl / Hour </p>
																<span id="infobox" style="display: none; color: black; background:rgba(255,255,255, 0.9); font-size:10pt; text-align: justify; white-space: pre-line;">
																	<p>'.$result['Features'].'</p>
																</span>
															</div>';
															}
														else{
															$carouselIndicators=$carouselIndicators.'<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
															$carouselInner=$carouselInner.'<div class="carousel-item active">
																<h5 style="font-weight: bold;">'.$result['AssetName'].'</h5>
																<img class="d-block w-100" src="'.$result['PhotoLinks'].'" alt="'.$result['AssetTypeName'].'" style="width:100px;height:300px;">
																<div style="width: 100%; display:table;">
																	<div class="introwrapper" style="float:left;height:100%; width:50%;display:table-cell;">
																		<button id="info" class="btn btn-block btn-lg btn-info" type="submit" onclick="showInfo()">Show features</button>
																	</div>
																	<div class="introwrapper" style="float:left;height:100%; width:50%;display:table-cell;">
																		<a href="single.php?assetID='.$result['id'].'"><button id="info" class="btn btn-block btn-lg btn-success" type="submit">View full '.$result['CatalogType'].' Info</button></a>
																	</div>
																</div>
																<p style="font-weight: bold;"> Price: '.$result['RentPricePerHour'].' zl / Hour </p>
																<span id="infobox" style="display: none; color: black; background:rgba(255,255,255, 0.9); font-size:10pt; text-align: justify; white-space: pre-line;">
																	<p>'.$result['Features'].'</p>
																</span>
															</div>';
														}
														$i=$i+1;
													}
													?>
													<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
														<ol class="carousel-indicators">
															<?php
																echo $carouselIndicators;
															?>
														</ol>
														<div class="carousel-inner">
															<?php
																echo $carouselInner;
															?>
														</div>
														<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
														</a>
														<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
														</a>
													</div>
													<?php
													break;
											}
										}
										else{
									?> 
								Better Way to Rent Your Perfect Cars</h3>
								<div class="row d-flex mb-4">
								<div class="col-md-4 d-flex align-self-stretch ftco-animate">
								<div class="services w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
								<div class="text w-100">
									<h3 class="heading mb-2">Choose Your Pickup Location</h3>
								</div>
								</div>      
								</div>
								<div class="col-md-4 d-flex align-self-stretch ftco-animate">
								<div class="services w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
								<div class="text w-100">
									<h3 class="heading mb-2">Select the Best Deal</h3>
									</div>
								</div>      
								</div>
								<div class="col-md-4 d-flex align-self-stretch ftco-animate">
								<div class="services w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
								<div class="text w-100">
									<h3 class="heading mb-2">Reserve Your Rental Car</h3>
								</div>
								<?php
								}
								?>
							</div>      
						</div>
					</div>
				</div>
			</div>
  		</div>
    </section>

	<script>
		function validateDate(){
			var startDate = document.getElementById("book_pick_date").value;
    		var endDate = document.getElementById("book_off_date").value;
			if (Date.parse(startDate) > Date.parse(endDate)){
					document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = " Drop off date should be equal to or greater than Pick up date. ";
					return false;
			}
            else{
                return true;
            }
		}

		function showInfo(){
			var x = document.getElementById("infobox");
			if (x.style.display === "none") {
				x.style.display = "block";
				document.getElementById('info').innerHTML = "Hide features";
			} else {
				x.style.display = "none";
				document.getElementById('info').innerHTML = "Show features";
			}
		}
	</script>

<?php
    include('footer.php');
?>