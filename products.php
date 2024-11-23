<?php
session_start();
include 'config.php';

// Check if user is logged in, otherwise redirect
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect to login page if not logged in
  exit;
}

if (isset($_POST['add_to_cart'])) {
  $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
  $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
  $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
  $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
  $product_quantity = 1;

  // Get logged-in user ID from the session
  $user_id = $_SESSION['user_id'];

  // Check if the product already exists in the user's cart
  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' AND user_id = '$user_id'");

  if (mysqli_num_rows($select_cart) > 0) {
    // Product already in cart
    echo "<script>alert('Product already added to cart');</script>";
  } else {
    // Insert the product into the user's cart with the correct product_id
    $insert_product = mysqli_query($conn, "INSERT INTO `cart`(product_id, name, price, image, quantity, user_id) VALUES('$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$user_id')");
    
    if ($insert_product) {
      // Successful insertion
      echo "<script>alert('Product successfully added to cart');</script>";
    } else {
      // Error with insertion
      echo "<script>alert('Failed to add product to cart');</script>";
    }
  }
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
  <link rel="stylesheet" href="css/styles.css">


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
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
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

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    };
  };

  if (!isset($_SESSION['username'])):
  ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> You need to log in to add products to the cart.
    </div>
  <?php endif; ?>

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
        <a href="service.php" class="nav-item nav-link">Service</a>
        <a href="products.php" class="nav-item nav-link active">Products</a>




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
     <?php
    // Get the number of products in the user's cart
    $user_id = $_SESSION['user_id']; // Ensure this is set
    $select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
    $row_count = mysqli_num_rows($select_rows);
    ?>
    <a href="cart.php" class="cart-icon-container text-light position-relative">
      <i class="fa-solid fa-cart-shopping"></i>
      <span class="cart-badge position-absolute top-0 start-100 translate-middle bg-danger text-white rounded-circle">
        <?php echo $row_count; ?>
      </span>
    </a>

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
            <img class="w-100" src="<?php echo 'p_imgs/' . $row['Product_Image']; ?>" alt="Image" style="height:80vh;" />
            <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
              <div class="mx-sm-5 px-5" style="max-width: 900px">
                <h1 style="color: #d6a553;" class="display-2 text-uppercase mb-4 animated slideInDown">
                  <?php echo $row['Product_Title']; ?>
                </h1>
                <h4 class="text-white text-uppercase mb-4 animated slideInDown">
                  <i style="color: #d6a553;" class="fa fa-map-marker-alt me-3"></i>
                  <?php echo $row['Adress']; ?>
                </h4>
                <h4 class="text-white text-uppercase mb-4 animated slideInDown">
                  <i style="color: #d6a553;" class="fa fa-phone-alt me-3"></i>
                  <?php echo $row['Number']; ?>
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
  <?php
  if (isset($display_message)) {
    foreach ($display_message as $display_message) {
      echo "<div class='display_message'>
        <span>$display_message</span>
        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'></i></div>";
    }
  }
  ?>

 <!-- Product Section Starts -->
 <div class="container-xxl py-5" style="margin-bottom: 100px;">
    <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px">
        <p class="d-inline-block bg-secondary py-1 px-4">Products</p>
        <h1 class="text-uppercase">Beauty Products</h1>
      </div>

      <div class="row g-4">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM products");
        if (mysqli_num_rows($select_products) > 0) {
          while ($fetch_product = mysqli_fetch_assoc($select_products)) {
        ?>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="card h-100 d-flex flex-column align-items-center justify-content-center text-center"
                style="background-color: #191C24; color: white; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <form action="" method="post">
                  <div style="height: 250px; display: flex; justify-content: center; align-items: center;">
                    <img src="<?php echo "../project/p_imgs/" . $fetch_product['product_Image']; ?>" class="card-img-top" alt="Product Image"
                      style="width: 250px; height: 250px; object-fit: cover; border-radius: 50px 20px 20px 0px;">
                  </div>
                  <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h3 class="text-uppercase mb-3"><?php echo $fetch_product['Product_Title']; ?></h3>
                    <div class="price">Rs.<?php echo $fetch_product['Product_Price']; ?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['Product_Title']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['Product_Price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['product_Image']; ?>">

                    <?php if ($fetch_product['prod_quantity'] > 0): ?>
                      <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
                    <?php else: ?>
                      <button class="btn btn-danger" disabled>Out of Stock</button>
                    <?php endif; ?>
                  </div>
                </form>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  <!-- Products End -->

  <script src="js/script.js"></script>

  <style>
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.3);
    }

    .btn-square {
      background-color: #ffffff20;
      padding: 10px 12px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .cart-icon-container {
      text-decoration: none;
      color: white;
      display: flex;
      align-items: center;
      margin-right: 15px;
      font-size: 1.2em;
      margin-left: 20px;

    }
    .cart-icon-container i {
      margin-right: 5px;
      color: #F2B33F;
      transition: color 0.3s ease;
    }

    .cart-icon-container:hover i {
      color: #FFD700;
    }

    .cart-badge {
      font-size: 0.75em;
      padding: 5px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-width: 20px;
      height: 20px;
      font-weight: bold;
      line-height: 1;
      transform: translate(-50%, -50%);
      border: 1px solid white;
      box-shadow: 0 0 5px #FFD700;
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