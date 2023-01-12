<?php
    include('header.php');
    try {
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            $where['id']= '="'.$role.'"';
			$database=new Database();
            $dept=$database->getRow("role","*",$where);
            $allow = array("1", "2", "5", "6","7");
			if (in_array($dept['DeptID'], $allow)){
				?>
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Rentals</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rentals</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Returns:</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Application Number</th>
                                                <th>Client Name</th>
                                                <th>Asset Name</th>
                                                <th>Payment per Hour</th>
                                                <th>Application Date</th>
                                                <th>Pick-up Date</th>
                                                <th>Planned Return Date</th>
                                                <th>Actual Return Date</th>
                                                <th>Pick-up Location</th>
                                                <th>Drop-Off Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $database=new Database();
                                        $whereapplication['ApplicationStatusID']="=4";
                                        $rentalapplications=$database->getRows("rentapplications","*",$whereapplication);
                                        foreach ($rentalapplications as $rentalapplication){
                                            $wherepickup['id']="=".$rentalapplication['PickUpLocation'];
                                            $wheredropoff['id']="=".$rentalapplication['DropOffLocation'];
                                            $apppickuplocation=$database->getRow("assetlocations","*",$wherepickup);
                                            $appdropofflocation=$database->getRow("assetlocations","*",$wherepickup);
                                            echo '<tr class="clickable-row" data-href="viewreturn.php?id='.$rentalapplication['id'].'" style="cursor: pointer;">
                                                    <td>#'.$rentalapplication['id'].'</td>
                                                    <td>'.$rentalapplication['ClientFirstName'].' '.$rentalapplication['ClientLastName'].'</td>
                                                    <td>'.$rentalapplication['AssetName'].'</td>
                                                    <td>'.$rentalapplication['PaymentPerHr'].'</td>
                                                    <td>'.$rentalapplication['ApplicationDate'].'</td>
                                                    <td>'.$rentalapplication['PickupDate'].'</td>
                                                    <td>'.$rentalapplication['ReturnDate'].'</td>
                                                    <td>'.$rentalapplication['ActualReturnDate'].'</td>
                                                    <td>'.$apppickuplocation['Address'].', '.$apppickuplocation['PostCode'].', '.$apppickuplocation['CityName'].'</td>
                                                    <td>'.$appdropofflocation['Address'].', '.$appdropofflocation['PostCode'].', '.$appdropofflocation['CityName'].'</td>
                                                </tr>';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Application Number</th>
                                                <th>Client Name</th>
                                                <th>Asset Name</th>
                                                <th>Payment per Hour</th>
                                                <th>Application Date</th>
                                                <th>Pick-up Date</th>
                                                <th>Planned Return Date</th>
                                                <th>Actual Return Date</th>
                                                <th>Pick-up Location</th>
                                                <th>Drop-Off Location</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
            <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
            <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
            <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
            <script>
                $('#zero_config').DataTable();

                jQuery(document).ready(function($) {
                    $(".clickable-row").click(function() {
                        window.location = $(this).data("href");
                    });
                });
            </script>              
                <?php
			}
            else{
                header("Location: index.php");
            }
        }
        else{
            echo "Account Role error. Contact IT Administrator.";
        }
    }
    catch (Exception $e) {
        echo "No Role error. Contact IT Administrator.";
    }
    include('footer.php');
?>