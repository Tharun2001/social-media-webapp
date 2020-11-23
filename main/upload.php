<?php
  include("../db-con.php");
  session_start();
  $uid = $_SESSION['uid'];
  $msg = "";
  if (isset($_POST['upload'])) {
  	
    $image = $_FILES['image']['name'];
    if( strlen($image) != 0 )
    {
      $target = "C:\\xampp\htdocs\socialmedia\image\image".basename($image);
      $sql = "INSERT INTO posts(uid,post) VALUES('$uid','$image')";
    
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
         $db->query($sql);
        $msg = "Image uploaded successfully";
        header("Location: display.php");
      }
      else{
        $msg = "Failed to upload image";
      }
    }
    else
    {
      header("Location: display.php");
    }
  }
?>
