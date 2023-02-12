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
                        <h4 class="page-title">View Asset</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="inventory.php">Assets</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View</li>
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
                        $whererentasset['id']= '="'.$id.'"';
                        $whereimage['DeviceID']='="'.$id.'"';
                        $database=new Database();
                        $results1=$database->getRow("assets","*",$whererentasset);
                        $results3=$database->getRows("devicephotogallery","*",$whereimage);
                    ?>
                    <thead class='thead-dark'>
                        <tr>
                            <th colspan='4'>
                                <h1 style='text-align: left;font-weight: bold;'><?php echo $results1['AssetName']?></h1>
                            </th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td colspan='3'></td>
                            <td >
                                <div class="row" style="text-align: right;">
                                    <div class="col" >
                                        <a href="assethistory.php?id=<?php echo $id;?>" style="color: gray;"> 
                                            <i class='fas fa-history' style='font-size:24px'></i> History 
                                        </a>
                                        <a href="editasset.php?id=<?php echo $id;?>" style="color: blue;"> 
                                            <i class='fas fa-edit' style='font-size:24px'></i> Edit 
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr style='font-size:15pt;'>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-weight: bold;"> Rent per hour (zl): </label>
                                        <?php echo $results1['RentPricePerHour']?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="../../DB/process.php?action=changestatus&id=<?php echo $id; ?>" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <label style="font-weight: bold;"> Status: </label>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="assetstatus" id="assetstatus" required>
                                                <?php 
                                                    $whereresult['id']="";
                                                    $statusresults=$database->getRows("assetstatus","*",$whereresult,"AND","Name asc");
                                                    foreach($statusresults as $statusresult){
                                                        if ($results1['CurrentRentStatusID']==$statusresult['id']){
                                                            echo '<option value="' .$statusresult['id'].'" selected>' . $statusresult['Name']. '</option>';
                                                        }
                                                        else{
                                                            echo '<option value="' .$statusresult['id'].'">' . $statusresult['Name']. '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="submit" name="submit" value="Change" class='btn btn-success mb-2'>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td colspan="2">
                                <form action="../../DB/process.php?action=changedisplaypic&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <img src="<?php echo $results1['PhotoLinks']?>" width="500px" height="400px" class='rounded mx-auto d-block'>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label style="font-weight: bold;"> Change display picture: </label>
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control" id="validatedCustomFile" name="fileToUpload" required>
                                        </div>
                                        <div class="col">
                                            <input type="submit" name="submit" value="Change" class='btn btn-info'>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr style='font-size:15pt;'>
                            <td><label style="font-weight: bold;"> Device number: </label><?php echo $results1['AssetNumber']?></td>
                            <td><label style="font-weight: bold;">Manufacturer: </label><?php echo $results1['ManufacturerName']?></td>
                            <td><label style="font-weight: bold;">Model Type: </label><?php echo $results1['AssetTypeName']; ?></td>
                            <td><label style="font-weight: bold;"> Registration Date: </label><?php echo $results1['RegistrationDate']?></td>
                        </tr>
                        <tr style='font-size:15pt;'>
                            <td colspan="2"></td>
                            <td><label style="font-weight: bold;">Address: </label><?php echo $results1['AssetAddress'].", ".$results1['AssetPostCode'].", ".$results1['AssetCityName']; ?></td>
                            <td><label style="font-weight: bold;"> Last Online:  </label><?php echo $results1['LastLocationDate']?></td>
                        </tr>
                        <tr style='font-size:12pt;'>
                            <td colspan='2'><p style='font-size:15pt;font-weight: bold;'>Description:</p><textarea class='form-control' rows='8'name="Description" required disabled="true"><?php echo $results1['Description']?></textarea></td>
                            <td colspan='2'><p style='font-size:15pt;font-weight: bold;'>Features:</p><textarea class='form-control' rows='8' name="Features" required disabled="true"><?php echo $results1['Features']?></textarea></td>
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
                        <tr>
                            <form action="../../DB/process.php?action=addPhotoGallery&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col">
                                            <label style="font-weight: bold;"> Upload more gallery photos: </label>
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control" id="validatedCustomFile" name="filesToUpload[]" multiple required>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <input type="submit" name="submit" value="Submit" class='btn btn-primary'>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    </tbody>
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