<?php
include '../db-con.php';
$send_id = $_POST['send_id'];
$sql =  "SELECT f.uid as fid, u.uname, u.profilepic from (SELECT uid from friends WHERE fid = '$send_id') f left JOIN (SELECT * from users) u on f.uid = u.uid";
$result = $db->query($sql);
$array = array();
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
    echo json_encode($array);
}
else {
    echo "0 results";
}
?>
