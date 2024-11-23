<?php 
include 'config.php';

session_start();
// feedback
if(isset($_POST['insert'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $feed_img =  $_FILES['f_img']['name'];
  $prod_tmp = $_FILES['f_img']['tmp_name']; 

  $q = "INSERT INTO `feedback`(`Client_Name`, `Message`, `Email`, `image`) VALUES ('$name','$message','$email','$feed_img')";
  $val = mysqli_query($conn, $q);

  if($val) {
    // Set session variable for success
    $_SESSION['feedback_success'] = true;
    move_uploaded_file($prod_tmp, "p_imgs/" . $feed_img);
  } else {
    echo "Failed to insert";
  }
}

// contact form

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['mess'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        $query = "INSERT INTO contact (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";
        $result = $conn->query($query);

        if ($result) {
          // Trigger the modal on successful submission
          echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                      successModal.show();
                  });
                </script>";
      } else {
          echo "<p>Error: " . $conn->error . "</p>";
      }
  } else {
      echo "<p>Please fill all required fields.</p>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>HairCut - Hair Salon HTML Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
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

  
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Javascript -->
  <script src="../js/main.js"></script>
  <style>
    /* Custom styles for input borders */
    .form-control:focus {
      border-color: #d6a553; /* Golden color */
      box-shadow: 0 0 0 0.2rem rgba(214, 165, 83, 0.25); /* Optional shadow for better visibility */
    }
    .form-control {
      border-color: #d6a553; /* Golden color for default state */
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
        <a href="index.php" class="nav-item nav-link ">Home</a>
        <a href="about.php" class="nav-item nav-link">About</a>
        <a href="service.php" class="nav-item nav-link">Service</a>
        <a href="products.php" class="nav-item nav-link ">Products</a>

        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="price.php" class="dropdown-item">Pricing Plan</a>
            <a href="open.php" class="dropdown-item">Working Hours</a>
          </div>
        </div>

        <a href="contact.php" class="nav-item nav-link active">Contact</a>


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
      <h1 class="display-3  text-uppercase mb-3 animated slideInDown">Contact</h1>
      <nav aria-label="breadcrumb animated slideInDown">
        <ol class="breadcrumb justify-content-center text-uppercase mb-0">
          <li class="breadcrumb-item"><a style="color: #6C7293;" href="#">Home</a></li>
          <li class="breadcrumb-item"><a style="color: #6C7293;" href="#">Pages</a></li>
          <li style="color: #d6a553;" class="breadcrumb-item  active" aria-current="page">Contact</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- Page Header End -->


  <!-- Contact Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-0">
     
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
          <div class="bg-secondary p-5">
            <p style="color: #d6a553;" class="d-inline-block bg-dark  py-1 px-4">Contact Us</p>
            <h1 class="text-uppercase mb-4">Have Any Query? Please Contact Us!</h1>
            <p style="color: #6C7293;" class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done.</p>
            <form method="post">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control bg-transparent" name="name"  id="name" placeholder="Your Name">
                    <label for="name">Your Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="phone"  name="phone" class="form-control bg-transparent" id="phone"  placeholder="Your phone">
                    <label for="phone">Your Phone</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="email" class="form-control bg-transparent" name="email" id="email"   placeholder="Your email">
                    <label for="email">Your email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control bg-transparent" name="mess" placeholder="Leave a message here" id="message" style="height: 100px" ></textarea>
                    <label for="message">Message</label>
                  </div>
                </div>
                <div class="col-12">
                  <input class="btn w-100 py-3" name="submit" type="submit"></input>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
  <div class="h-100" style="min-height: 400px;">
    <iframe class="google-map w-100 h-100"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14581.182292346502!2d67.06122822926829!3d24.924057798384224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f242ff0db27%3A0xaec9b65c44de2200!2sC%2026%2F1%2C%20Block%2010%20A%2C%20Gulshan-e-Iqbal%2C%20Karachi!5e0!3m2!1sen!2s!4v1699847165187!5m2!1sen!2s"
      frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0" style="filter: grayscale(100%) invert(92%) contrast(83%); border: 0;"></iframe>
  </div>
</div>

        
      </div>
    </div>
  </div>
  <!-- Contact End -->

  <!-- feedback Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-0">
        <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
          <div class="bg-secondary p-5">

            <h1 class="text-uppercase mb-4">Feedback Us</h1>

            <form action="" method="post" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input  name="name" type="text" class="form-control bg-transparent" id="name" >
                    <label for="name"> Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input  name="email" type="email" class="form-control bg-transparent" id="email" >
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input  name="message" type="text" class="form-control bg-transparent" id="subject" >
                    <label for="subject">Feedback</label>
                  </div>
                  <div class="form-group mt-3">
                    <input type="file" name="f_img" class="form-control bg-transparent">
                    <label for="image">Upload Image:</label>
                  </div>
                </div>
                <div class="col-12">
                  <input name="insert" class="btn w-100 py-3" type="submit"></input>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- feedback End -->



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


<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #000; color: #d6a553;">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Your Message has been submitted successfully!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #d6a553; color: #000;">Close</button>
        </div>
      </div>
    </div>
</div>

<style>
  .modal-content {
    background-color: #000; /* Black background */
    color: #d6a553; /* Gold text */
}

.modal-header {
    border-bottom: 1px solid #d6a553; /* Gold border for header */
}

.btn-close-white {
    filter: invert(1); /* Make close button white */
}

.modal-footer .btn-secondary {
    background-color: #d6a553; /* Gold background for footer button */
    color: #000; /* Black text */
}

.modal-footer .btn-secondary:hover {
    background-color: #b4931d; /* Darker gold on hover */
}

</style>

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg-square back-to-top bg-dark m-1"><i style="color: #d6a553 " class="bi bi-arrow-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
    $(document).ready(function() {
      <?php if (isset($_SESSION['feedback_success'])): ?>
        $('#successModal').modal('show');
        <?php unset($_SESSION['feedback_success']); ?>
      <?php endif; ?>
    });
  </script> 

  <!-- Back to Top -->

  <a href="#" class="btn btn-lg-square back-to-top bg-dark m-1"><i style="color: #d6a553 " class="bi bi-arrow-up"></i></a>


</body>

</html>