<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');


$ret1 = mysqli_query($con, "SELECT id as bid, fullname, viewed FROM appointments WHERE viewed = 0 ORDER BY ID DESC");
$num = mysqli_num_rows($ret1);
?>

<!DOCTYPE HTML>
<html>

<head>
	<title> Admin Dashboard</title>

	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- font CSS -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
	<!--webfonts-->
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<!--//webfonts-->
	<!--animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>

	<!--//end-animate-->
	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->
	<!--Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<!-- header -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo" style="width:240px;">
					<a href="index.html">
						<br>
						<span>Admin Panel</span>
					</a>
				</div>
				<!--//logo-->
				<div class="clearfix"></div>
			</div>
			<div class="header-right">
				<div class="profile_details_left">
					<!--notifications of menu start -->
					<ul class="nofitications-dropdown">
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"><?php echo $num; ?></span></a>

							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have <?php echo $num; ?> new notification</h3>
									</div>
								</li>
								<?php if ($num > 0) {
									while ($result = mysqli_fetch_array($ret1)) {
										// Update the viewed status for each notification after displaying
										$update_query = "UPDATE appointments SET viewed = 1 WHERE id = " . $result['bid'];
										mysqli_query($con, $update_query);
								?>
										<li>
											<div class="notification_desc">
												<a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['bid']; ?>">New appointment received from <?php echo $result['fullname']; ?> (<?php echo $result['bid']; ?>)</a>
											</div>
										</li>
										<hr />
									<?php }
								} else { ?>
									<li><a class="dropdown-item" href="all-appointment.php">No New Appointment Received</a></li>
								<?php } ?>
								<li>
									<div class="notification_bottom">
										<a href="new-appointment.php">See all notifications</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img"><img src="img/admin.jpg" alt="" width="50" height="50"></span>
									<div class="user-name">
										<p></p>
										<span>Administrator</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>
								</div>
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- end-header -->
		<!-- Sidebar Start -->
		<div class="sidebar" role="navigation">
			<div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1" style="width:320px;">
					<ul class="nav" id="side-menu">
						<li>
							<a href="dashboard.php"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
						<li>
							<a href="carousel" data-bs-toggle="collapse" data-bs-target="#carouselmenu">
								<i class="fa fa-home nav_icon"></i>Carousel<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse" id="carouselmenu">
								<li><a href="carousel.php">Add Carousel</a></li>
								<li><a href="show_carousel.php">Show Carousel</a></li>
							</ul>
						</li>

						<li>
							<a href="#" data-bs-toggle="collapse" data-bs-target="#barbermenu">
								<i class="fa fa-users nav_icon"></i>Barbers <span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse" id="barbermenu">
								<li><a href="add_our_team.php">Add Barbers</a></li>
								<li><a href="show_team.php">Show Barbers</a></li>
							</ul>
						</li>
						<!-- Services Section -->
						<li>
							<a href="show_service.php" data-bs-toggle="collapse" data-bs-target="#serviceMenu">
								<i class="fa fa-cogs nav_icon"></i>Services<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse" id="serviceMenu">
								<li><a href="add_service.php">Add Service</a></li>
								<li><a href="show_service.php">Show Services</a></li>
							</ul>
						</li>

						<!-- Pages Section -->
						<li>
							<a href="#" data-bs-toggle="collapse" data-bs-target="#pagesMenu">
								<i class="fa fa-book nav_icon"></i>Pages <span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse" id="pagesMenu">
								<li><a href="about.php">About Us</a></li>
								<li><a href="contact.php">Contact Us</a></li>
								<li><a href="feeback.php">Clients Reviews</a></li>
								<li><a href="view-appointment.php">Veiw Appointments</a></li>
							</ul>
						</li>

						<!-- Products Section -->
						<li>
							<a href="show_products.php" data-bs-toggle="collapse" data-bs-target="#productsMenu">
								<i class="fa fa-check-square-o nav_icon"></i>Products<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse" id="productsMenu">
								<li><a href="show_products.php">All Products</a></li>
								<li><a href="add_products.php">Add Products</a></li>
								<li><a href="add_product_banner.php">Add Banner</a></li>
								<li><a href="show_prod_banner.php">Show Banner</a></li>
							</ul>
						</li>

						<!-- Customer List Section -->
						<li>
							<a href="customer-list.php" class="chart-nav"><i class="fa fa-users nav_icon"></i>Customer List</a>
						</li>

						<!-- Invoices Section -->
						<li>
							<a href="invoices.php" class="chart-nav"><i class="fa fa-file-text-o nav_icon"></i>Invoices</a>
						</li>
						<li>
							<a href="signin.php" class="chart-nav"><i class="fa fa-sign-in nav_icon"></i>Sign-in</a>
						</li>

					</ul>
					<div class="clearfix"></div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!-- Sidebar End -->
		<!-- main content start-->
		<div id="page-wrapper" class="row calender widget-shadow">
			<div class="main-page">
				<div class="row calender widget-shadow">
					<div class="row-one">
						<div class="col-md-4 widget">
							<?php $query1 = mysqli_query($con, "Select * FROM `registration` where role = 'user'");
							$totalcust = mysqli_num_rows($query1);
							?>
							<div class="stats-left ">
								<h5>Total</h5>
								<h4>Customer</h4>
							</div>
							<div class="stats-right">
								<label> <?php echo $totalcust; ?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="col-md-4 widget states-mdl">
							<?php $query2 = mysqli_query($con, "Select * from appointments");
							$totalappointment = mysqli_num_rows($query2);
							?>
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Appointment</h4>
							</div>
							<div class="stats-right">
								<label> <?php echo $totalappointment; ?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="col-md-4 widget states-last">
							<?php $query3 = mysqli_query($con, "Select * from appointments where Status='accepted'");
							$totalaccapt = mysqli_num_rows($query3);
							?>
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Accepted Apt</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $totalaccapt; ?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="row calender widget-shadow">
					<div class="row-one">
						<div class="col-md-4 widget">
							<?php $query4 = mysqli_query($con, "Select * from appointments where Status='Declined'");
							$totalrejapt = mysqli_num_rows($query4);
							?>
							<div class="stats-left ">
								<h5>Total</h5>
								<h4>Rejected Apt</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $totalrejapt; ?></label>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-4 widget states-mdl">
							<?php $query5 = mysqli_query($con, "Select * from service ");
							$totalser = mysqli_num_rows($query5);
							?>
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Services</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $totalser; ?></label>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-4 widget">
							<?php
							// Query to get the total quantity of products
							$query = mysqli_query($con, "SELECT SUM(prod_quantity) AS total_quantity FROM products");

							// Fetch the result
							$row = mysqli_fetch_array($query);
							$total_quantity = $row['total_quantity'];

							// Check if the total quantity is zero
							if ($total_quantity == 0) {
								$quantity_message = "Out of Stock";
							} else {
								$quantity_message = $total_quantity;
							}
							?>
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Product Quantity</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $quantity_message; ?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
							<div class="clearfix"></div>
						</div>

					</div>
				</div>
				
				<!-- user data -->
				<!-- Main Content (User data) -->
				<div class="User-container " style="margin-top:7%;">
					<h1 class="text-center ">User Data</h1>
					<table class="table table-bordered User-table">
						<thead>
							<tr>
							<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Password</th>
								<th>Role</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sqli = "SELECT * FROM `registration` WHERE role = 'user'";
							$val = mysqli_query($con, $sqli);
							$first = true; // Flag to check the first item

							while ($row = mysqli_fetch_assoc($val)) {
							?>
								<tr>
									<td><?php echo $row['id'] ?></td>
									<td><?php echo $row['Name']; ?></td>
									<td><?php echo $row['Email']; ?></td>
									<td><?php echo $row['Contact']; ?></td>
									<td><?php echo $row['Password']; ?></td>
									<td><?php echo $row['role']; ?></td>
								</tr>


							<?php }
							?>
						</tbody>
					</table>
				</div>

				<!-- Main Content (Staff data) -->
				<div class="User-container " style="margin-top:7%;">
					<h1 class="text-center ">Staff Data</h1>
					<table class="table table-bordered User-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Password</th>
								<th>Role</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sqli = "SELECT * FROM registration WHERE role IN ('barber', 'receptionist');";
							$val = mysqli_query($con, $sqli);
							$first = true; // Flag to check the first item

							while ($row = mysqli_fetch_assoc($val)) {
							?>
								<tr>
									<td><?php echo $row['id'] ?></td>
									<td><?php echo $row['Name']; ?></td>
									<td><?php echo $row['Email']; ?></td>
									<td><?php echo $row['Contact']; ?></td>
									<td><?php echo $row['Password']; ?></td>
									<td><?php echo $row['role']; ?></td>
								</tr>


							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- main content end -->

			<!-- Classie -->
			<script src="js/classie.js"></script>
			<script>
				var menuLeft = document.getElementById('cbp-spmenu-s1'),
					showLeftPush = document.getElementById('showLeftPush'),
					body = document.body;

				showLeftPush.onclick = function() {
					classie.toggle(this, 'active');
					classie.toggle(body, 'cbp-spmenu-push-toright');
					classie.toggle(menuLeft, 'cbp-spmenu-open');
					disableOther('showLeftPush');
				};


				function disableOther(button) {
					if (button !== 'showLeftPush') {
						classie.toggle(showLeftPush, 'disabled');
					}
				}
			</script>
			<!--scrolling js-->
			<script src="js/jquery.nicescroll.js"></script>
			<script src="js/scripts.js"></script>
			<!--//scrolling js-->
			<!-- Bootstrap Core JavaScript -->
			<script src="js/bootstrap.js"> </script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>