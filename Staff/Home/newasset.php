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
                        <h4 class="page-title">Register a new Asset</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="inventory.php">Assets</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <form action="../../DB/process.php?action=addAsset&type=<?php echo $_GET['type']; ?>" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-dark">
                        <tbody>
                            <tr>
                                <td><label for="Name">Name</label> <input type="text" class="form-control" placeholder="Asset Name" name='Name' required></td>
                                <td><label for="AssetNumber">Device number (Unique) </label> <input type="number" class="form-control" placeholder="Asset Number" name='AssetNumber' required></td>
                                <td colspan="2"><label for="assetlocation">Asset location</label>
                                    <select class="form-control"  name="assetlocation" required>
                                        <option selected disabled>Choose...</option>
                                        <?php
                                            $database=new Database();
                                            $where['id']="";
                                            $results=$database->getRows("assetlocations","*",$where,"AND","CityName asc");
                                            $rr="";
                                            foreach($results as $result){
                                                $rr=$rr."<option value=".$result['id'].">".$result['Address'].", ".$result['PostCode'].", ".$result['CityName']."</option>";
                                            }
                                            echo $rr;
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="Name">Manufacturer</label>
                                    <select class="form-control"  name="Manufacturer" required>
                                        <option selected disabled>Choose...</option>
                                        <?php
                                            $database=new Database();
                                            $where['id']="";
                                            $Manufacturers=$database->getRows("manufacturer","*",$where,"AND","Name asc");
                                            $rr="";
                                            foreach($Manufacturers as $Manufacturer){
                                                $rr=$rr."<option value=".$Manufacturer['id'].">".$Manufacturer['Name']."</option>";
                                            }
                                            echo $rr;
                                        ?>
                                    </select>
                                </td>
                                <td><label for="AssetNumber">Model Type</label> 
                                    <select class="form-control" id="AssetType" name="AssetType" required>
                                        <option disabled selected> Choose Asset Type...</option>
                                        <?php
                                            $database=new Database();
                                            $where['AssetTypeId']='="'.$_GET['type'].'"';
                                            $types=$database->getRows("type","*",$where,"AND","Name");
                                            foreach($types as $type){
                                                echo '<option value="' .$type['id'].'">' . $type['Name']. '</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <label class="col-md-3">Picture Upload</label>
                                    <input type="file" class="form-control" id="validatedCustomFile" name="fileToUpload" required>
                                </td>
                                <td><label for="AssetNumber">Rent per hour (in Zl) </label> <input type="number" class="form-control" placeholder="Price" name='rent' required></td>
                            </tr>
                            <tr>
                                <td colspan="4"><label for="Description">Description</label> <textarea class='form-control' name='Description' rows='8'name="Description" required></textarea></td>
                            </tr>
                                <?php 
                                if ($_GET['type'] == 2){
                                    echo '
                                    <tr>
                                        <td rowspan="4"><label>Features</label></td>
                                            <td>Mileage <input type="number" class="form-control" placeholder="Mileage" name="Mileage" required></td>
                                            <td>Transmission <input type="text" class="form-control" placeholder="Transmission" name="Transmission" required></td>
                                            <td >Fuel <input type="text" class="form-control" placeholder="Fuel" name="Fuel" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Luggage <input type="text" class="form-control" placeholder="Luggage" name="Luggage" required></td>
                                        <td colspan="1">Seats <input type="text" class="form-control" placeholder="Seats" name="Seats" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><label for="Includes">Includes</label> <textarea class="form-control" name="Includes" rows="3" name="Includes" required></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><label for="Includes">Not Included</label> <textarea class="form-control" name="NotIncluded" rows="3" name="NotIncluded" required></textarea></td>
                                    </tr>
                                    ';
                                }
                                else {
                                    echo '
                                        <tr>
                                            <td rowspan="2"><label>Features</label></td>
                                            <td colspan="4"><label for="Includes">Includes</label> <textarea class="form-control" name="Includes" rows="3" name="Includes" required></textarea></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><label for="Includes">Not Included</label> <textarea class="form-control" name="NotIncluded" rows="3" name="NotIncluded" required></textarea></td>
                                        </tr>
                                    ';
                                }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td><input type="submit" name="submit" value="Submit" class='btn btn-primary' style="float:right"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
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