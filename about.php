<?php
session_start();
include 'config.php'

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
    <div class="spinner-grow " style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->


  <!-- Navbar Start -->
  <nav
    class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn"
    data-wow-delay="0.1s">
    <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
      <h1 class="mb-0 text-uppercase">
        <img
          src="img/bgremove.png"
          style="width: 80px; background-color: black"
          alt="Logo" />

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
        <a href="index.php" class="nav-item nav-link ">Home</a>
        <a href="about.php" class="nav-item nav-link active">About</a>
        <a href="service.php" class="nav-item nav-link">Service</a>
        <a href="products.php" class="nav-item nav-link ">Products</a>

        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="price.php" class="dropdown-item">Pricing Plan</a>
            <a href="open.php" class="dropdown-item">Working Hours</a>
          </div>
        </div>

        <a href="contact.php" class="nav-item nav-link">Contact</a>


      </div>
      <a href="appointment/appointment.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block mr-2">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
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
          <a href="show_profile/show_profile.php" class="dropdown-item">Profile</a>
          <a href="registration/logout.php" class="dropdown-item">Logout</a>
        </div>
      </div>
    <?php else: ?>
      <a href="registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
    <?php endif; ?>
  </nav>
  <!-- Navbar End -->

  <!-- Page Header Start -->
  <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
      <h1 class="display-3  text-uppercase mb-3 animated slideInDown">About</h1>
      <nav aria-label="breadcrumb animated slideInDown">
        <ol class="breadcrumb justify-content-center text-uppercase mb-0">
          <li class="breadcrumb-item"><a style="color: #6C7293;" href="#">Home</a></li>
          <li class="breadcrumb-item"><a style="color: #6C7293;" href="#">Pages</a></li>
          <li style="color: #d6a553;" class="breadcrumb-item  active" aria-current="page">About</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- Page Header End -->


  <!-- About Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-5">
        <?php
        $sqli = "SELECT * FROM `about`";
        $val = mysqli_query($conn, $sqli);

        while ($row = mysqli_fetch_assoc($val)) {
        ?>
          <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">

            <div class="d-flex flex-column">
              <img src="<?php echo "../project/p_imgs/" . $row['Image']; ?>" class="card-img-top" alt="Product Image">

              <div class="w-50 bg-secondary p-5" style="margin-top: -25%">
                <h1 class="text-uppercase  mb-3"><?php echo $row['Years'] ?></h1>
                <h2 class="text-uppercase mb-0"><?php echo $row['Experience'] ?></h2>
              </div>
            </div>
          </div>
          <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <p class="d-inline-block bg-secondary  py-1 px-4">
              About Us
            </p>
            <h1 class="text-uppercase mb-4">
              <?php echo $row['Add_Tittle_1'] ?>
            </h1>
            <p id="para">
              We’re here to make each visit an experience, not just a service. Our team combines skill and style to create a look that’s uniquely yours, all in a welcoming and relaxing space. Step in to see how we’re redefining what a salon visit can be!
            </p>
            <p id="para" class="mb-4">
              We’re more than a salon; we’re a place where style meets care. With skilled hands and a personal touch, we’re here to make you look and feel fantastic. Discover a haircut experience that’s crafted just for you!
            </p>
            <div class="row g-4">
              <div class="col-md-6">
                <h3 class="text-uppercase mb-3"><?php echo $row['Add_Tittle_2'] ?></h3>
                <p id="para" class="mb-0">
                  Creating Style and Confidence Since 2000
                </p>
              </div>
              <div class="col-md-6">
                <h3 class="text-uppercase mb-3"><?php echo $row['Add_Tittle_3'] ?></h3>
                <p id="para" class="mb-0">
                  Trusted by 1,000+ clients for style since 2000
                </p>
              </div>
            </div>
          </div>
        <?php
        } ?>
      </div>
    </div>
  </div>
  <!-- About End -->

  <!-- Team Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div
        class="text-center mx-auto mb-5 wow fadeInUp"
        data-wow-delay="0.1s"
        style="max-width: 600px">
        <p class="d-inline-block bg-secondary py-1 px-4">Our Barber</p>
        <h1 class="text-uppercase">Meet Our Barber</h1>
      </div>
      <div class="row g-4">
        <?php
        // Make sure to include config.php and establish a connection to the database


        // Query to get team members from the `our_team` table
        $sqli = "SELECT * FROM `our-team`";
        $val = mysqli_query($conn, $sqli);

        // Check if query returned any results
        if (mysqli_num_rows($val) > 0) {
          while ($row = mysqli_fetch_assoc($val)) {
        ?>
            <div class="col-lg-3 col-md-6 wow fadeInUp">
              <div class="team-item">
                <div class="team-img position-relative overflow-hidden" style="width: 100%; height: 300px;">
                  <!-- Make sure image path is dynamic based on database value if needed -->
                  <img src="<?php echo "p_imgs/" . $row['person_iamges']; ?>" alt="Team Member Image" style="width: 100%; height: 100%; object-fit: cover;" />
                  <div class="team-social">
                    <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                  </div>
                </div>
                <div class="bg-secondary text-center p-4">
                  <!-- Use the correct column name `person_name` -->
                  <h5 class="text-uppercase"><?php echo $row['persom_name']; ?></h5>
                  <span style="color:#6C7293"><?php echo $row['profession']; ?></span><br>
                  <span style="color:#6C7293"><?php echo $row['shifts']; ?></span>
                </div>
              </div>
            </div>

        <?php
          }
        } else {
          echo "<p>No team members found.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Team End -->

  <!-- Footer Start -->

  <div
    class="container-fluid bg-secondary text-light footer mt-5 pt-5 wow fadeIn"
    data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-4 col-md-6">
          <h4 class="text-uppercase mb-4">Get In Touch</h4>
          <div class="d-flex align-items-center mb-2">
            <div id="icon" class="btn-square  flex-shrink-0 me-3">
              <span class="fa fa-map-marker-alt"></span>
            </div>
            <span id="con">C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div id="icon" class="btn-square  flex-shrink-0 me-3">
              <span class="fa fa-phone-alt"></span>
            </div>
            <span id="con">+92 323-1202214</span>
          </div>
          <div class="d-flex align-items-center">
            <div id="icon" class="btn-square  flex-shrink-0 me-3">
              <span class="fa fa-envelope-open"></span>
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
              placeholder="Your email" />
            <button
              type="button"
              class="btn py-2 position-absolute top-0 end-0 mt-2 me-2">
              SignUp
            </button>
          </div>
          <div class="d-flex pt-1 m-n1">
            <a id="icon" class="btn btn-lg-square btn-dark m-1" href=""><i class="fab fa-twitter"></i></a>
            <a id="icon" class="btn btn-lg-square btn-dark m-1" href=""><i class="fab fa-facebook-f"></i></a>
            <a id="icon" class="btn btn-lg-square btn-dark m-1" href=""><i class="fab fa-youtube"></i></a>
            <a id="icon" class="btn btn-lg-square btn-dark m-1" href=""><i class="fab fa-linkedin-in"></i></a>
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
            Designed By
            <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer End -->

  <!-- Back to Top -->

  <a href="#" class="btn btn-lg-square back-to-top bg-dark m-1"><i style="color: #d6a553 " class="bi bi-arrow-up"></i></a>



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