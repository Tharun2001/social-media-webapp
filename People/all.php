<?php
include '../db-con.php';
session_start();
$uid = $_SESSION['uid'];
$sql =  "SELECT uid,uname,profilepic,bio from users WHERE 
        uid not IN 
        (SELECT fid as uid FROM friends WHERE uid in (SELECT uid FROM friends WHERE fid = '$uid') and fid not in (SELECT uid FROM friends WHERE fid = '$uid') and fid != '$uid'
        UNION
        SELECT DISTINCT(uid) from friends WHERE fid in (SELECT uid from friends WHERE fid = '$uid') and uid not in (SELECT uid from friends WHERE fid = '$uid') and uid != '$uid'
        UNION
        SELECT fid as uid FROM friends WHERE uid = '$uid' and fid not in (SELECT uid from friends WHERE fid = '$uid')) 
        and 
        uid not in (SELECT uid from friends WHERE fid = '$uid') and uid != '$uid'";
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