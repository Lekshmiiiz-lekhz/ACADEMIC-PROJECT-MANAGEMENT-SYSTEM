<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
if(empty($_SESSION['Email']))
{
header("location:../index.php");
}
include "connect.php";
include '../connection.php';
?>
 <html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.boy {
  margin: 0 auto;
  max-width: 40%;
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
<audio src="noti.mp3" autoplay="autoplay" ></audio>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item  active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="project.php">Project</a>
      </li>
      <li class="nav-item">
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

       
        $sql2 = "SELECT * FROM tasks WHERE s_id = '$user'";
        $res = $connection->query($sql2);
        if ($res->num_rows > 0) {
          while ($row1 = $res->fetch_assoc()) {
              $due_date = strtotime($row1['t_due_date']);
              $today = strtotime('today');
              $yesterday = strtotime('yesterday');
              $cnfrm = $row1['cnfirm'];

              if ($due_date <= $yesterday) {
                  // Due date has already passed
                  echo '<div class="alert alert-danger" role="alert">' . $row1['t_discription'] . ' <a href="#" class="alert-link"><P><h4>' . $row1['t_name'] . '</h4></a></P>. Link has been deactivated since the deadline has passed (' . $row1['t_due_date'] . ').</div>';
              } elseif ($due_date <= $today) {
                  // Due date is today or in the past
                  echo '<div class="alert alert-warning" role="alert">' . $row1['t_discription'] . ' <a href="#" class="alert-link"><P><h4><form action="submit_task.php" method="POST"><input type="hidden" name="t_id" value="' . $row1['t_id'] . '"><input class="btn btn-primary" type="submit" value="' . $row1['t_name'] . '"></form></h4></a></P> will be deactivated after ' . $row1['t_due_date'] . '. <audio src="../noti.mp3" autoplay="autoplay"></audio></div>';
              } elseif ($cnfrm == "404"||$cnfrm == "808") {
                  // Task has been completed
                  echo '<div class="alert alert-success" role="alert">' . $row1['t_name'] . ' <a href="#" class="alert-link"> view</a>. This task has been completed.</div>';
              } else {
                  // Due date is in the future and task has not been completed
                  echo '<div class="alert alert-info" role="alert">' . $row1['t_discription'] . ' <a href="#" class="alert-link"><P><h4>' . $row1['t_name'] . '</h4></a></P> will be deactivated after ' . $row1['t_due_date'] . '.</div>';
              }
          }
      }
?>

</div>
</div>
</div>
</div>
</body>
</html>