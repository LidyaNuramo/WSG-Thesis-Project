<?php
    include('header.php');
    try {
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            $where['id']= '="'.$role.'"';
			$database=new Database();
            $dept=$database->getRow("role","*",$where);
            $allow = array("1", "2", "5", "6");
			if (in_array($dept['DeptID'], $allow)){
				?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Customers</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Customers</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Accounts:</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>Country</th>
                                                <th>Created On</th>
                                                <th>Last Modified On</th>
                                                <th>Payment method added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $database=new Database();
                                        $users=$database->getRows("clients","*");
                                        foreach ($users as $user){
                                            echo '<tr class="clickable-row" data-href="editcaccount.php?id='.$user['id'].'" style="cursor: pointer;">
                                                <td>'.$user['FullName'].'</td>
                                                <td>'.$user['Email'].'</td>
                                                <td>'.$user['CityName'].'</td>
                                                <td>'.$user['CountryName'].'</td>
                                                <td>'.$user['CreatedOn'].'</td>
                                                <td>'.$user['LastModifiedOn'].'</td>
                                                <td>'.$user['VerificationStatus'].'</td>
                                                </tr>';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>Country</th>
                                                <th>Created On</th>
                                                <th>Last Modified On</th>
                                                <th>Payment method added</th>
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