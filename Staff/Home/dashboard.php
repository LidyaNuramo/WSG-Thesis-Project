            <link href="assets/libs/chart/bargraph.css" rel="stylesheet">
            
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

                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Users Analysis</h4>
                                    <h5 class="card-subtitle">Overview of Latest Month</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                    $database = new Database();
                                    $allusers = $database->getRows("clients","*");
                                    $allcount = count($allusers);
                                    $currentcount = 0;
                                    $months = array("Jan", "Feb", "March", "April", "May", "June", "July", "August", "Sept", "Oct", "Nov", "Dec");
                                    $monthscount = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                    $monthspercentage = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                    foreach ($allusers as $user){
                                        date_default_timezone_set("Europe/Warsaw"); 
                                        $currentdate = date("Y-m-d h:i:s");
                                        $today = new DateTime($currentdate);
                                        $userdate = new DateTime($user['CreatedOn']);
                                        if($userdate->format('m') === $today->format('m') && $userdate->format('Y') === $today->format('Y')) {
                                            $currentcount = $currentcount + 1 ;
                                        }
                                        if($userdate->format('Y') === $today->format('Y')) {
                                            $month = (int) $userdate->format('m') - 1;
                                            $monthscount[$month] = $monthscount[$month] + 1;
                                        }
                                        $percentage = sprintf("%0.2f", ($currentcount/$allcount*100));
                                    }
                                    $index = 0;
                                    foreach ($monthscount as $monthcount){
                                        $monthspercentage[$index] = sprintf("%0.2f", ($monthcount/$allcount*100));
                                        $index = $index + 1;
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="peity_line_neutral left text-center mt-2">
                                        <h3 class="mb-0 fw-bold"><?php echo $currentcount; ?></h3>
                                        New Users This month
                                    </div>
                                </div>
                                <div class="col-md-6 border-left text-center pt-2">
                                    <div class="col-md-6 border-left text-center pt-2">
                                        <h3 class="mb-0 fw-bold"><?php echo $percentage; ?>%</h3>
                                        <span class="text-muted">New users of all users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table class="graph">
                                    <caption>User account creation from 01 - <?php echo ($today->format('m')).", ".($today->format('Y'));?></caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Month</th>
                                            <th scope="col">Percent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $start = 0;
                                            $stop = (int) $today->format('m');
                                            while ($start < $stop){
                                                echo '
                                                <tr style="height:'.$monthspercentage[$start].'%">
                                                    <th scope="row">'.$months[$start].'</th>
                                                    <td><span>'.$monthspercentage[$start].'%</span></td>
                                                </tr>';
                                                $start = $start + 1;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Rental Analysis</h4>
                                        <h5 class="card-subtitle"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                    $database = new Database();
                                    $allrentals = $database->getRows("rentapplications","*");
                                    $allcount = count($allrentals);
                                    $statuscount = array(
                                        array(0,0),
                                        array(0,0),
                                        array(0,0),
                                        array(0,0),
                                        array(0,0),
                                        array(0,0),
                                        array(0,0)
                                    );
                                    $monthscountcurrent = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                    $monthscountlast = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                    $years = array();
                                    array_push($years, ((int) $today->format('Y')));
                                    array_push($years, ((int) $today->format('Y') - 1));
                                    foreach ($allrentals as $rental){
                                        date_default_timezone_set("Europe/Warsaw"); 
                                        $currentdate = date("Y-m-d h:i:s");
                                        $today = new DateTime($currentdate);
                                        $applicationdate = new DateTime($rental['ApplicationDate']);
                                        if($applicationdate->format('Y') === $today->format('Y')) {
                                            $month = (int) $applicationdate->format('m') - 1;
                                            $monthscountcurrent[$month] = $monthscountcurrent[$month] + 1;
                                            $statusid = (int) $rental['ApplicationStatusID'] - 1;
                                            $statuscount[$statusid][0] = ($statuscount[$statusid][0]) + 1;
                                        }
                                        if(((int) $applicationdate->format('Y')) === ( (int) $today->format('Y') - 1)) {
                                            $month = (int) $applicationdate->format('m') -1;
                                            $monthscountlast[$month] = $monthscountlast[$month] + 1;
                                            $statusid = (int) $rental['ApplicationStatusID'] - 1;
                                            $statuscount[$statusid][1] = ($statuscount[$statusid][1]) + 1;
                                        }
                                    }
                                ?>
                                <caption>Rent Applications in the past two months</caption>
                                <table border="1" id="dataTable">
                                    <tr>
                                        <th style="background-color: grey;">Months</th>
                                        <th style="background-color: grey;"><?php echo $years[0]; ?></th>
                                        <th style="background-color: grey;"><?php echo $years[1]; ?></th>
                                    </tr>
                                    <?php 
                                        $start = 0;
                                        $stop = 12;
                                        while ($start < $stop){
                                            echo '
                                            <tr>
                                                <td style="background-color: lightgrey;">'.$months[$start].'</td>
                                                <td>'.$monthscountcurrent[$start].'</td>
                                                <td>'.$monthscountlast[$start].'</td>
                                            </tr>';
                                            $start = $start + 1;
                                        }
                                    ?>
                                </table>
                                <div id="chartContainer" style="height: 360px; width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="../../assets/libs/chart/customgraph.js"></script>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/data.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
