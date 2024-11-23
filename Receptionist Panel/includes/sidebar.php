  <?php 
  include 'dbconnection.php';
  session_start();
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS  -->
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<!-- <link href="../css/style.css" rel='stylesheet' type='text/css' /> -->
<!-- font CSS  -->
<!-- font-awesome icons  -->
<link href="../css/font-awesome.css" rel="stylesheet"> 
 <!-- //font-awesome icons  -->
  
 <script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/modernizr.custom.js"></script> 
<!--webfonts -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!-- webfonts -->
<!--animate -->
<link href="../css/animate.css" rel="stylesheet" type="text/css" media="all">

<script src="../js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!-- end-animate -->
<!-- chart -->
<script src="../js/Chart.js"></script>
 <!-- chart  -->
<!-- Calender -->
<link rel="stylesheet" href="../css/clndr.css" type="text/css" />
<script src="../js/underscore-min.js" type="text/javascript"></script>
<script src= "../js/moment-2.2.1.js" type="text/javascript"></script>
<script src="../js/clndr.js" type="text/javascript"></script>
<script src="../js/site.js" type="text/javascript"></script>
<!-- End Calender   -->
 <!-- Metis Menu -->
<script src="../js/metisMenu.min.js"></script>
<script src="../js/custom.js"></script>
<link href="../css/custom.css" rel="stylesheet">
<!-- Metis Menu   -->
<style>
/* General Body Styles */
body {
    background: #f0f0f0; /* Light background for contrast */
    font-family: Arial, sans-serif;
}

/* Header styles */
.sticky-header {
    background: #000; /* Black background */
    color: #00bfff; /* Sky blue text */
    padding: 15px 20px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

.header-left {
    display: flex;
    align-items: center;
}

.header-left .logo {
    margin-left: 15px;
}

.header-left .logo span {
    font-size: 20px;
    font-weight: bold;
}

.header-right {
    display: flex;
    align-items: center;
}

.profile_details {
    position: relative;
    margin-left: 20px; /* Space between notifications and profile */
}

.nofitications-dropdown {
    margin: 0;
    padding: 0;
    list-style: none;
}

.nofitications-dropdown .head-dpdn {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    background: #1a1a1a; /* Dark background */
    border: 1px solid #00bfff; /* Sky blue border */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    min-width: 250px;
    z-index: 1000;
    display: none; /* Hide by default */
}

.dropdown-toggle:hover + .dropdown-menu {
    display: block; /* Show on hover */
}

.dropdown-menu li {
    padding: 10px;
    color: #00bfff; /* Sky blue text */
}

.dropdown-menu li a {
    color: inherit; /* Inherit color from parent */
}

.dropdown-menu li a:hover {
    background: #00bfff; /* Highlight on hover */
    color: #fff; /* White text on highlight */
}

/* Sidebar styles */
.sidebar {
    background: #000; /* Black background */
    color: #00bfff; /* Sky blue text */
    width: 250px;
    position: fixed;
    top: 60px; /* Below the header */
    bottom: 0;
    left: -250px; /* Hidden by default */
    transition: left 0.3s ease;
    overflow-y: auto; /* Allow scrolling */
    z-index: 999;
}

.sidebar.show {
    left: 0; /* Show sidebar */
}

#side-menu {
    padding: 0;
}

#side-menu li {
    list-style: none;
}

#side-menu li a {
    display: block;
    padding: 15px 20px;
    color: #00bfff; /* Sky blue text */
    text-decoration: none;
}

#side-menu li a:hover {
    background: rgba(0, 191, 255, 0.2); /* Light hover effect */
}

.nav-second-level {
    display: none; /* Hide submenus */
}

.nav-second-level.collapse {
    display: block; /* Show submenu */
}


</style>
  </head>
  <body>
  <body>
    <div class="sticky-header header-section">
        <div class="header-left">
            <button id="showLeftPush"><i class="fa fa-bars"></i></button>
            <div class="logo">
                <a href="index.html">
                    <span>Admin Panel</span>
                </a>         
            </div>
        </div>
        <div class="header-right">
            <div class="profile_details_left">
                <ul class="nofitications-dropdown">
                    <?php
                    $ret1 = mysqli_query($con, "SELECT tbluser.FirstName, tbluser.LastName, tblbook.ID AS bid, tblbook.AptNumber FROM tblbook JOIN tbluser ON tbluser.ID=tblbook.UserID WHERE tblbook.Status IS NULL");
                    $num = mysqli_num_rows($ret1);
                    ?>
                    <li class="dropdown head-dpdn">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge blue"><?php echo $num; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="notification_header">
                                    <h3>You have <?php echo $num; ?> new notification</h3>
                                </div>
                            </li>
                            <li>
                                <div class="notification_desc">
                                    <?php if ($num > 0) {
                                        while ($result = mysqli_fetch_array($ret1)) {
                                    ?>
                                        <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['bid']; ?>">New appointment received from <?php echo $result['FirstName']; ?> <?php echo $result['LastName']; ?> (<?php echo $result['AptNumber']; ?>)</a>
                                        <hr />
                                    <?php }
                                    } else { ?>
                                        <a class="dropdown-item" href="all-appointment.php">No New Appointment Received</a>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <div class="notification_bottom">
                                    <a href="new-appointment.php">See all notifications</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="profile_details">
                <?php
                $adid = $_SESSION['bpmsaid'];
                $ret = mysqli_query($con, "SELECT AdminName FROM tbladmin WHERE ID='$adid'");
                $row = mysqli_fetch_array($ret);
                $name = $row['AdminName'];
                ?>
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <div class="profile_img">
                                <span class="prfil-img"><img src="../admin.jpg" alt="" width="50" height="50"> </span>
                                <div class="user-name">
                                    <p><?php echo $name; ?></p>
                                    <span>Administrator</span>
                                </div>
                                <i class="fa fa-angle-down lnr"></i>
                                <i class="fa fa-angle-up lnr"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="change-password.php"><i class="fa fa-cog"></i>Settings</a></li>
                            <li><a href="admin-profile.php"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="index.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="sidebar" role="navigation">
        <div class="navbar-collapse">
            <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-tachometer nav_icon"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="add-services.php"><i class="fa fa-image nav_icon"></i>Carousel<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="add-services.php">Add Carousel</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="services/add_service.php"><i class="fa fa-cogs nav_icon"></i>Services<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="add-services.php">Add Services</a></li>
                            <li><a href="manage-services.php">Manage Services</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="about-us.php"><i class="fa fa-file nav_icon"></i>Pages <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="all-appointment.php">All Appointments</a></li>
                            <li><a href="contact-us.php">Contact Us</a></li>
                            <li><a href="signin.php">SignIn</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="add-services.php"><i class="fa fa-box nav_icon"></i>Products<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="products/add_products.php">Add Products</a></li>
                            <li><a href="products/show_products.php">View Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="customer-list.php" class="chart-nav"><i class="fa fa-users nav_icon"></i>Customer List</a>
                    </li>
                    <li>
                        <a href="invoices.php" class="chart-nav"><i class="fa fa-file-invoice nav_icon"></i>Invoices</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle sidebar
            $('#showLeftPush').click(function () {
                $('.sidebar').toggleClass('show');
            });

            // Dropdown toggle
            $('.dropdown-toggle').click(function (e) {
                e.preventDefault();
                $(this).next('.dropdown-menu').slideToggle(300);
            });
        });
    </script>
</body>
</body>
  </body>
  </html>