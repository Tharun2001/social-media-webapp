<?php
include '../../db-con.php';

$pid = $_GET['pid'];
$sql = "SELECT c.pid,c.uid,u.uname,c.comnt,c.timestamp FROM comment c, users u where pid = '$pid' and c.uid = u.uid order by c.timestamp desc";
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