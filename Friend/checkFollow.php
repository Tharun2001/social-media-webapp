<?php
include("../db-con.php");
session_start();

$fid = $_POST['fid'];
$uid = $_SESSION['uid'];
$sqlCheck = "select * from friends where uid = '$fid' and fid = '$uid' ";
$result = $db->query($sqlCheck);
$array = array();
if(mysqli_num_rows($result))
{
    echo "Yes";
}
else
{
    echo "No";
}

?>