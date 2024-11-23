<?php
session_start();
include 'config.php';

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
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap"
    rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet" />
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <!-- Spinner Start -->
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
        <a href="index.php" class="nav-item nav-link">Home</a>
        <a href="about.php" class="nav-item nav-link">About</a>
        <a href="products.php" class="nav-item nav-link active">Products</a>
        <a href="service.php" class="nav-item nav-link">Service</a>

        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="price.php" class="dropdown-item">Pricing Plan</a>
            <a href="open.php" class="dropdown-item">Working Hours</a>
          </div>
        </div>

        <a href="contact.php" class="nav-item nav-link">Contact</a>


      </div>
      <a href="" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block mr-2">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
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
          <a href="registration/logout.php" class="dropdown-item">Logout</a>
        </div>
      </div>
    <?php else: ?>
      <a href="registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
    <?php endif; ?>
  </nav>
  <!-- Navbar End -->

 <!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $sqli = "SELECT * FROM `product_banner`";
            $val = mysqli_query($conn, $sqli);
            $first = true; // Flag to check the first item

            while ($row = mysqli_fetch_assoc($val)) {
                ?>
                <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                    <img class="w-100" src="<?php echo 'p_imgs/' . $row['product_img']; ?>" alt="Image"  style="height:80vh;" />
                    <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                        <div class="mx-sm-5 px-5" style="max-width: 900px">
                            <h1 style="color: #d6a553;" class="display-2 text-uppercase mb-4 animated slideInDown">
                                <?php echo $row['prod_title']; ?>
                            </h1>
                            <h4 class="text-white text-uppercase mb-4 animated slideInDown">
                                <i style="color: #d6a553;" class="fa fa-map-marker-alt me-3"></i>
                                <?php echo $row['prod_address']; ?>
                            </h4>
                            <h4 class="text-white text-uppercase mb-4 animated slideInDown">
                                <i style="color: #d6a553;" class="fa fa-phone-alt me-3"></i>
                                <?php echo $row['prod_number']; ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <?php
                $first = false; // After the first iteration, set flag to false
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
              <img src="<?php echo "../project/p_imgs/" . $row['iamge']; ?>" class="card-img-top" alt="Product Image">

              <div class="w-50 bg-secondary p-5" style="margin-top: -25%">
                <h1 class="text-uppercase  mb-3"><?php echo $row['year:'] ?></h1>
                <h2 class="text-uppercase mb-0"><?php echo $row['exp'] ?></h2>
              </div>
            </div>
          </div>
          <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <p class="d-inline-block bg-secondary  py-1 px-4">
              About Us
            </p>
            <h1 class="text-uppercase mb-4">
              <?php echo $row['add_title_1'] ?>
            </h1>
            <p id="para">
              <?php echo $row['add_description_para_1:'] ?>
            </p>
            <p id="para" class="mb-4">
              <?php echo $row['add_description_para_2'] ?>
            </p>
            <div class="row g-4">
              <div class="col-md-6">
                <h3 class="text-uppercase mb-3"><?php echo $row['add_title_2'] ?></h3>
                <p id="para" class="mb-0">
                  <?php echo $row['add_description_para_3'] ?>
                </p>
              </div>
              <div class="col-md-6">
                <h3 class="text-uppercase mb-3"><?php echo $row['add_title_3'] ?></h3>
                <p id="para" class="mb-0">
                  <?php echo $row['add_description_para_4'] ?>
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
            <p class="d-inline-block bg-secondary py-1 px-4">Products</p>
            <h1 class="text-uppercase">Beauty Products</h1>
        </div>

        <div class="row g-4">
            <?php
            $sqli = "SELECT * FROM `products`";
            $val = mysqli_query($conn, $sqli);

            while ($row = mysqli_fetch_assoc($val)) {
            ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 d-flex flex-column align-items-center justify-content-center text-center" style="background-color: #191C24; color: white; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="height: 250px; display: flex; justify-content: center; align-items: center;">
                            <img src="<?php echo "../project/p_imgs/" . $row['product_img']; ?>" class="card-img-top" alt="Product Image" style="width: 250px; height: 250px; object-fit: cover;border-radius:50px 20px 20px 0px; ">
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h3 class="text-uppercase mb-3"><?php echo $row['product_title']; ?></h3>
                            <!-- <p id="para"><?php echo $row['product_dec']; ?></p> -->
                            
                            <h5 class="mt-3">Price: <span class="text-uppercase"><?php echo $row['product_price']; ?></span></h5>
                            <a class="btn btn mt-3" href="" btn style="border-radius:10px 0px 0px 0px;">shop now  <i class="fa fa-plus"></i></a>
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
    .btn-square {
        background-color: #ffffff20;
        border-radius: 50%;
        padding: 10px 12px;
        color: #ffffff;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-square:hover {
        background-color: #ffffff40;
        color: #191C24;
    }
</style>

  <!-- Service End -->

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
            <span id="con">123 Street, New York, USA</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div id="icon" class="btn-square  flex-shrink-0 me-3">
              <span class="fa fa-phone-alt"></span>
            </div>
            <span id="con">+012 345 67890</span>
          </div>
          <div class="d-flex align-items-center">
            <div id="icon" class="btn-square  flex-shrink-0 me-3">
              <span class="fa fa-envelope-open"></span>
            </div>
            <span id="con">info@example.com</span>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <h4 class="text-uppercase mb-4">Quick Links</h4>
          <a class="btn btn-link" href="">About Us</a>
          <a class="btn btn-link" href="">Contact Us</a>
          <a class="btn btn-link" href="">Our Services</a>
          <a class="btn btn-link" href="">Terms & Condition</a>
          <a class="btn btn-link" href="">Support</a>
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
            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
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