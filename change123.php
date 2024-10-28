<?php
include "dbcon.php";

session_start();


  $img_name = $_FILES['logo']['name'];
  $img_size = $_FILES['logo']['size'];
  $tmp_name = $_FILES['logo']['tmp_name'];
  $error = $_FILES['logo']['error'];

   if ($error === 0) {
    if ($img_size > 10000000000) {
      $em = "Sorry, your file is too large.";
        echo $em;
    }else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);

      $allowed_exs = array("png","jpg"); 

      if (in_array($img_ex_lc, $allowed_exs)) {
      	  $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'upload/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

       $id = $_SESSION['id'];

       $sql = "UPDATE carwash SET image='$new_img_name' WHERE id= '$id'";
         if(mysqli_query($conn,$sql)){


        	   header("Location: carprofile.php");

         }
       }
    }
  }else {
    $em = "unknown error occurred!";
    echo $em;
  }

?>