<?php
include ('config.php');

if(isset($_POST['register']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $contact = $_POST['contact'];

    $sql   ="INSERT INTO `registration`( `Name`, `Email`, `Password`,`Contact`) VALUES ('$name','$email','$pass','$contact')";
    $result=mysqli_query($conn,$sql);
    if($result){ 
        header('location:../index.php');
    }else{
        die(mysqli_error($conn)) ;
    }
   
}
