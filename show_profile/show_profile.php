<?php
session_start();
include '../config.php'; // Database connection file

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: signin.php"); // Redirect to login page if not logged in
    exit();
}

// Get the logged-in user's email from the session
$loggedInEmail = $_SESSION['email'];

// If the form is submitted, update the user's details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $password = $_POST['password']; // Capture the password field

    // Prepare update query for the password and other fields
    if (!empty($password)) {
        $updateQuery = "UPDATE `registration` SET `Name` = ?, `Contact` = ?, `Password` = ? WHERE `Email` = ?";
        $stmt = $conn->prepare($updateQuery);
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $contact, $password, $loggedInEmail); // Bind the parameters
            $stmt->execute();
            $stmt->close();
            echo "<p class='text-center text-light'>Details and password updated successfully!</p>";
        } else {
            echo "<p class='text-center text-light'>Error updating details: " . $conn->error . "</p>";
        }
    } else {
        $updateQuery = "UPDATE `registration` SET `Name` = ?, `Contact` = ? WHERE `Email` = ?";
        $stmt = $conn->prepare($updateQuery);
        if ($stmt) {
            $stmt->bind_param("sss", $name, $contact, $loggedInEmail); // Bind the parameters
            $stmt->execute();
            $stmt->close();
            echo "<script> alert('Details updated successfully!')</script>";
        } else {
            echo "<script> alert('Error updating details.')</script>". $conn->error ;
        }
    }
}

// Fetch the user's current details
$q = "SELECT * FROM `registration` WHERE `Email` = ?";
$stmt = $conn->prepare($q);
if ($stmt) {
    $stmt->bind_param("s", $loggedInEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script> alert('No user details found.')</script>";
        exit();
    }
} else {
    echo "<script> alert('Error preparing query: ')</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="../lib/animate/animate.min.css" rel="stylesheet">
<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="../css/style.css" rel="stylesheet">


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="../js/main.js"></script>


</head>
<!-- Navbar Start -->
<nav
    class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn"
    data-wow-delay="0.1s">
    <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
      <h1 class="mb-0 text-uppercase">
        <img
          src="../img/bgremove.png"
          style="width: 80px; background-color: black"
          alt="Logo" />
        <!-- Optional background for logo -->
      </h1>
    </a>
    <button
      type="button"
      class="navbar-toggler me-4"
      data-bs-toggle="collapse"
      data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <a href="../index.php" class="nav-item nav-link ">Home</a>
        <a href="../about.php" class="nav-item nav-link">About</a>
        <a href="../service.php" class="nav-item nav-link">Service</a>
        <a href="../products.php" class="nav-item nav-link ">Products</a>

        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="../price.php" class="dropdown-item">Pricing Plan</a>
            <a href="../open.php" class="dropdown-item">Working Hours</a>
          </div>
        </div>

        <a href="../contact.php" class="nav-item nav-link active">Contact</a>


      </div>
      <a href="../appointment/appointment.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block mr-2">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
    <!-- User Session Dropdown -->
    <?php if (isset($_SESSION['username'])): ?>
      <div class="nav-item dropdown">
        <a
          href="#"
          class="nav-link dropdown-toggle"
          data-bs-toggle="dropdown">
          <?php echo htmlspecialchars($_SESSION['username']); ?>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a href="../registration/logout.php" class="dropdown-item">Logout</a>
        </div>
      </div>
    <?php else: ?>
      <a href="../registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
    <?php endif; ?>
  </nav>
  <!-- Navbar End -->
<body >
    <style>
       
        label{
            color:#d6a553;
        }
        #email,#name,#contact,#Password{
            border-radius: 10px;
        }
    </style>
    <div class="container vh-100 d-flex justify-content-center align-items-center"  >
        <div class="card text-dark" style="width: 26rem; border-radius: 15px; background-color: #292C36;">
            <div class="card-body">
                <h2 class="card-title text-light text-center mb-4">Edit Profile</h2>

                <!-- Profile form with existing user details -->
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label ">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($row['Contact']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="Password" name="password" value="<?php echo htmlspecialchars($row['Password']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" style="border-radius: 10px;">Save Changes</button>
                </form>
                <a href="logout.php" class="btn btn-danger mt-4 w-100" style="border-radius: 10px;">Logout</a>
            </div>
        </div>
    </div>
     <!-- Footer Start -->

 <div
      class="container-fluid bg-secondary text-light footer mt-5 pt-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-lg-4 col-md-6">
            <h4 class="text-uppercase mb-4">Get In Touch</h4>
            <div  class="d-flex align-items-center mb-2">
              <div id="icon" class="btn-square  flex-shrink-0 me-3">
                <span  class="fa fa-map-marker-alt"></span>
              </div>
              <span id="con">C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi</span>
            </div>
            <div  class="d-flex align-items-center mb-2">
              <div id="icon"  class="btn-square  flex-shrink-0 me-3">
                <span  class="fa fa-phone-alt"></span>
              </div>
              <span id="con">+92 323-1202214</span>
            </div>
            <div  class="d-flex align-items-center">
              <div id="icon" class="btn-square  flex-shrink-0 me-3">
                <span  class="fa fa-envelope-open"></span>
              </div>
              <span id="con">Abdul1hadi@gmail.com</span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
          <h4 class="text-uppercase mb-4">Quick Links</h4>
          <a class="btn btn-link" href="index.php">Home </a>
          <a class="btn btn-link" href="about.php">About Us</a>
          <a class="btn btn-link" href="contact.php">Contact Us</a>
          <a class="btn btn-link" href="service.php">Services</a>
          <a class="btn btn-link" href="open.php">Working Hours</a>
          <a class="btn btn-link" href="price.php">pricing plan</a>
          <a class="btn btn-link" href="products.php">products</a>

          </div>
          <div class="col-lg-4 col-md-6">
            <h4 class="text-uppercase mb-4">Newsletter</h4>
            <div class="position-relative mb-4">
              <input
                class="form-control border-0 w-100 py-3 ps-4 pe-5"
                type="text"
                placeholder="Your email"
              />
              <button
                type="button"
                class="btn py-2 position-absolute top-0 end-0 mt-2 me-2"
              >
                SignUp
              </button>
            </div>
            <div  class="d-flex pt-1 m-n1">
              <a id="icon"class="btn btn-lg-square btn-dark m-1" href=""
                ><i class="fab fa-twitter"></i
              ></a>
              <a id="icon"class="btn btn-lg-square btn-dark m-1" href=""
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a id="icon"class="btn btn-lg-square btn-dark m-1" href=""
                ><i class="fab fa-youtube"></i
              ></a>
              <a id="icon"class="btn btn-lg-square btn-dark m-1" href=""
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Your Site Name</a>, All
              Right Reserved.
            </div>
            <div class="col-md-6 text-center text-md-end">
              <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
              Designed By
              <a class="border-bottom" href="https://htmlcodex.com"
                >HTML Codex</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer End -->
</body>
</html>
