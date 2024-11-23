<?php

$Server_name="localhost";
$user_name="root";
$user_pass="";
$database="hair_salon";

$conn = mysqli_connect($Server_name,$user_name,$user_pass,$database);

if($conn){
    // echo "connected  successfully";
}else{
    echo "not connected";

}

?>