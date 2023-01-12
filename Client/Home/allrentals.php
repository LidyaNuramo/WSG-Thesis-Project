<?php
	require_once('header.php');
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
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span> Rental History<i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Your rentals</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
		<div class="container-fluid">
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
			?>
			<h5 class="card-title">All rentals:</h5>
			<div class="table-responsive">
				<table id="zero_config" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Application Date</th>
							<th>Pick Up Date</th>
							<th>Drop Off Date</th>
							<th>Pick Up Location</th>
							<th>Drop Off Location</th>
							<th>Status</th>
							<th>Receipt</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$database=new Database();
					$whereapplication['ClientId']= '="'.$_SESSION['userID'].'"';
					$rentals=$database->getRows("rentapplications","*",$whereapplication,"AND","id DESC");
					foreach ($rentals as $rental){
						$wherecity['id'] = '='.$rental['PickUpLocation'];
						$pick = $database->getRow("assetlocations","CityName",$wherecity);
						$wherecity['id'] = '='.$rental['DropOffLocation'];
						$drop = $database->getRow("assetlocations","*",$wherecity);
						$wherereceipt['RentApplicationId'] = '='.$rental['id'];
						$receipt = $database->getRow("clientreceipt","*",$wherereceipt);
						if(!empty($receipt)){
							$lastrow = '<button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter'.$rental['id'].'">View</button>';
						}
						else{
							$lastrow = ' ';
						}
						echo '<tr>
								<td>'.$rental['AssetName'].'</td>
								<td>'.$rental['ApplicationDate'].'</td>
								<td>'.$rental['PickupDate'].'</td>
								<td>'.$rental['ActualReturnDate'].'</td>
								<td>'.$pick['CityName'].'</td>
								<td>'.$drop['CityName'].'</td>
								<td>'.$rental['RentApplicationStatus'].'</td>
								<td>'.$lastrow.'</td>
							</tr>';

						if(!empty($receipt)){
							echo '<!-- Modal -->
							<div class="modal fade" id="exampleModalCenter'.$rental['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">'.$rental['AssetName'].'</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col">
												Application Date: 
											</div>
											<div class="col">
												'.$rental['ApplicationDate'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												Pick-up Date: 
											</div>
											<div class="col">
												'.$rental['PickupDate'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												Planned Return Date:
											</div>
											<div class="col">
												'.$rental['ReturnDate'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												Actual Returned Date:
											</div>
											<div class="col">
												'.$rental['ActualReturnDate'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												Payment/Hr:
											</div>
											<div class="col">
												'.$rental['PaymentPerHr'].' zl
											</div>
										</div>
										<div class="row">
											<div class="col" style="font-weight: bold;">
												Item
											</div>
											<div class="col" style="font-weight: bold;">
												Description
											</div>
											<div class="col" style="font-weight: bold;">
												Type
											</div>
											<div class="col" style="font-weight: bold;">
												Amount in zl
											</div>
										</div>
										<div class="row">
											<div class="col">
												1.
											</div>
											<div class="col">
												Rented Total Amount
											</div>
											<div class="col">
												+
											</div>
											<div class="col">
												'.$receipt['SumRentPayment'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												2.
											</div>
											<div class="col">
												Early Return Discount
											</div>
											<div class="col" style="color: red">
												-
											</div>
											<div class="col" style="color: red">
												'.$receipt['EarlyReturnDiscount'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												3.
											</div>
											<div class="col">
												Late Return Payment
											</div>
											<div class="col">
												+
											</div>
											<div class="col">
												'.$receipt['LateReturnPayment'].'
											</div>
										</div>
										<div class="row">
											<div class="col">
												4.
											</div>
											<div class="col">
												Additional charge pending (updated when proccessing return)
											</div>
											<div class="col">
												+
											</div>
											<div class="col">
												'.$receipt['CustomDescriptionPayment'].'
											</div>
										</div>
										<div class="row" style="font-weight: bold;">
											<div class="col">
												Total Amount: 
											</div>
											<div class="col">
												'.$receipt['TotalAmount'].' zl
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>';
						}
					}
					?>
					</tbody>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>Application Date</th>
							<th>Pick Up Date</th>
							<th>Drop Off Date</th>
							<th>Pick Up Location</th>
							<th>Drop Off Location</th>
							<th>Status</th>
							<th>Receipt</th>
						</tr>
					</tfoot>
				</table>
			</div>
			</div>
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
            <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
            <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
            <script>
                $('#zero_config').DataTable();
            </script> 
        </div>
    </section>


<?php
    include('footer.php');
?>