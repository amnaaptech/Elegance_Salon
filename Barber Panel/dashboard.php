<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include '../config.php';

// Ensure the user is logged in
// if (!isset($_SESSION['username'])) {
//     header('Location: login.php');  // Redirect to login if not logged in
//     exit();
// }

$username = $_SESSION['username'];

// Handle action requests for verifying, canceling, or deleting appointments
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    switch ($action) {
        case 'verify':
            // Update the status to 'Accepted'
            $con->query("UPDATE appointments SET status='Accepted' WHERE id='$id'");
            break;

        case 'cancel':
            // Update the status to 'Declined'
            $con->query("UPDATE appointments SET status='Declined' WHERE id='$id'");
            break;

        case 'delete':
            // Delete the appointment from the database
            $con->query("DELETE FROM appointments WHERE id='$id'");
            break;
    }

    // Redirect to reload the page and show updated data
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$appointments = $con->query("SELECT * FROM appointments");
?>






<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barber Dashboard</title>

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
                
                    <span>Barber Panel</span>
                
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
                                    <p><?php echo htmlspecialchars($username); ?>   <i class="fa fa-angle-down lnr"></i> <!-- Dropdown icon on the left --></p>
                                    
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
                    <li><a href="dashboard.php" class="chart-nav active"><i class="fa fa-home nav_icon "></i>    Dashboard</a></li>
                    <li><a href="feedback.php" class="chart-nav"><i class="fa fa-file-text-o nav_icon"></i>      Feedback</a></li>
                    <li><a href="../index.php" class="chart-nav"><i class="fa fa-home  nav_icon"></i>      Home Page</a></li>
                   
                </ul>
            </nav>
        </div>

        <!-- Main Content (Appointments) -->
        <div class="appointments-container">
        <h1 class="text-center">Appointments</h1>
            <table class="table table-bordered appointments-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Services</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($appointments->num_rows > 0): ?>
                        <?php $index = 1; ?>
                        <?php while ($row = $appointments->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['services']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_price']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button class="btn btn-success btn-sm" type="submit" name="action" value="verify">Accept</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button class="btn btn-warning btn-sm" type="submit" name="action" value="cancel">Decline</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button class="btn btn-danger btn-sm" type="submit" name="action" value="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No appointments found</td>
                        </tr>
                    <?php endif; ?>
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
