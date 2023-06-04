<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
if(empty($_SESSION['Email']))
{
header("location:index.php");
}
////////////////////////////////////
include "connect.php";
////////////////////////////////////////////////////////////////////////////
// Collecting  data
$sql = "SELECT f_id FROM faculty  ORDER BY RAND ( )  LIMIT 1  ";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   $f_id = $row["f_id"];
  }
} else {
  echo '<script>alert("No tutor available")</script>';
}
////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
if(isset($_FILES) & !empty($_FILES)){
    $name = $_FILES['productimage']['name'];
    $size = $_FILES['productimage']['size'];
    $type = $_FILES['productimage']['type'];
    $tmp_name = $_FILES['productimage']['tmp_name'];
    $pname = $_POST['pname'];
    $pdomain = $_POST['domain'];
    $s_id = $user;  
/////////////////////////////////////////////////////
///////////Add further details to table project like first review dfd er etc 
    ////////////////////////////////////
    $max_size = 10000000;
    $extension = substr($name, strpos($name, '.') + 1);

    if(isset($name) && !empty($name)){
        if(($extension == "pdf")&& $size<=$max_size){
            $location = "../STUDENT/images/";
            if(move_uploaded_file($tmp_name, $location.$name)){
                //$smsg = "Uploaded Successfully";
                $current_date = date('Y-m-d'); // get current date
              // calculate dates for each quadrant
              $first_quadrant = date('Y-m-d', strtotime($current_date . ' +25 days'));
              $second_quadrant = date('Y-m-d', strtotime($current_date . ' +50 days'));
              $third_quadrant = date('Y-m-d', strtotime($current_date . ' +75 days'));
              $fourth_quadrant = date('Y-m-d', strtotime($current_date . ' +100 days'));

                $sql = "INSERT INTO project (name, domain, s_id, f_id, abstract, first_quadrant, second_quadrant, third_quadrant, forth_quadrant ) VALUES ('$pname','$pdomain','$s_id','$f_id','$location$name','$first_quadrant','$second_quadrant','$third_quadrant','$fourth_quadrant')";
                $res = mysqli_query($connection, $sql);
                if($res){
                    echo '<script>alert("Project Created")</script>';
                    include "chat/config.php";
	                  $name=$_SESSION['Email'];
                    $not="You have initiated a project waiting for approval";
	                  $noti="INSERT INTO `notification`(`s_id`, `details`) VALUES ('".$name."', '".$not."')";
	                  $query = mysqli_query($conn,$noti);
	                  if($query!=TRUE)
	                  {
	                	echo "Something went wrong";
                    }
                    $note="Date To Remember ".$first_quadrant.": First Quadrant Review\n".$second_quadrant.": Second Quadrant Review\n".$third_quadrant.": Third Quadrant Review\n".$fourth_quadrant.": Fourth Quadrant Review\n";
	                  $notii="INSERT INTO `notification`(`s_id`, `details`) VALUES ('".$name."', '".$note."')";
	                  $query = mysqli_query($conn,$notii);
	                  if($query!=TRUE)
	                  {
	                	echo "Something went wrong";
                    }
	                  $na=$f_id;
                    $notiii=$pname." project from ".$s_id." has been assigned to you by system";
	                  $notii="INSERT INTO `notification`(`s_id`, `details`) VALUES ('".$na."', '".$notiii."')";
	                  $query = mysqli_query($conn,$notii);
	                  if($query!=TRUE)
	                  {
	                	echo "Something went wrong";
                    }
                   }else{
                    $fmsg = "Failed to Create Project";
                }
            }else{
                $fmsg = "Failed to Upload File";
            }
        }else{
            $fmsg = "Only pdf files are allowed and should be less that 1MB";
        }
    }else{
        $fmsg = "Please Select a File";
    }
}

/////////////////////////////////////////////////////////////////////////////////
/////get details
////////////////////////////////////////////////////////////////////////////////

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
      <li class="nav-item active">
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
<div>
    <br/><br /><br />
    <form method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="exampleInputEmail1">Project Name</label>
    <input type="text" name="pname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
    </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Domain of Project</label>
    <input type="text" name="domain" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description eg: e-comerce,machie learning......" required>
    </div>
    <div class="form-group">
			    <label for="productimage">Abstract</label>
			    <input type="file" name="productimage" id="productimage">
			    <p class="help-block">Only pdf are allowed.</p>
			  </div>
  <input value="submit" type="submit" class="btn btn-primary">
</form>
</table>
    <br/><br />
<form method="post" action="project.php"> 
    <div>
        <table align="center">
    <tr>
    <td>&nbsp;<br/><br/></td>
    <?php
    if(isset ($_POST['feedback']))
{
    include '../connection.php';
                    $sql1="select * from project where s_id ='$user' ";
                    $rec=mysqli_query($conn, $sql1);
                    
                    while($std=mysqli_fetch_assoc($rec))
                    {
                        ?>
    
                   <?php 
                    }
}?>
    <tr> 
        <td></td>
      
    <td>&nbsp;</td>
  </tr></form>
  
</table>
   </div>       </body><br /><br /> </div>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
</div>
</body>
</html>
