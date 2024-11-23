<?php
session_start();
include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HairCut - Hair Salon HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <p style="color: gold ;"></p>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


<!-- Navbar Start -->
<nav
  class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn"
  data-wow-delay="0.1s"
>
  <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
    <h1 class="mb-0 text-uppercase">
      <img
        src="img/bgremove.png"
        style="width: 80px; background-color: black"
        alt="Logo"
      />
      <!-- Optional background for logo -->
    </h1>
  </a>
  <button
    type="button"
    class="navbar-toggler me-4"
    data-bs-toggle="collapse"
    data-bs-target="#navbarCollapse"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto p-4 p-lg-0">
      <a href="index.php" class="nav-item nav-link ">Home</a>
      <a href="about.php" class="nav-item nav-link">About</a>
      <a href="service.php" class="nav-item nav-link">Service</a>
      <a href="products.php" class="nav-item nav-link ">Products</a>

      <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="price.php" class="dropdown-item ">Pricing Plan</a>
                        <a href="open.php" class="dropdown-item">Working Hours</a>
                    </div>
                </div>

      <a href="contact.php" class="nav-item nav-link">Contact</a>

      
    </div>
    <a href="appointment/appointment.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block mr-2"
      >Appointment<i class="fa fa-arrow-right ms-3"></i
    ></a>
  </div>
  <!-- User Session Dropdown -->
  <?php if (isset($_SESSION['username'])): ?>
        <div class="nav-item dropdown">
          <a
            href="#"
            class="nav-link dropdown-toggle"
            data-bs-toggle="dropdown"
          >
            <?php echo htmlspecialchars($_SESSION['username']); ?>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
          <a href="show_profile/show_profile.php" class="dropdown-item">Profile</a>
            <a href="registration/logout.php" class="dropdown-item">Logout</a>
          </div>
        </div>
      <?php else: ?>
        <a href="registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block"
          >Registration<i class="fa fa-arrow-right ms-3"></i
        ></a>
      <?php endif; ?>
</nav>
<!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3  text-uppercase mb-3 animated slideInDown">Pricing Plan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a style="color: #6C7293;" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a style="color: #6C7293;" href="#">Pages</a></li>
                    <li style="color: #d6a553;" class="breadcrumb-item active" aria-current="page">Pricing Plan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
  <!-- Price Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-0">
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
          <div
            class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
            <p class="d-inline-flex bg-dark py-1 px-4 me-auto">
              Price & Plan
            </p>
            <h1 class="text-uppercase mb-4">
              Check Out Our Barber Services And Prices
            </h1>
            <div>

              <?php
              $sqli = "SELECT * FROM `service`";
              $val = mysqli_query($conn, $sqli);

              while ($row = mysqli_fetch_assoc($val)) {
              ?>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <h6 style="color:#6C7293" class="text-uppercase mb-0"><?php echo $row['Title']; ?></h6>
                  <span style="color:#6C7293" class="text-uppercase"><?php echo $row['Price']; ?></span>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
          <div class="h-100">
            <img class="img-fluid h-100" src="img/price.jpg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Price End -->
 
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

    <!-- Back to Top -->
     
    <a href="#"  class="btn btn-lg-square back-to-top bg-dark m-1"
      ><i style="color: #d6a553 " class="bi bi-arrow-up"></i
    ></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>