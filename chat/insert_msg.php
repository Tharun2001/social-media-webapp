<?php 
include '../db-con.php';
$msg = $_POST['msg'];
$send_id = $_POST['send_id'];
$rec_id = $_POST['rec_id'];
echo $msg;
echo $send_id;
echo $rec_id;
$sql = "INSERT into chat(send_id,rec_id,msg) values('$send_id','$rec_id','$msg')";
$db->query($sql);
?>