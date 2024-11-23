<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$grand_total = 0;

// Process checkout when user clicks 'Proceed to Checkout'
if (isset($_GET['user_id'])) {
    // Retrieve cart items for the user
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

    // Loop through each cart item and insert into the 'orders' table
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $product_id = $fetch_cart['product_id'];  // Assuming 'product_id' is stored in the cart table
        $product_name = $fetch_cart['name'];
        $quantity = $fetch_cart['quantity'];
        $price = $fetch_cart['price'];
        $total_price = $quantity * $price;

        // Insert order details into 'orders' table
        $order_query = mysqli_query($conn, "INSERT INTO `orders`(`user_id`, `product_name`, `quantity`, `price`, `total_price`) 
                                            VALUES ('$user_id', '$product_name', '$quantity', '$price', '$total_price')");

        // Check if the order query was successful
        if ($order_query) {
            // Update product quantity in the 'products' table
            $update_product_quantity = mysqli_query($conn, "UPDATE `products` SET prod_quantity = prod_quantity - $quantity WHERE id = '$product_id'");

            // Check if the update query was successful
            if ($update_product_quantity) {
                // If product quantity update is successful, delete the item from cart
                $delete_cart_item = mysqli_query($conn, "DELETE FROM `cart` WHERE id = '".$fetch_cart['id']."' AND user_id = '$user_id'");
            } else {
                // Log the error if update fails
                echo "Error updating product quantity: " . mysqli_error($conn);
            }
        } else {
            // Log the error if insert fails
            echo "Error inserting order: " . mysqli_error($conn);
        }

        // Update the grand total
        $grand_total += $total_price;
    }

    // Redirect to receipt page after successful checkout
    header("location: receipt.php?order_id=$user_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Include CSS and Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <section class="shopping-cart">
        <h1 class="heading">Proceed to Checkout</h1>
        <div class="checkout-info">
            <h4>Total Amount: <?php echo number_format($grand_total); ?>/-</h4>
            <form action="checkout.php?user_id=<?php echo $user_id; ?>" method="post">
                <button type="submit" class="btn btn-success">Confirm Order</button>
            </form>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
