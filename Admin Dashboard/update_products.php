<?php
include 'dbconnection.php';
session_start();

$id = $_POST['id'];
$p_img = $_FILES['p_image']['name'];
 $prod_tmp = $_FILES['p_image']['tmp_name']; 
  $p_title = $_POST['p_name'];
 $p_desc = $_POST['p_Description'];
  $p_price = $_POST['p_price'];
  $p_quan = $_POST['p_quantity'];


// Upload the image file to your server
$upload_dir = "../p_imgs/"; 
move_uploaded_file(  $prod_tmp, $upload_dir .$p_img);

$update_query = "UPDATE `products` SET`product_Image`='$p_img ',`Product_Title`=' $p_title',`Product_Description`=' $p_desc ',`Product_Price`='$p_price' , `prod_quantity`='$p_quan'  WHERE id = '$id';";

$validate = mysqli_query($con,$update_query);
if($validate){
   header('location:show_products.php');
} else {
   echo "Error: " . mysqli_error($con);
 }
?>
