<?php
include('../db-con.php');
session_start();

$uid = $_GET['id'];
$sql = "SELECT u.uid,u.uname,u.profilepic from (SELECT fid from friends WHERE uid = '$uid') f 
        LEFT join 
        (SELECT * from users) u on u.uid = f.fid ";

$result = $db->query($sql);

if(mysqli_num_rows($result))
{
 while($row = mysqli_fetch_array($result))
 {

      $array[] = $row;
 }
}
echo json_encode($array);

?>