<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Validate ID
$id = intval($_GET['id']); // Ensure ID is an integer

// Secure user inputs
$title = mysqli_real_escape_string($con, $_POST['st']);
$description = mysqli_real_escape_string($con, $_POST['sd']);
$price = mysqli_real_escape_string($con, $_POST['sp']);
$image = mysqli_real_escape_string($con, $_FILES['img']['name']);
$image_tmp = $_FILES['img']['tmp_name'];

// Upload the image file to your server
$upload_dir = "../p_imgs/";
if (move_uploaded_file($image_tmp, $upload_dir . $image)) {
    // Update the record
    $update_query = "UPDATE `service` SET 
        `Image`='$image', 
        `Title`='$title', 
        `Description`='$description', 
        `Price`='$price' 
        WHERE id='$id'";

    $validate = mysqli_query($con, $update_query);

    if ($validate) {
        echo "Data Updated Successfully";
        header('location:show_service.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Failed to upload image.";
}
?>
