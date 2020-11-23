<?php
include('db-con.php');
session_start();

$uname = $_POST['uname'];
$pass = $_POST['pass'];
$sql = "SELECT * FROM users where password='$pass' and uname ='$uname'";

$result = $db->query($sql);


$row = $result->fetch_assoc();
if($row!= NULL)
{
    $_SESSION['uid']= $row['uid'];
    $_SESSION['uname'] = $row['uname'];
    header("Location: main/display.php");
}
else
{
    header("Location: index.html");
}
?>

