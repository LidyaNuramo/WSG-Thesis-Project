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
                        <h4 class="page-title">Returned Rental</h4>
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
                <table class="table table-bordered table-secondary">
                    <?php
                        $id=$_GET['id'];
                        $wherearentaplication['id']= '="'.$id."'";
                        $database=new Database();
                        $results1=$database->getRow("rentapplications","*",$wherearentaplication);
                        $wherepickup['id']="='".$results1['PickUpLocation']."'";
                        $wheredropoff['id']="='".$results1['DropOffLocation']."'";
                        $apppickuplocation=$database->getRow("assetlocations","*",$wherepickup);
                        $appdropofflocation=$database->getRow("assetlocations","*",$wherepickup);
                                            
                    ?>
                    <thead class='thead-dark'>
                        <tr>
                            <th colspan='4'><h1 style='text-align: left;font-weight: bold;'>Order #<?php echo $results1['id']?></h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Asset Name: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['AssetName'];?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Client Name: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['ClientFirstName'].' '.$results1['ClientLastName'];?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Payment per Hour: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['PaymentPerHr'];?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Application Date: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['ApplicationDate'];?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Pick-up Date: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['PickupDate'];?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Planned Return Date: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['ReturnDate'];?>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Pick-up Location: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $apppickuplocation['Address'].', '.$apppickuplocation['PostCode'].', '.$apppickuplocation['CityName'];?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php
                                    $database=new Database();
                                    $assetlocated['DeviceId']="='".$results1['DeviceId']."'";
                                    $assetgpslocations1=$database->getRows("gpslocation","*",$assetlocated,"AND","id desc",1);
                                    if (!empty($assetgpslocations1)){
                                        foreach ($assetgpslocations1 as $assetgpslocation1){
                                            $src="https://maps.google.com/maps?q=".$assetgpslocation1['Lat'].",".$assetgpslocation1['Long']."&z=16&output=embed";
                                        }
                                        //$src2="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=16&ie=UTF8&iwloc=&output=embed";
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Last ping location at: </font> <?php echo $assetgpslocation1['LocationDate']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mapouter">
                                            <div class="gmap_canvas">
                                                <iframe width="600px" height="500px" id="gmap_canvas" src="<?php echo $src; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'></iframe>
                                                <br>
                                                <a href="https://www.embedgooglemap.net">google maps in website</a>
                                                <style>
                                                    .mapouter{position:relative;text-align:right;height:500px;width:600px;}
                                                    .gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}
                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </td>
                            <td colspan="2">
                                <?php
                                    $database=new Database();
                                    $whereasset['id']='="'.$results1['DropOffLocation'].'"';
                                    $assetlocate=$database->getRow("assetlocations","*",$whereasset);
                                    $address=$assetlocate['Address'].", ".$assetlocate['CityName'].", ".$assetlocate['CountryName'];
                                    $urladdress = str_replace(' ', '%20', $address);
                                    $src2="https://maps.google.com/maps?q=".$urladdress."&z=16&ie=UTF8&iwloc=&output=embed";
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Drop Off/Returned date: </font> <?php echo $results1['ActualReturnDate']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mapouter">
                                            <div class="gmap_canvas">
                                                <iframe width="600px" height="500px" id="gmap_canvas" src="<?php echo $src2; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));'></iframe>
                                                <br>
                                                <a href="https://www.embedgooglemap.net">google maps in website</a>
                                                <style>
                                                    .mapouter{position:relative;text-align:right;height:500px;width:600px;}
                                                    .gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}
                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <form action="../../DB/process.php?action=confirmreturn&id=<?php echo $id; ?>" method="post">
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;"> Custom Fee Description: </font>
                                        </div>
                                        <div class="col">
                                            <textarea class='form-control' rows='8'name="customfeedesc" required>None</textarea>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;">Custom Fee Amount: </font>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" placeholder="0" name='customfee' value="0" required>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col">
                                            <input type="submit" name="submit" value="Confirm Return" class='btn btn-dark'>
                                        </div>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
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