<?php
include '../../db-con.php';
$uid = $_POST['uid'];
$pid = $_POST['pid'];
$comment = $_POST['comment'];
$sql = "INSERT into comment(uid,pid,comnt) values('$uid','$pid','$comment')";
$result = $db->query($sql);
?>