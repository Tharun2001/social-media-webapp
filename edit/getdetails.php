<?php
include("../db-con.php");
session_start();
$uid = $_SESSION['uid'];
$sql = "select * from users where uid = '$uid' ";
$result = $db->query($sql);
$array = array();
if(mysqli_num_rows($result))
{
 while($row = mysqli_fetch_array($result))
 {
    $array[] = $row;
 }
}
echo json_encode($array);
?>