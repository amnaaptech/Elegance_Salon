<?php
include 'config.php';
session_start();


if (isset($_SESSION['email'])) {
  
  $userEmail = $_SESSION['email'];

  $notificationQuery = "SELECT * FROM appointments WHERE email = '$userEmail' AND (status = 'Accepted' OR status = 'Declined') AND user_view = 0";
  $notificationResult = $conn->query($notificationQuery);

  $numNotifications = $notificationResult->num_rows;

  $updateQuery = "UPDATE appointments SET user_view = 1 WHERE email = '$userEmail' AND (status = 'Accepted' OR status = 'Declined') AND user_view = 0";
  $conn->query($updateQuery);
} else {
  // If no email is stored in the session
  $numNotifications = 0;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Hair Salon</title>



  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

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
  <link href="css/style.css" rel="stylesheet" />
  <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS (requires jQuery) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <div
    id="spinner"
    class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div
      class="spinner-grow text-primary"
      style="width: 3rem; height: 3rem"
      role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>



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
        <a href="index.php" class="nav-item nav-link active">Home</a>
        <a href="about.php" class="nav-item nav-link">About</a>
        <a href="service.php" class="nav-item nav-link">Service</a>
        <a href="products.php" class="nav-item nav-link">Products</a>

        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="price.php" class="dropdown-item">Pricing Plan</a>
            <a href="open.php" class="dropdown-item">Working Hours</a>
          </div>
        </div>

        <a href="contact.php" class="nav-item nav-link">Contact</a>
      </div>

      <!-- Appointment Button -->
      <a href="appointment/appointment.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block me-2">Appointment<i class="fa fa-arrow-right ms-3"></i></a>

      <!-- Show Login/Register or User Dropdown -->
      <?php if (isset($_SESSION['username'])): ?>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a href="show_profile/show_profile.php" class="dropdown-item">Profile</a>
            <a href="registration/logout.php" class="dropdown-item">Logout</a>
          </div>
        </div>


        <!-- Notification Dropdown -->
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-bell" style="color: #d6a553;"></i>
            <span class="badge blue"><?php echo $numNotifications; ?></span>
          </a>
          <ul class="dropdown-menu" style="padding: 10px;">
            <li>
              <div class="notification_header">
                <span style="color: #6C7293;">You have <?php echo $numNotifications; ?> new notifications</span>
                <hr>
              </div>
            </li>
            <?php if ($numNotifications > 0): ?>
              <?php while ($row = $notificationResult->fetch_assoc()): ?>
                <li>
                  <div class="notification_desc">
                    <a href="#" style="color: #6C7293;">
                      Your appointment on <?php echo $row['date']; ?> has been <?php echo $row['status']; ?>.
                    </a>
                  </div>
                </li>
                <hr />
              <?php endwhile; ?>
            <?php else: ?>
              <li>
                <span>No New Notifications</span>
              </li>
            <?php endif; ?>
          </ul>
        </div>

      <?php else: ?>
        <a href="registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
      <?php endif; ?>
    </div>
  </nav>
  <!-- Navbar End -->


  <style>
    .dropdown-toggle::after {
      color: #6C7293;
    }

    .dropdown-toggle::after {
      content: "\f0d7";
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      padding-left: 5px;
    }

    .dropdown-menu {
      width: 250px;
      max-width: 100%;
      overflow-x: hidden;
      overflow-y: auto;
      word-wrap: break-word;
      position: absolute;
      right: 0;
      z-index: 1000;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      padding: 10px;
      background-color: #fff;
      border-radius: 4px;
    }
  </style>
  <!-- Navbar End -->

  <!-- Carousel Start -->
  <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        $sqli = "SELECT * FROM `index_banner`";
        $val = mysqli_query($conn, $sqli);
        $first = true;

        while ($row = mysqli_fetch_assoc($val)) {
        ?>
          <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
            <img class="w-100" src="<?php echo 'p_imgs/' . $row['Banner_Image']; ?>" alt="Image" style="height:100vh;" />
            <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
              <div class="mx-sm-5 px-5" style="max-width: 900px">
                <h1 style="color: #d6a553;" class="display-2 text-uppercase mb-4 animated slideInDown">
                  <?php echo $row['Banner_title']; ?>
                </h1>
                <h4 class="text-white text-uppercase mb-4 animated slideInDown">
                  <i style="color: #d6a553;" class="fa fa-map-marker-alt me-3"></i>
                  <?php echo $row['Banner_Adress']; ?>
                </h4>
                <h4 class="text-white text-uppercase mb-4 animated slideInDown">
                  <i style="color: #d6a553;" class="fa fa-phone-alt me-3"></i>
                  <?php echo $row['Banner_Number']; ?>
                </h4>
              </div>
            </div>
          </div>
        <?php
          $first = false;
        }
        ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>


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

  <!-- Service Start -->
  <div class="container-xxl py-5" style="margin-bottom: 100px;">
    <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px">
        <p class="d-inline-block bg-secondary py-1 px-4">Services</p>
        <h1 class="text-uppercase">What We Provide</h1>
      </div>

      <div class="row g-4">
        <?php
        $sqli = "SELECT * FROM `service`";
        $val = mysqli_query($conn, $sqli);

        while ($row = mysqli_fetch_assoc($val)) {
        ?>
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="background-color: black;">
            <div class="card h-100" style="background-color: #191C24; transition: transform 0.3s ease, box-shadow 0.3s ease;">

              <div style="height: 250px; display: flex; justify-content: center; align-items: center;">
                <img src="<?php echo "../project/p_imgs/" . $row['Image']; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: 250px; object-fit: cover;">
              </div>
              <div class="card-body d-flex flex-column" style="background-color: #191C24; color: white;">
                <h3 class="text-uppercase mb-3"><?php echo $row['Title']; ?></h3>
                <p id="para"><?php echo $row['Description']; ?></p>
                <h5 class="mt-auto">Price: <span class="text-uppercase"><?php echo $row['Price']; ?></span></h5>
                <a class="btn btn-square" href="appointment/appointment.php"><i class="fa fa-plus"></i></a>
              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>
    </div>
  </div>


  <style>
    .card:hover {
      transform: translateY(-10px);

      box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.3);

    }
  </style>
  <!-- Service End -->

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
  <style>
    .team-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
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

  <!-- Working Hours Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-0">
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
          <div class="h-100">
            <img class="img-fluid h-100" src="img/open.jpg" alt="" />
          </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
          <div
            class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
            <p class="d-inline-flex bg-dark  py-1 px-4 me-auto">
              Working Hours
            </p>
            <h1 class="text-uppercase mb-4">
              Professional Barbers Are Waiting For You
            </h1>
            <div>
              <div class="d-flex justify-content-between border-bottom py-2">
                <h6 style="color:#6C7293" class="text-uppercase mb-0">Monday</h6>
                <span style="color:#6C7293" class="text-uppercase">09 AM - 09 PM</span>
              </div>
              <div class="d-flex justify-content-between border-bottom py-2">
                <h6 style="color:#6C7293" class="text-uppercase mb-0">Tuesday</h6>
                <span style="color:#6C7293" class="text-uppercase">09 AM - 09 PM</span>
              </div>
              <div class="d-flex justify-content-between border-bottom py-2">
                <h6 style="color:#6C7293" class="text-uppercase mb-0">Wednesday</h6>
                <span style="color:#6C7293" class="text-uppercase">09 AM - 09 PM</span>
              </div>
              <div class="d-flex justify-content-between border-bottom py-2">
                <h6 style="color:#6C7293" class="text-uppercase mb-0">Thursday</h6>
                <span style="color:#6C7293" class="text-uppercase">09 AM - 09 PM</span>
              </div>
              <div class="d-flex justify-content-between border-bottom py-2">
                <h6 style="color:#6C7293" class="text-uppercase mb-0">Friday</h6>
                <span style="color:#6C7293" class="text-uppercase">09 AM - 09 PM</span>
              </div>
              <div class="d-flex justify-content-between py-2">
                <h6 style="color:#6C7293" class="text-uppercase mb-0">Sat / Sun</h6>
                <span style="color:#6C7293" class="text-uppercase ">Closed</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Working Hours End -->

  <!-- Testimonial Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div
        class="text-center mx-auto mb-5 wow fadeInUp"
        data-wow-delay="0.1s"
        style="max-width: 600px">
        <h1 class="text-uppercase">What Our Clients Say!</h1>
      </div>

      <div
        class="owl-carousel testimonial-carousel wow fadeInUp"
        data-wow-delay="0.1s">

        <?php
        $sqli = "SELECT * FROM feedback";
        $val = mysqli_query($conn, $sqli);

        while ($row = mysqli_fetch_assoc($val)) {
        ?>
          <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='<?php echo 'p_imgs/' . $row['image']; ?>' alt=''>">
            <img class="img-fluid rounded-circle mb-3" src="<?php echo 'p_imgs/' . $row['image']; ?>" alt="Client Image" style="width: 80px; height: 80px; object-fit: cover;">
            <h4 class="text-uppercase"><?php echo htmlspecialchars($row['Client_Name']); ?></h4>
            <span class="fs-5"><?php echo htmlspecialchars($row['Message']); ?></span>
          </div>
        <?php
        }
        ?>

      </div>
    </div>
  </div>
  <!-- Testimonial End -->
  <style>
    .testimonial-item {
      padding: 30px;
      border-radius: 10px;
      background-color: #191C24;
      transition: transform 0.3s;
    }

    .testimonial-item:hover {
      transform: translateY(-5px);
    }

    .testimonial-item h4 {
      margin-top: 15px;
      font-weight: bold;
    }

    .testimonial-item span {
      color: #6c757d;
    }
  </style>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>

</html>