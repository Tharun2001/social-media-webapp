<?php
include("../db-con.php");
session_start();
$uid = $_SESSION['uid'];
$sqlCheck = "select * from likes where uid = '$uid' ";
$result = $db->query($sqlCheck);
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