<?php
include('dbconnection.php');
session_start();
if (isset($_POST['insert'])) {
	$s_img = $_FILES['s_img']['name'];
	$service_tmp = $_FILES['s_img']['tmp_name'];
	$s_title = $_POST['s_t'];
	$s_desc = $_POST['s_d'];
	$s_price = $_POST['s_p'];

	$q = "INSERT INTO `service`(`Image`, `Title`, `Description`, `Price`) VALUES ('$s_img','$s_title','$s_desc','$s_price')";
	$val = mysqli_query($con, $q);

	if ($val) {
		move_uploaded_file($service_tmp, "../p_imgs/" . $s_img);
		header('location:show_service.php');
	} else {
		echo "Data is not inserted";
	}
}

$ret1 = mysqli_query($con, "SELECT id as bid, fullname, viewed FROM appointments WHERE viewed = 0 ORDER BY ID DESC");
$num = mysqli_num_rows($ret1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel - Add New Service</title>
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
				<div class="profile_details_left"><!--notifications of menu start -->
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


		<!-- main content start -->
		<style>
			.container {
				margin-left: 350px;
				margin-top: 120px;
			}

			.btn-success {
				background-color: #28a745;
				color: #fff;
				border: none;
			}

			.btn-warning {
				background-color: #ffc107;
				color: #fff;
				border: none;
			}

			.btn-danger {
				background-color: #dc3545;
				color: #fff;
				border: none;
			}
		</style>
		<div class="main-content">

			<div class="container">
				<h1 class="display-3 text-center  mt-5">Add New Service</h1>
				<div class="card col-10 p-4 shadow-lg">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="s_t" class="font-weight-bold">Title</label>
							<input type="text" name="s_t" placeholder="Enter title" class="form-control" id="s_t" placeholder="Enter Title" required>
						</div>
						<div class="form-group mb-3">
							<label for="s_d" class="font-weight-bold">Description</label>
							<input type="text" placeholder="Enter Description" name="s_d" class="form-control" id="s_d" required>
						</div>
						<div class="form-group mb-3">
							<label for="s_p" class="font-weight-bold">Price:</label>
							<input type="text" name="s_p" class="form-control" id="s_p" placeholder="Enter price" required>
						</div>
						<div class="form-group mb-3">
							<label for="p_img" class="font-weight-bold">Select Image:</label>
							<input type="file" name="s_img" class="form-control" id="p_t" placeholder=" " required>
						</div>
						<div class="text-center">
							<input type="submit" name="insert" class="btn btn-primary btn-lg " value="Add Service">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Main Content End -->

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