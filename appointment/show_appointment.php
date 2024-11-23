<?php
include '../config.php'; // Ensure you have the correct path to your config file
session_start();

// Fetch appointments from the database
$appointments = $conn->query("SELECT * FROM appointments");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Template Stylesheet -->
    <link href="appointment.css" rel="stylesheet" />
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-0 px-lg-5">
    <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
        <h1 class="mb-0 text-uppercase">Salon Appointments</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="../index.php" class="nav-item nav-link active">Home</a>
            <a href="../about.php" class="nav-item nav-link">About</a>
            <a href="../service.php" class="nav-item nav-link">Service</a>
            <a href="../products.php" class="nav-item nav-link">Products</a>
            <a href="../contact.php" class="nav-item nav-link">Contact</a>
        </div>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="registration/logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="../registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
        <?php endif; ?>
    </div>
</nav>
<!-- Navbar End -->

<div class="container mt-5">
    <h1 class="text-center">Appointments</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Date</th>
                <th>Services</th>
                <th>Total Price</th>
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
                        <td>$<?php echo htmlspecialchars($row['total_price']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No appointments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
