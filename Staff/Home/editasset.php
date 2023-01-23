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
                        <h4 class="page-title">Edit Asset</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="inventory.php">Assets</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            $where['id']= '='.$id;
                            $whereimage['DeviceID']='='.$id;
                            $database=new Database();
                            $results1=$database->getRow("assets","*",$where);
                            $results3=$database->getRows("devicephotogallery","*",$whereimage);
                        ?>
                    <form action="../../DB/process.php?action=updateasset&id=<?php echo $id; ?>" method="post">
                        <thead class='thead-dark'>
                            <tr>
                                <th colspan='4'><h1 style='text-align: left;font-weight: bold;'><input type="text" class="form-control" placeholder="Asset Name" name='Name' value="<?php echo $results1['AssetName']?>" style="font-size: 24px;" required></h1></th>
                            </tr>
                        </thead>
                        <tbody>  
                            <tr>
                                <td colspan='3'></td>
                                <td style="text-align: right;"><i class="fa fa-save" style='font-size:15pt;'></i> <input type="submit" name="submit" value="Save Changes" class='btn btn-dark'></td>
                            </tr>
                            <tr style='font-size:15pt;'>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;"> Rent per hour (zl): </font>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" placeholder="Price" name='rent' value="<?php echo $results1['RentPricePerHour']?>" required>
                                        </div>
                                    </div>
                                </td>
                                <td>
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
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col">
                                            <img src='<?php echo $results1['PhotoLinks']?>' width="500px" height="400px" class='rounded mx-auto d-block'>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style='font-size:15pt;'>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;"> Device number: </font>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" placeholder="Asset Number" name='AssetNumber' value="<?php echo $results1['AssetNumber']?>" required>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;">Manufacturer: </font>
                                        </div>
                                        <div class="col">
                                            <select class="form-control"  name="Manufacturer" required>
                                                <option selected disabled>Choose...</option>
                                                <?php
                                                    $database=new Database();
                                                    $where['id']="";
                                                    $Manufacturers=$database->getRows("manufacturer","*",$where,"AND","Name asc");
                                                    $rr="";
                                                    foreach($Manufacturers as $Manufacturer){
                                                        if ($results1['ManufacturerID']==$Manufacturer['id']){
                                                            echo '<option value="' .$Manufacturer['id'].'" selected>' . $Manufacturer['Name']. '</option>';
                                                        }
                                                        else{
                                                            echo '<option value="' .$Manufacturer['id'].'">' . $Manufacturer['Name']. '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;">Model Type: </font>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" id="AssetType" name="AssetType">
                                                <option disabled selected> Choose Asset Type...</option>
                                                <?php
                                                    $database=new Database();
                                                    $where['AssetTypeId']='="'.$results1['CatalogTypeID'].'"';
                                                    $types=$database->getRows("type","*",$where,"AND","Name");
                                                    foreach($types as $type){
                                                        if ($results1['AssetTypeId']==$type['id']){
                                                            echo '<option value="' .$type['id'].'" selected>' . $type['Name']. '</option>';
                                                        }
                                                        else{
                                                            echo '<option value="' .$type['id'].'">' . $type['Name']. '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <font style="font-weight: bold;"> Registration Date: </font><?php echo $results1['RegistrationDate']?>
                                </td>
                            </tr>
                            <tr style='font-size:15pt;'>
                                <td colspan="2"></td>
                                <td>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <font style="font-weight: bold;">Address: </font>
                                        </div>
                                        <div class="col">
                                            <select class="form-control"  name="assetlocation" required>
                                                <option selected disabled>Choose...</option>
                                                <?php
                                                    $database=new Database();
                                                    $wherelocation['id']="";
                                                    $locationresults=$database->getRows("assetlocations","*",$wherelocation,"AND","CityName asc");
                                                    foreach($locationresults as $locationresult){
                                                        if ($results1['CurrentAssetLocationID']==$locationresult['id']){
                                                            echo "<option value=".$locationresult['id']." selected>".$locationresult['Address'].", ".$locationresult['PostCode'].", ".$locationresult['CityName']."</option>";
                                                        }
                                                        else{
                                                            echo "<option value=".$locationresult['id'].">".$locationresult['Address'].", ".$locationresult['PostCode'].", ".$locationresult['CityName']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <font style="font-weight: bold;"> Last Online:  </font><?php echo $results1['LastLocationDate']?>
                                </td>
                            </tr>
                            <tr style='font-size:12pt;'>
                                <td colspan='2'><p style='font-size:15pt;font-weight: bold;'>Description:</p><textarea class='form-control' rows='8'name="Description" required><?php echo $results1['Description']?></textarea></td>
                                <td colspan='2'><p style='font-size:15pt;font-weight: bold;'>Features:</p><textarea class='form-control' rows='8' name="Features" required><?php echo $results1['Features']?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="lightbox-gallery">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
                                        <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"-->
                                        <div class="photo-gallery">
                                            <div class="container">
                                                <div class="intro">
                                                    <h2 class="text-center">Photo Gallery</h2>
                                                </div>
                                                <div class="row photos">
                                                    <?php
                                                    $database=new Database();
                                                    $where2['DeviceID']='="'.$id.'"';
                                                    $photoresults=$database->getRows("devicephotogallery","*",$where2);
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
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
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