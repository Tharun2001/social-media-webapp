<?php
 include("../db-con.php");
 session_start();
 $uid = $_SESSION['uid'];
 $uname = $_SESSION['uname'];
 $sql = "SELECT p.pid,p.uname,p.profilepic, p.uid, p.post, p.timestamp, l.count 
 FROM 
 (SELECT pid, posts.uid,uname,profilepic, post, timestamp from posts, users where posts.uid = users.uid AND (posts.uid in (select uid from friends where friends.fid = '$uid' ) OR posts.uid = '$uid') ) p 
 left JOIN 
 (select likes.pid, likes.uid, count(likes.pid) as count from likes GROUP by pid) l 
 on 
 p.pid = l.pid ORDER BY p.timestamp DESC";

$result = mysqli_query($db, $sql);

 $array = array();
 if(mysqli_num_rows($result))
 {
  while($row = mysqli_fetch_array($result))
  {
    $array[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../mainstyle.css">
  <link rel="stylesheet" href="../navbar.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="comment/comment.js"></script>
  <script src="display.js"></script>
  <title>SoMe</title>
  
  <script type="text/javascript">
      sessionStorage.setItem('uid','<?php echo $uid ?>');
      sessionStorage.setItem('uname','<?php echo $uname ?>');
      var uname = sessionStorage.getItem('uname');  
      var uid = sessionStorage.getItem('uid');  
      window.onload=function()
      {
        var text = new Array();
        text = JSON.parse(`<?php echo json_encode($array); ?>`);
        console.log(JSON.stringify(text));        
        displaymain(uid,uname,text);
      }
  </script>

</head>
<body>
    <div id="nav-bar">
        <a class="home" style="background-color: #4CAF50;" href="display.php">Home</a>
        <a href="../logout.php">Logout</a>
        <a class="a-people" href="../People/people.html">People</a>
        <a class="a-chat" href="../chat/chat.html">Chat</a>
        <a class="a-profile" href="../Profile/profile.html">Profile</a>   
    </diV>
    <div id='main' style="display: block;">
    <form class="upload-form"  method="POST" action="upload.php" enctype="multipart/form-data" onsubmit="return postValidate()"> 
		  <input type="file" id="file" name="image">
		  <input class="post-btn" type="submit" value="POST" name="upload" >
	  </form>
    </div>

    <div id = 'profile' style="display: none;" >
    </diV>
</body>
</html>