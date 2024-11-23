<?php
include '../config.php'; // Ensure you have the correct path to your config file
session_start();


// Check if the user is logged in
if (!isset($_SESSION['email'])) {
  // If not logged in, redirect to the login page with an alert message
  echo "<script>
      alert('You need to log in to book an appointment.');
      window.location.href = '../registration/signin.php';
  </script>";
  exit; // Stop further execution
}


// Fetch services from the database
$servicesList = $conn->query("SELECT * FROM service");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $selected_services = $_POST['services'] ?? []; 


    $_SESSION['user_email'] = $email;

 
    $current_date = date('Y-m-d');

    if ($date < $current_date) {
        echo "<script>alert('You cannot select a past date. Please choose today or a future date.');</script>";
    } else {
        $service_details = [];
        $total_price = 0;

        if (!empty($selected_services)) {
            $service_ids_for_query = implode(',', array_map('intval', $selected_services));
            $result = $conn->query("SELECT id, Title, Price FROM service WHERE id IN ($service_ids_for_query)");

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $service_details[] = $row['id'] . ':' . $row['Title'];
                    $total_price += $row['Price'];
                }
            } else {
                echo "Error fetching services: " . $conn->error; // Error logging
            }
        }

        $services_string = implode(',', $service_details);

        // SQL query to insert appointment only if the date is valid (today or in the future)
        $sql = "INSERT INTO appointments (fullname, contact, email, date, services, total_price) 
                VALUES ('$fullname', '$contact', '$email', '$date', '$services_string', '$total_price')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Your appointment request has been received. We will get back to you shortly.');</script>";
        } else {
            echo "Error: " . $conn->error; // Error logging
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Appointment</title>
    <script>
function notLoggedInAlert() {
    alert("You need to log in to book an appointment.");
    window.location.href = "../registration/signin.php"; // Redirect to the login page after the alert
}
</script>
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

<!-- Template Stylesheet -->
    <!-- Add your other stylesheets and scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const checkboxes = document.querySelectorAll(".service-checkbox input");
            const totalPriceDisplay = document.getElementById("total-price");

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateTotal);
            });

            function updateTotal() {
                let total = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.getAttribute("data-price"));
                    }
                });
                totalPriceDisplay.textContent = `${total.toFixed(2)}`;
            }
        });
    </script>
</head>
<body>

<!-- Navbar and other HTML elements -->

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

        <a href="../contact.php" class="nav-item nav-link">Contact</a>


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
          <a href="../registration/logout.php" class="dropdown-item">Logout</a>
        </div>
      </div>
    <?php else: ?>
      <a href="../registration/signup.php" class="btn rounded-0 py-2 px-lg-4 d-none d-lg-block">Registration<i class="fa fa-arrow-right ms-3"></i></a>
    <?php endif; ?>
  </nav>
  <!-- Navbar End -->
<!-- Appointment Form HTML -->
<div class="content-wrapper">
    <div class="appointment-container">
        <h1>Book an Appointment</h1>
        <form id="appointmentForm" action="" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" class="form-control " required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" name="contact" class="form-control " required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control " required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date">Date of Appointment</label>
                    <input type="date" id="date" name="date" class="form-control " required>
                </div>
                <div class="col-12 mb-3">
                    <label>Select Services</label>
                    <div id="service-list">
                        <?php while ($row = $servicesList->fetch_assoc()): ?>
                            <div class="service-name"><?php echo htmlspecialchars($row['Title']); ?></div>
                            <div class="service-price"><?php echo htmlspecialchars($row['Price']); ?></div>
                            <div class="service-checkbox">
                                <input type="checkbox" name="services[]" 
                                       value="<?php echo $row['id']; ?>" 
                                       data-price="<?php echo $row['Price']; ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="total-price">
                <span>Total:</span>
                <span id="total-price">Rs.0</span>
            </div>
            <input type="submit" class="btn btn-warning w-100 mt-3" value="Book Appointment"></input>
        </form>
    </div>
</div>


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

</body>
</html>
