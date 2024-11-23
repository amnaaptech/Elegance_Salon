<?php
session_start();
include 'config.php';

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');  // Redirect to login page if user is not logged in
    exit;
}

// User ID from session
$user_id = $_SESSION['user_id'];

// Update item quantity
if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id' AND user_id = '$user_id'");
    if ($update_query) {
        header('location:cart.php');
    }
}

// Remove individual item
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id' AND user_id = '$user_id'");
    if ($remove_query) {
        header('location:cart.php');
    }
}

// Remove all items
if (isset($_GET['delete_all'])) {
    $delete_all_query = mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");
    if ($delete_all_query) {
        header('location:cart.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet" />
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
  <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS (requires jQuery) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<style>
/* Scoped CSS for Cart Section */
.shopping-cart {
    background-color: #191C24;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
    color: white;
}

.shopping-cart h1.heading {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2em;
    color: #F2B33F;
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.cart-table th, 
.cart-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    color: white;
}

.cart-table th {
    background-color: #444;
    color: #d6a553;
    background-color: #191C24;
}

.cart-table td img.cart-image {
    width: 80px;
    height: 80px;
    border-radius: 5px;
}

.cart-table td form input[type="number"] {
    width: 60px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
}

.cart-table td form input[type="submit"] {
    background-color: #F2B33F;
    color: #000;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.cart-table td form input[type="submit"]:hover {
    background-color: #007b8c;
    color: white;
}

.cart-table td .delete-btn {
    text-decoration: none;
    background-color: #d9534f;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
}

.cart-table td .delete-btn:hover {
    background-color: #c9302c;
}

.shopping-cart .btn {
    display: inline-block;
    text-decoration: none;
    padding: 10px 20px;
    background-color: #007b8c;
    color: white;
    border-radius: 5px;
    transition: 0.3s;
}

.shopping-cart .btn:hover {
    background-color: #F2B33F;
    color: black;
}

.checkout-btn {
    text-align: center;
    margin-top: 20px;
}

.checkout-btn .btn {
    text-decoration: none;
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    transition: 0.3s;
}

.checkout-btn .btn:hover {
    background-color: #218838;
}

.checkout-btn .btn.disabled {
    background-color: #6c757d;
    pointer-events: none;
}

</style>

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
      <a href="service.php" class="nav-item nav-link ">Service</a>
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
<div class="container">
    <section class="shopping-cart">
        <h1 class="heading">Shopping Cart</h1>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                            $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                            $grand_total += $sub_total;
                ?>
                <tr>
                    <td><img src="<?php echo "p_imgs/" .$fetch_cart['image']; ?>" class="cart-image" alt=""></td>
                    <td><?php echo $fetch_cart['name']; ?></td>
                    <td><?php echo number_format($fetch_cart['price']); ?>/-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                            <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                            <input type="submit" value="Update" name="update_update_btn">
                        </form>
                    </td>
                    <td><?php echo number_format($sub_total); ?>/-</td>
                    <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn">Remove</a></td>
                </tr>
                <?php 
                        }
                    }
                ?>
                <tr>
                    <td><a href="products.php" class="btn">Continue Shopping</a></td>
                    <td colspan="3">Grand Total</td>
                    <td><?php echo number_format($grand_total); ?>/-</td>
                    <td><a href="cart.php?delete_all" class="btn">Delete All</a></td>
                </tr>
            </tbody>
        </table>
        
        <?php if ($grand_total > 0): ?>
            <div class="checkout-btn">
                <a href="checkout.php?user_id=<?php echo $user_id; ?>" class="btn">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <div class="checkout-btn">
                <button class="btn disabled">No Items in Cart</button>
            </div>
        <?php endif; ?>
    </section>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
