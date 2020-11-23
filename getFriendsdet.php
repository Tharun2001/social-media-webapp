<?php
include('db-con.php');
session_start();

$uid = $_GET['id'];
$sql = "SELECT uff.uid, uff.uname, uff.profilepic, uff.bio, uff.followers, uff.following, p.posts 
from (SELECT uf.uid, uf.uname, uf.profilepic, uf.bio, uf.followers, f1.following 
FROM (SELECT u.uid,uname,profilepic,bio,followers from (SELECT uid,uname,profilepic,bio from users where uid = '$uid') u LEFT JOIN 
(SELECT uid,count(fid) as followers from friends GROUP by uid) f on u.uid = f.uid) uf LEFT JOIN 
(SELECT fid, count(uid) as following from friends GROUP by fid) f1 on uf.uid = f1.fid) uff 
left join (SELECT uid, count(pid) as posts from posts GROUP by uid) p on uff.uid = p.uid";

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