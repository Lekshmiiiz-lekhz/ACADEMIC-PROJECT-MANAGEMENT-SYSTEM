<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
if(empty($_SESSION['Email']))
{
header("location:../index.php");
}
////////////////////////////////////
include "connect.php";
function timeAgo($time_ago) {
  $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
  $time  = time() - $time_ago;

switch($time):
// seconds
case $time <= 60;
return 'just now';
// minutes
case $time >= 60 && $time < 3600;
return (round($time/60) == 1) ? 'a minute' : round($time/60).' minutes ago';
// hours
case $time >= 3600 && $time < 86400;
return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago';
// days
case $time >= 86400 && $time < 604800;
return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' day ago';
// weeks
case $time >= 604800 && $time < 2600640;
return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
// months
case $time >= 2600640 && $time < 31207680;
return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
// years
case $time >= 31207680;
return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ;

endswitch;
}
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.boy {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  max-height: 100px;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="project.php">Project</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="notification.php">Notification</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="progress.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Progress</button>
    </form>
  </div>
</nav>
<div class="boy">
<?php
$sql = "SELECT * FROM notification WHERE s_id ='$user' ORDER BY id DESC";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
    <div class="container">
    <p><?php echo $row["details"];?></p>
    <span class="time-right"><?php echo timeAgo($row["time"]);?></span>
    <audio src="notification.mp3" autoplay="autoplay" ></audio>
  </div>
  <?php
  }
} else 
{
?>
<div class="container">
    <p>No notification available</p>
    <span class="time-right"></span>
  </div>
  <?php
}
?>
</div>
</div>
</body>
</html>

