<?php
session_start();
include('includes/dbconnection.php');

$ret1 = mysqli_query($con, "SELECT id as bid, fullname, viewed FROM appointments WHERE viewed = 0 ORDER BY ID DESC");
$num = mysqli_num_rows($ret1);
// Check if the appointment ID is provided
if (isset($_GET['appointment_id'])) {
  $appointment_id = intval($_GET['appointment_id']);

  // Fetch appointment details
  $appointment_query = "SELECT * FROM appointments WHERE id = ?";
  $stmt = $con->prepare($appointment_query);
  $stmt->bind_param("i", $appointment_id);
  $stmt->execute();
  $appointment_result = $stmt->get_result();

  if (!$appointment_result || $appointment_result->num_rows === 0) {
    die("Appointment not found.");
  }

  $appointment = $appointment_result->fetch_assoc();

  // Fetch assigned services
  $service_ids = !empty($appointment['services']) ? explode(',', $appointment['services']) : [];
  $services = [];
  $total = 0;

  if (!empty($service_ids)) {
    $placeholders = implode(',', array_fill(0, count($service_ids), '?'));
    $service_query = "SELECT Title, Price FROM service WHERE id IN ($placeholders)";
    $stmt = $con->prepare($service_query);
    $type_str = str_repeat('i', count($service_ids));
    $stmt->bind_param($type_str, ...$service_ids);
    $stmt->execute();
    $service_result = $stmt->get_result();
    $services = $service_result->fetch_all(MYSQLI_ASSOC);

    foreach ($services as $service) {
      $total += $service['Price'];
    }
  }
} else {
  die("No appointment ID provided.");
}
?>



<!DOCTYPE HTML>
<html>

<head>
  <title> Invoice</title>
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
  <link href="css/font-awesome.css" rel="stylesheet">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/Chart.js"></script>
  <script src="js/metisMenu.min.js"></script>
  <script src="js/custom.js"></script>
  <link href="css/custom.css" rel="stylesheet">
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
                        <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['bid']; ?>">You have a new notification from <?php echo $result['fullname']; ?> (<?php echo $result['bid']; ?>)</a>
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
    <style>
      .main-content {
        margin-top: 30px;
        margin-left: 170px;
        padding: 20px;
      }

      .sidebar {
        width: 320px;
      }

      .container {
        margin-left: 0px;
        margin-top: 20px;
      }

      body {
        overflow-x: hidden;
      }

      @media print {
        .sidebar,
        .header-left,
        .header-right {
          display: none;
        }

        .main-content {
          margin-top: 0;
        }
        h2{
          margin-top: 10px;
        }
      }
    </style>

    <div class="main-content">
      <div class="container">
        <h2 class="text-center mt-5">Invoice for Appointment #<?php echo $appointment['id']; ?></h2>
        <h3>Customer Information</h3>
        <table class="table">
          <tr>
            <th>Name</th>
            <td><?php echo $appointment['fullname']; ?></td>
          </tr>
          <tr>
            <th>Mobile</th>
            <td><?php echo $appointment['contact']; ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo $appointment['email']; ?></td>
          </tr>
          <tr>
            <th>Date</th>
            <td><?php echo $appointment['date']; ?></td>
          </tr>
        </table>

        <h3>Assigned Services</h3>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Service</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($services as $index => $service): ?>
              <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo htmlspecialchars($service['Title']); ?></td>
                <td><?php echo number_format($service['Price'], 2); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <h4>Total: <?php echo number_format($total, 2); ?></h4>

        <button class="btn btn-success" onclick="downloadInvoice(<?php echo $appointment['id']; ?>)">Download PDF</button>
      </div>

      <script>
        function downloadInvoice(appointmentId) {
          window.location.href = "generate_pdf.php?appointment_id=" + appointmentId;
        }
      </script>

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

</body>

</html>