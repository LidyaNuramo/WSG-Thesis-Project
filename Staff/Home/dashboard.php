            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">Dashboard</h4>
                            <div class="ms-auto text-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Sales Cards  -->
                    <!-- ============================================================== -->
                    <!-- Sales chart -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">Users Analysis</h4>
                                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                            $database = new Database();
                                            $allusers = $database->getRows("Clients","*");
                                            $allcount = count($allusers);
                                            $currentcount = 0;
                                            foreach ($allusers as $user){
                                                date_default_timezone_set("Europe/Warsaw"); 
			                                    $currentdate = date("Y-m-d h:i:s");
                                                $today = new DateTime($currentdate);
                                                $userdate = new DateTime($user['CreatedOn']);
                                                if($userdate->format('m') === $today->format('m') && $userdate->format('Y') === $today->format('Y')) {
                                                    $currentcount = $currentcount + 1 ;
                                                }
                                            }
                                        ?>
                                        <div class="col-md-6 border-left text-center pt-2">
                                            <h3 class="mb-0 fw-bold"><?php echo $currentcount; ?></h3>
                                            <span class="text-muted">New Users This month</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="peity_line_neutral left text-center mt-2">
                                                <span>
                                                    <span style="display: none;">10,15,8,14,13,10,10</span>
                                                    <canvas width="50" height="24"></canvas>
                                                </span>
                                                <h6>10% of all users</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">Rental Analysis</h4>
                                            <h5 class="card-subtitle"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- column -->
                                        <div class="col-lg-9">
                                            
                                         </div>
                                        <!-- column -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">Assets Analysis</h4>
                                            <h5 class="card-subtitle"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- column -->
                                        <div class="col-lg-9">
                                            
                                         </div>
                                        <!-- column -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--script>

                    function load_dashboard() {
                        $("#content").load("https://lidyagnuramo.grafana.net/public-dashboards/0892ce48b7eb4c158f83b97f75be1d00");
                    }

                    load_dashboard();

                </script-->
