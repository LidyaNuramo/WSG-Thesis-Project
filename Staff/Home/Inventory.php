<?php
    include('header.php');
    try {
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            $where['id']= '="'.$role.'"';
			$database=new Database();
            $dept=$database->getRow("Role","*",$where);
            $allow = array("1", "2", "5", "6");
			if (in_array($dept['DeptID'], $allow)){
				?>
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Assets</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Assets</li>
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
                                <h5 class="card-title">Inventory:</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Asset Number</th>
                                                <th>Model Name</th>
                                                <th>Model Type</th>
                                                <th>Catalog Type</th>
                                                <th>Manufacturer Name</th>
                                                <th>Registration Date</th>
                                                <th>Rent Per Hour</th>
                                                <th>Rented Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $database=new Database();
                                        $assets=$database->getRows("Assets","*");
                                        foreach ($assets as $asset){
                                            echo '<tr>
                                                <td>'.$asset['AssetNumber'].'</td>
                                                <td>'.$asset['AssetName'].'</td>
                                                <td>'.$asset['AssetTypeName'].'</td>
                                                <td>'.$asset['CatalogType'].'</td>
                                                <td>'.$asset['ManufacturerName'].'</td>
                                                <td>'.$asset['RegistrationDate'].'</td>
                                                <td>'.$asset['RentPricePerHour'].'</td>
                                                <td>'.$asset['TotalRentedDays'].'</td>
                                                </tr>';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Asset Number</th>
                                                <th>Model Name</th>
                                                <th>Model Type</th>
                                                <th>Catalog Type</th>
                                                <th>Manufacturer Name</th>
                                                <th>Registration Date</th>
                                                <th>Rent Per Hour</th>
                                                <th>Rented Days</th>
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