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
                                <h5 class="card-title">Completed Orders:</h5>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $database=new Database();
                                        $whereapplication['ApplicationStatusID']="=5";
                                        $rentalapplications=$database->getRows("rentapplications","*",$whereapplication);
                                        foreach ($rentalapplications as $rentalapplication){
                                            $wherepickup['id']="=".$rentalapplication['PickUpLocation'];
                                            $wheredropoff['id']="=".$rentalapplication['DropOffLocation'];
                                            $apppickuplocation=$database->getRow("assetlocations","*",$wherepickup);
                                            $appdropofflocation=$database->getRow("assetlocations","*",$wherepickup);
                                            echo '<tr>
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
                                                    <td><button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter'.$rentalapplication['id'].'"> View Reciept </button></td></tr>';
                                            
                                            $wherereceipt['RentApplicationId'] = '='.$rentalapplication['id'];
                                            $receipt = $database->getRow("clientreceipt","*",$wherereceipt);
                                            echo '<!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter'.$rentalapplication['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">'.$rentalapplication['AssetName'].'</h5>
                                                            <button type="button" class="close" data-bs-dismis="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    Application Date: 
                                                                </div>
                                                                <div class="col">
                                                                    '.$rentalapplication['ApplicationDate'].'
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    Pick-up Date: 
                                                                </div>
                                                                <div class="col">
                                                                    '.$rentalapplication['PickupDate'].'
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    Planned Return Date:
                                                                </div>
                                                                <div class="col">
                                                                    '.$rentalapplication['ReturnDate'].'
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    Actual Returned Date:
                                                                </div>
                                                                <div class="col">
                                                                    '.$rentalapplication['ActualReturnDate'].'
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    Payment/Hr:
                                                                </div>
                                                                <div class="col">
                                                                    '.$rentalapplication['PaymentPerHr'].' zl
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
                                                            <button type="button" class="btn btn-secondary" data-bs-dismis="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>';
                                        ?>
                                        <?php
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
                                                <th>Action</th>
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
            <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
            <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
            <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
            <script>
                $('#zero_config').DataTable();
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