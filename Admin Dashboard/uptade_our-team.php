<?php

include 'config.php';


 if(isset($_POST['insert'])){
     $person_tmp = $_FILES['p_image']['tmp_name']; 
     $person_name = $_POST['p_name'];
     $person_pro = $_POST['p_p'];
     $person_img = $_FILES['p_image']['name'];
$prod_tmp = $_FILES['p_image']['tmp_name']; 



// echo $password. "<br>";

$update_query = "UPDATE `our-team` SET `person_iamges`='$person_img',`persom_name`='$person_name',`profession`='$person_pro' WHERE id ='$id'";

$validate = mysqli_query($verify,$update_query);

if($validate){
    header('location: show_team.php');
}
move_uploaded_file($prod_tmp, "p_imgs/" . $person_img);
 }


?>