 <?php
session_start();
// Check if user is logged in
if (isset($_SESSION['username'])) {
  header('Location: ../index.php'); // Redirect to login page
  exit();
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link href="../img/favicon.ico" rel="icon" />
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet" />
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Libraries Stylesheet -->
  <link href="../lib/animate/animate.min.css" rel="stylesheet" />
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <!-- Customized Bootstrap Stylesheet -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <!-- Template Stylesheet -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/wow/wow.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/waypoints/waypoints.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <!-- Template Javascript -->
  <script src="../js/main.js"></script>
  <style>
    #ic1 {
      color: #d6a553;
    }

    #submit1 {
      background-color: #d6a553;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    #submit1:hover {
      color: #6C7293;
    }
    .form-control {
    border: none; /* Change this to your desired border color */
    box-shadow: none; /* Remove any shadow */
    }

   .form-control:focus {
    border-color: none; /* Optional: Change the border color on focus */
    box-shadow: none; /* Optional: Add a subtle shadow on focus */
    }
    
  </style>
</head>

<body>

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
      <a href="signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
  </nav>
  <!-- Navbar End -->
  <section class="vh-100" style="background-color: black;">
    <div class="container h-100" >
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-6 ">
          <div class="card text-black" style="border-radius: 25px; background-color: #191C24;">
            <div class="card-body p-md-2">
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3" style="color:#d6a553;">Sign in</p>
                <div class="col-lg-10  ">
                  <form class="mx-1 mx-md-4" action="add.php" method="post">
                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <label class="form-label" for=""> Name</label>
                        <input type="text" class="form-control form-control-lg py-3" name="name" autocomplete="off" placeholder="Enter Your Name" style="border-radius:15px;" />
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <label class="form-label" for=""> Email</label>
                        <input type="email" class="form-control form-control-lg py-3" name="email" autocomplete="off" placeholder="Enter Your Email" style="border-radius: 15px;;" />
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <label class="form-label" for=""> Password</label>
                        <input type="password" class="form-control form-control-lg py-3" name="password" autocomplete="off" placeholder="Enter Your Password" style="border-radius: 15px;;" />
                      </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                      <input type="submit" value="Sign in" name="register" class=" btn  btn-lg text-dark my-2 py-3" style="width:100%; border-radius: 15px; font-weight:600;" />
                    </div>
                  </form>
                  <p align="center">Don't have a account <a href="signup.php" class="" style="font-weight:600; text-decoration:none; color:#d6a553;">Sign up</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer Start -->
  <div class="container-fluid bg-secondary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-4 col-md-6">
          <h4 class="text-uppercase mb-4">Get In Touch</h4>
          <div class="d-flex align-items-center mb-2">
            <div id="icon" class="btn-square bg-dark flex-shrink-0 me-3">
              <span class="fa fa-map-marker-alt"></span>
            </div>
            <span id="con">123 Street, New York, USA</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div id="icon" class="btn-square bg-dark flex-shrink-0 me-3">
              <span class="fa fa-phone-alt"></span>
            </div>
            <span id="con">+012 345 67890</span>
          </div>
          <div class="d-flex align-items-center">
            <div id="icon" class="btn-square bg-dark flex-shrink-0 me-3">
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
            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email" />
            <button type="button" class="btn py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
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
            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
          </div>
          <div class="col-md-6 text-center text-md-end">
            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->
</body>

</html>