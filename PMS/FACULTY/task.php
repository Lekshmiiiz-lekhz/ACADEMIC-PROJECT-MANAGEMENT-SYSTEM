<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
include "connect.php";
include '../connection.php';
if(empty($_SESSION['Email']))
{
header("location:../index.php");
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
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view.php">Project</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="task.php">Task</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="notification.php">Notification</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="skill.php">Skill</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="boy">
 
<?php

$sql = "SELECT * FROM tasks WHERE f_id ='$user' AND cnfirm ='404' ";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
    <div class="container">
    
    <p><?php echo $row["t_name"];?></p>
    <span class="time-right"><?php echo $row["s_id"];?></span>
    <form action="review_task.php" method="post">
    <input type="hidden" name="id"  value="<?php echo $row["t_id"];?>">
    <button vlaue="Submit" type="submit" class="btn-warning" name="" id="">Review</button>
   </form>
  </div>
   
    
  <?php
  }
} else 
{
?>
<div class="container">
    <p>No task within dedline available</p>
    <span class="time-right"></span>
  </div>
  <?php
}
?>
</div>
</div>
</body>
</html>