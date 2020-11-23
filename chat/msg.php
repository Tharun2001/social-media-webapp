<?php
include '../db-con.php';
$send_id = $_POST['send_id'];
$rec_id = $_POST['rec_id'];
$sql = "SELECT * from chat where (send_id='$send_id' and rec_id='$rec_id') or (send_id='$rec_id' and rec_id='$send_id')  order by timestamp asc";
$result = $db->query($sql);
$array = array();
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
    echo json_encode($array);
}
?>
