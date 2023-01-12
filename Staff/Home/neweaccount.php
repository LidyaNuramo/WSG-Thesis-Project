<?php
    include('header.php');
    try {
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            $where['id']= '="'.$role.'"';
			$database=new Database();
            $dept=$database->getRow("role","*",$where);
            $allow = array("1", "4", "5");
			if (in_array($dept['DeptID'], $allow)){
				?>
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Create a new staff account</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="eaccounts.php">Employees</a></li>
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
                <!-- Start Page Content -->
                <div class="card">
                    <?php
                        if(!empty($_GET['action']))
                        {
                            switch($_GET['action'])
                            {
                                case 'no':
                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: red;" class="control-label">An account already exists with this email address.</label>
                                        <br>
                                    </div>
                                </div>
                                <?php 
                                break;
                            }
                        }
                    ?>
                    <div class="card-body wizard-content">
                        <h4 class="card-title">Account Form</h4>
                        <h6 class="card-subtitle"></h6>
                        <form id="example-form" action="../../DB/process.php?action=newstaff" id="accountform" method="POST" class="mt-5">
                            <div>
                                <h3>Personal details</h3>
                                <section>
                                    <label for="name">First name *</label>
                                    <input id="name" name="name" type="text" class="required form-control" required>
                                    <label for="surname">Last name *</label>
                                    <input id="surname" name="surname" type="text" class="required form-control" required>
                                    <label for="phone">Phone *</label>
                                    <input type="number" class="form-control international-inputmask" name="phone" id="international-mask" placeholder="Phone Number"style="-webkit-appearance= none; -moz-appearance= textfield;" required>
                                    <p>(*) Mandatory</p>
                                </section>
                                <h3>Work details</h3>
                                <section>
                                    <label for="city">Job role *</label>
                                    <select class="form-control" id="jobrole" name="jobrole">
                                        <option disabled selected> Choose Dept and role...</option>
                                        <?php
                                            $database=new Database();
                                            $where['id']="";
                                            $depts=$database->getRows("dept","*",$where,"AND","Name");
                                            foreach($depts as $dept){
                                                echo '<optgroup label="'.$dept['Name'].'">';
                                                $whererole['id']='="'.$dept['id'].'"';
                                                $roles=$database->getRows("role","*",$whererole,"AND","Name");
                                                foreach($roles as $role){
                                                    echo '<option value="' .$role['id'].'">' . $role['Name']. '</option>';
                                                }
                                                echo '</optgroup>';
                                            }
                                        ?>
                                    </select>
                                    <label for="city">Office City *</label>
                                    <select class="form-control" id="city" placeholder="City" name="city" required>
                                        <option disabled selected>City</option>
                                        <?php
                                            $database=new Database();
                                            $where['id']="";
                                            $results=$database->getRows("City","*",$where,"AND","Name");
                                            foreach($results as $result){
                                                echo '<option value="' .$result['id'].'">' . $result['Name']. '</option>';
                                            }
                                        ?>
                                    </select>
                                </section>
                                <h3>Account Login</h3>
                                <section>
                                    <label for="email">Email *</label>
                                    <input id="email" name="email" type="text" class="required email form-control">
                                    <label for="password">Password *</label>
                                    <input id="password" name="password" type="password" class="required form-control">
                                    <label for="confirm">Confirm Password *</label>
                                    <input id="confirm" name="confirm" type="password" class="required form-control">
                                    <br>
                                    <button class="btn btn-block btn-lg btn-info" type="submit">Create account</button>
                                    <p>(*) Mandatory</p>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
            <script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
            <script>
                // Basic Example with form
                var form = $("#example-form");
                form.validate({
                    errorPlacement: function errorPlacement(error, element) { element.before(error); },
                    rules: {
                        confirm: {
                            equalTo: "#password"
                        }
                    }
                });
                form.children("div").steps({
                    headerTag: "h3",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    onStepChanging: function (event, currentIndex, newIndex) {
                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onFinishing: function (event, currentIndex) {
                        form.validate().settings.ignore = ":disabled";
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex) {
                    }
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