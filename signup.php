<?php
include('db-con.php');
session_start();

$uname = $_POST['sign-uname'];
$pass = $_POST['sign-pass'];
$sqlCheck = "SELECT * FROM users where password='$pass' and uname ='$uname'";

$result = $db->query($sqlCheck);


$row = $result->fetch_assoc();
if($row == NULL)
{
    $sql = "INSERT into users(uname,password) VALUES('$uname','$pass')";
    $result = $db->query($sql);
    
    $sql = "SELECT * FROM users where password='$pass' and uname ='$uname'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['uid']= $row['uid'];
    $_SESSION['uname'] = $row['uname'];
    header("Location: main/display.php");
}
else
{
    echo '<h1>Username already taken</h1>';
    header("Location: index.html");
}

?>
