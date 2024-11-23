<?php
include 'config.php';
session_start();
$ret1 = mysqli_query($con, "SELECT id as bid, fullname, viewed FROM appointments WHERE viewed = 0 ORDER BY ID DESC");
$num = mysqli_num_rows($ret1);

if (isset($_POST['insert'])) {
	// Get and sanitize form input
	$banner_title =  $_POST['b_t'];
	$banner_address =  $_POST['b_address'];
	$banner_number = $_POST['b_n'];
	$banner_img =  $_FILES['b_img']['name'];
	$prod_tmp = $_FILES['b_img']['tmp_name'];

	// Debugging: Check the SQL query
	$q = "INSERT INTO `index_banner`(`Banner_title`, `Banner_Adress`, `Banner_Number`, `Banner_Image`) 
          VALUES ('$banner_title', '$banner_address', '$banner_number', '$banner_img')";


	$check_result = mysqli_query($con, $q);
	// Execute the query
	if ($check_result) {

		echo "<script>alert('Data inserted successfully!');</script>";
	} else {

		echo "<script>alert('Data is not inserted!');</script>" . mysqli_error($con);
	}

	// Move uploaded file
	if (move_uploaded_file($prod_tmp, "p_imgs/" . $banner_img)) {
		echo "<script>alert('File uploaded successfully.');</script>";
	} else {
		echo "<script>alert('File upload failed: ');</script>" . $_FILES['b_img']['error'];
	}
};
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel - Add Carousel</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
		<!-- Main content start -->
		<div class="main-content">

			<style>
				.sidebar .arrow {
					margin-left: 10px;
					float: right;

				}

				/* Sidebar Links */
				.sidebar .nav li a {
					color: #6F6F6F;
					padding: 10px 80px;
					font-size: 16px;
					margin-left: 0;
					padding-left: 16px;
					transition: background-color 0.3s ease;
				}



				.container {
					margin-left: 350px;
					margin-top: 80px;
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


			<div class="container">
				<h1 class="display-3 text-center  mt-5">Add menu banner</h1>
				<div class="card col-10 p-4 shadow-lg">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="p_img" class="font-weight-bold">Title:</label>
							<input type="text" name="b_t" class="form-control" id="p_img" required>
						</div>
						<div class="form-group mb-3">
							<label for="p_t" class="font-weight-bold">Address:</label>
							<input type="text" name="b_address" class="form-control" id="p_t" placeholder="" required>
						</div>
						<div class="form-group mb-3">
							<label for="p_p" class="font-weight-bold">Number:</label>
							<input type="text" name="b_n" class="form-control" id="p_p" placeholder="" required>
						</div>
						<div class="form-group mb-3">
							<label for="p_p" class="font-weight-bold">Banner image:</label>
							<input type="file" name="b_img" class="form-control" id="p_p" placeholder=" " required>
						</div>
						<div class="text-center">
							<input type="submit" name="insert" class="btn btn-primary btn-lg col-12" value="Add banner">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Main content end -->

		<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

				toggles.forEach((toggle) => {
					toggle.addEventListener('click', function() {
						const targetId = toggle.getAttribute('data-bs-target');
						const targetMenu = document.querySelector(targetId);

						// Toggle the clicked menu
						const isExpanded = targetMenu.classList.contains('show');

						// Collapse all other dropdowns
						toggles.forEach((otherToggle) => {
							const otherTargetId = otherToggle.getAttribute('data-bs-target');
							const otherMenu = document.querySelector(otherTargetId);

							if (otherMenu !== targetMenu && otherMenu.classList.contains('show')) {
								const collapseInstance = bootstrap.Collapse.getInstance(otherMenu);
								if (collapseInstance) collapseInstance.hide();
							}
						});

						// If the clicked menu was not expanded, expand it
						if (!isExpanded) {
							const collapseInstance = new bootstrap.Collapse(targetMenu);
							collapseInstance.show();
						}
					});
				});
			});
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