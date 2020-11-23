<?php
include("../db-con.php");
session_start();
$fid = $_POST['fid'];
$uid = $_SESSION['uid'];
$sqlCheck = "select * from friends where uid = '$fid' and fid = '$uid' ";
if(mysqli_num_rows($result = $db->query($sqlCheck)))
{
    $sqlDel = "delete from friends  where uid = '$fid' and fid = '$uid'";
    $result = $db->query($sqlDel);
    echo 0;
}
else
{
    $sql = "Insert into friends(uid,fid)  values('$fid','$uid')";
    $result = $db->query($sql);
    echo 1;
}
?>