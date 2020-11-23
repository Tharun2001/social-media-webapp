<?php
include("../db-con.php");
session_start();
$pid = $_POST['pid'];
$uid = $_SESSION['uid'];
$sqlCheck = "select * from likes where pid = '$pid' and uid = '$uid'";
if(mysqli_num_rows($result = $db->query($sqlCheck)))
{
    $sqlDel = "delete from likes where pid = '$pid' and uid = '$uid'";
    $result = $db->query($sqlDel);
    echo 0;
    return;
}
$sql = "INSERT into likes(uid,pid) values('$uid','$pid')";
$result = $db->query($sql);
echo 1;
?>