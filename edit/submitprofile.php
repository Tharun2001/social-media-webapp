<?php
  
  include("../db-con.php");
  session_start();
  $uid = $_SESSION['uid'];
  $msg = "";
  $uname = $_POST['name'];
  $pass = $_POST['password'];
  $bio = $_POST['bio'];
  if (isset($_POST['edit-submit'])) {
    $image = $_FILES['profilepic']['name'];
    if(strlen($image) == 0)
    {
      $sql = "UPDATE users SET uname='$uname',bio='$bio',password='$pass' where uid = '$uid'";
    }
    else
    {
      $sql = "UPDATE users SET uname='$uname',profilepic='$image',bio='$bio',password='$pass' where uid = '$uid'";
    }
    $db->query($sql);
    if( strlen($image) != 0 )
    {
        $target = "C:/xampp/htdocs/socialmedia/image/profilepic/".basename($image);
      if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
      }
      else{
        $msg = "Failed to upload image";
      }
    }
    else
    {
        header("Location: editprofile.html");
    }
    header("Location: editprofile.html");
  }

?>
