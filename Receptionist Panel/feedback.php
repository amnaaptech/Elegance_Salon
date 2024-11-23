<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('../config.php');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');  // Redirect to login if not logged in
    exit();
}

// Get the logged-in username from the session
$username = $_SESSION['username'];


?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard</title>

      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- jQuery -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>



</head>

<body class="cbp-spmenu-push">

    <div class="main-content">
        <!-- Header -->
        <div class="sticky-header header-section">
            <div class="header-left">
                <!-- Toggle Button -->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>

                <!-- Logo with Receptionist Panel text -->
                <div class="logo">
                <span>Receptionist Panel</span>
                </div>
            </div>


            <!-- Profile Section (adjusted position) -->
            <div class="header-right">
                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                                <div class="profile_img">
                                    <span class="prfil-img">
                                        <img src="reception.jpg" alt="" width="40" height="40">
                                    </span>
                                    <div class="user-name">
                                        <p><?php echo htmlspecialchars($username); ?> <i class="fa fa-angle-down lnr"></i> <!-- Dropdown icon on the left --></p>

                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" role="navigation">
            <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
                <ul class="nav" id="side-menu">
                    <li><a href="dashboard.php"><i class="fa fa-home nav_icon"></i> Dashboard</a></li>
                    <li><a href="contact.php" class="chart-nav "><i class="fa fa-users nav_icon"></i> Contact</a></li>
                    <li><a href="feedback.php" class="chart-nav active"><i class="fa fa-file-text-o nav_icon"></i> Feedback</a></li>
                    <li><a href="../index.php" class="chart-nav"><i class="fa fa-home  nav_icon"></i>      Home Page</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content (Feedback) -->
        <div class="appointments-container">
            <h1 class="text-center">Feedbacks</h1>
            <table class="table table-bordered appointments-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqli = "SELECT * FROM `feedback` ";
                    $val = mysqli_query($conn, $sqli);
                    $first = true; // Flag to check the first item

                    while ($row = mysqli_fetch_assoc($val)) {
                    ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['Client_Name']; ?></td>
                            <td><?php echo $row['Message']; ?></td>
                            <td><?php echo $row['Email']; ?></td>

                            <td>
                                <?php if ($row['image']) { ?>
                                    <img src="<?php echo '../p_imgs/' . $row['image']; ?>" style="width:100px; height:100px;" alt="User Image">
                                <?php } ?>
                            </td>

                        </tr>


                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        document.getElementById('showLeftPush').addEventListener('click', function() {
            var sidebar = document.querySelector('.sidebar');
            var mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                mainContent.style.marginLeft = '0';
            } else {
                mainContent.style.marginLeft = '200px';
            }
        });
    </script>

</body>

</html>