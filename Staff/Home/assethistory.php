<?php
include('header.php');
    try {
        if(isset($_SESSION['role']) && !empty($_GET['id'])){
            $role = $_SESSION['role'];
            $where['id']= '="'.$role.'"';
			$database=new Database();
            $dept=$database->getRow("role","*",$where);
            $allow = array("1", "2", "5", "6", "7");
			if (in_array($dept['DeptID'], $allow)){
				?>
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Asset History</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="inventory.php">Assets</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">History</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <table class="table table-bordered table-secondary">
                    <?php
                        $id=$_GET['id'];
                        $where['id']= '="'.$id.'"';
                        $whereimage['DeviceID']='='.$id;
                        $database=new Database();
                        $results1=$database->getRow("assets","*",$where);
                    ?>
                    <thead class='thead-dark'>
                        <tr>
                            <th colspan='4'><h1 style='text-align: left;font-weight: bold;'><?php echo $results1['AssetName']?></h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan='3'>
                                <div class="row">
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col" style="text-align: right;">
                                        <a href="viewasset.php?id=<?php echo $id;?>" style="color: gray;"> <i class='fas fa-th-list' style='font-size:24px'></i> View Asset</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Device number: </font>
                                    </div>
                                    <div class="col">
                                        <?php echo $results1['AssetNumber']?>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Status: </font> 
                                    </div>
                                    <div class="col">
                                        <select class="form-control" name="assetstatus" id="assetstatus" disabled>
                                            <?php
                                                echo '<option value="' .$results1['CurrentRentStatusID'].'" selected>' . $results1['CurrentRentStatus'].'</option>';
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!--tr>
                            <td colspan="2">
                                <?php
                                    $database=new Database();
                                    $assetlocated['DeviceId']="='".$_GET['id']."'";
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
                                    $whereasset['id']='='.$id;
                                    $assetlocate=$database->getRow("Assets","*",$whereasset);
                                    $address=$assetlocate['AssetAddress'].", ".$assetlocate['AssetCityName'].", ".$assetlocate['AssetCountryName'];
                                    $urladdress = str_replace(' ', '%20', $address);
                                    $src2="https://maps.google.com/maps?q=".$urladdress."&z=16&ie=UTF8&iwloc=&output=embed";
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Last pickup location: </font> <?php echo $assetlocate['LastLocationDate']; ?>
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
                        </tr-->
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    <div class="col">
                                        <font style="font-weight: bold;"> Rental History: </font>
                                    </div>
                                </div>
                                <?php
                                    $whichrentals['DeviceId']='='.$id;
                                    $database = new Database();
                                    $assetrentals=$database->getRows("rentapplications","*",$whichrentals,"AND","id desc");
                                    foreach ($assetrentals as $assetrental){
                                        $pickup['id'] = '='.$assetrental['PickUpLocation'];
                                        $pickuplocation = $database->getRow("assetlocations","*",$pickup);
                                        $dropoff['id'] ='='.$assetrental['DropOffLocation'];
                                        $dropofflocation = $database->getRow("assetlocations","*",$dropoff);
                                        echo '
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <font style="font-weight: bold;"> '.$assetrental['ClientFirstName'].' '.$assetrental['ClientLastName'].': </font>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                Status: '.$assetrental['RentApplicationStatus'].'
                                            </div>
                                            <div class="col">
                                                Pickup Date: '.$assetrental['PickupDate'].'
                                            </div>
                                            <div class="col">
                                                Dropoff Date: '.$assetrental['ActualReturnDate'].'
                                            </div>
                                            <div class="col">
                                                Pickup Location: '.$pickuplocation['Address'].', '.$pickuplocation['PostCode'].', '.$pickuplocation['CityName'].'
                                            </div>
                                            <div class="col">
                                                Dropoff Location: '.$dropofflocation['Address'].', '.$dropofflocation['PostCode'].', '.$dropofflocation['CityName'].'
                                            </div>
                                        </div>
                                        ';
                                    }
                                ?>
                                <div class="row">
                                    <div class="col">
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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