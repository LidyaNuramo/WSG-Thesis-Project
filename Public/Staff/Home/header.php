<?php
  session_start();
  if(isset($_SESSION['username'])&& $_SESSION['type']=='staff'){
      include('../../DB/cloudsql.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="rentals, cars, motors, bicycles, scooters, online payment">
        <meta name="description" content="Travel Rental is plaform where you can rent, pay for and get rental cars, motors, bicycles, and scooters through the Internet.">
        <title>MyTravelRentals</title>
        <link rel="icon" type="image/png" sizes="16x16" href="../Images/Logo.png">
        <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
        <link href="dist/css/style.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- Main wrapper - style you can find in pages.scss -->
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
            data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <!-- Topbar header - style you can find in pages.scss -->
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin5">
                        <a class="navbar-brand" href="index.html">
                            <a href="index.php" aria-expanded="false">
                                <img src="../Images/Logo.png" alt="homepage" style="background-color: white;width: 50px; height:50 px;"/>
                                <span class="logo-text">
                                    <span class="hide-menu" style="color:white; font-weight: bold;font-size: 15px;">
                                        MYTRAVEL<span style="color:green;">RENTALS</span>
                                    </span>
                                </span>
                            </a>
                        </a>
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                            <i class="ti-menu ti-close"></i>
                        </a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        <!-- toggle and nav items -->
                        <ul class="navbar-nav float-start me-auto">
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                    <i class="mdi mdi-menu font-24"></i>
                                </a>
                            </li>
                            <!-- Search -->
                            <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                    href="javascript:void(0)"><i class="ti-search"></i></a>
                                <form class="app-search position-absolute">
                                    <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                        class="srh-btn"><i class="ti-close"></i></a>
                                </form>
                            </li>
                        </ul>
                        <!-- Right side toggle and nav items -->
                        <ul class="navbar-nav float-end">
                            <!-- Comment -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['username']." ".$_SESSION['lastname'] ?>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-envelope"></i>
                                </a>
                            </li>
                            <!-- End Comment -->
                            <!-- Messages -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-bell font-24"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                                    <ul class="list-style-none">
                                        <li>
                                            <div class="">
                                                <!-- Message -->
                                                <a href="javascript:void(0)" class="link border-top">
                                                    <div class="d-flex no-block align-items-center p-10">
                                                        <span class="btn btn-success btn-circle"><i
                                                                class="ti-calendar"></i></span>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0">Event today</h5>
                                                            <span class="mail-desc">Just a reminder that event</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="javascript:void(0)" class="link border-top">
                                                    <div class="d-flex no-block align-items-center p-10">
                                                        <span class="btn btn-info btn-circle"><i
                                                                class="ti-settings"></i></span>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0">Settings</h5>
                                                            <span class="mail-desc">You can customize this template</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="javascript:void(0)" class="link border-top">
                                                    <div class="d-flex no-block align-items-center p-10">
                                                        <span class="btn btn-primary btn-circle"><i
                                                                class="ti-user"></i></span>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0">Pavan kumar</h5>
                                                            <span class="mail-desc">Just see the my admin!</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="javascript:void(0)" class="link border-top">
                                                    <div class="d-flex no-block align-items-center p-10">
                                                        <span class="btn btn-danger btn-circle"><i
                                                                class="fa fa-link"></i></span>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0">Luanch Admin</h5>
                                                            <span class="mail-desc">Just see the my new admin!</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </ul>
                            </li>
                            <!-- End Messages -->
                            <!-- User profile and search -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>
                                        My Profile</a>
                                    <a class="dropdown-item" href="../index.php"><i
                                            class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                                    <div class="dropdown-divider"></div>
                                </ul>
                            </li>
                            <!-- User profile and search -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- End Topbar header -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <aside class="left-sidebar" data-sidebarbg="skin5">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav" class="pt-4">
                            <li class="sidebar-item"> 
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span class="hide-menu"> Dashboard </span>
                                </a>
                            </li>
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                    <span class="hide-menu"> Customers </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="caccounts.php" class="sidebar-link">
                                        <i class="fas fa-users"></i>
                                        <span class="hide-menu"> Accounts </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="mdi mdi-message-outline"></i>
                                        <span class="hide-menu"> Message Requests </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="fas fa-bullhorn"></i>
                                        <span class="hide-menu"> Announcements </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-account-key "></i>
                                    <span class="hide-menu"> Employees </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="eaccounts.php" class="sidebar-link">
                                        <i class="mdi mdi-account-multiple"></i>
                                        <span class="hide-menu"> Accounts </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="fas fa-bullhorn"></i>
                                        <span class="hide-menu"> Announcements </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="fas fa-warehouse"></i>
                                    <span class="hide-menu"> Assets </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="Inventory.php" class="sidebar-link">
                                        <i class="fas fa-database"></i>
                                        <span class="hide-menu"> Inventory </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="AvailableAssets.php" class="sidebar-link">
                                        <i class="mdi mdi-car-connected"></i>
                                        <span class="hide-menu"> Available Assets </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="OfflineAssets.php" class="sidebar-link">
                                        <i class="mdi mdi-cloud-outline-off"></i>
                                        <span class="hide-menu"> Offline Assets </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span class="hide-menu"> Rentals </span></a>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="far fa-bookmark"></i>
                                        <span class="hide-menu"> Reservations </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="fas fa-clock"></i>
                                        <span class="hide-menu"> Active Orders </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="far fa-calendar-check"></i>
                                        <span class="hide-menu"> Completed Ordered </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span class="hide-menu"> Finances </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="mdi mdi-chart-bar"></i>
                                        <span class="hide-menu"> Monthly Stats </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link">
                                        <i class="mdi mdi-chart-histogram"></i>
                                        <span class="hide-menu"> Annual Stats </span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
<?php
  }
  else {
    header("Location: ../index.php?action=noaccount");
  }
?>