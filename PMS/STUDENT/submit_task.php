<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
$t_id = $_POST['t_id'];
if(empty($_SESSION['Email']))
{
header("location:index.php");
}

////////////////////////////////////
include "connect.php";
////////////////////////////////////////////////////////////////////////////
// Collecting  data
////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
if(isset($_FILES) & !empty($_FILES)){
  $name = $_FILES['productimage']['name'];
  $size = $_FILES['productimage']['size'];
  $type = $_FILES['productimage']['type'];
  $tmp_name = $_FILES['productimage']['tmp_name'];
  $t_id = $_POST['t_id'];
  
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
              $sql = "UPDATE `tasks` SET `documetnt`='$location$name',`cnfirm`='404' WHERE t_id = '$t_id'";
              $res = mysqli_query($connection, $sql);
              
                  // include "chat/config.php";
                  // $na=$f_id;
                  // $notiii=$pname." project from ".$s_id." has been assigned to you by system";
                  // $notii="INSERT INTO `notification`(`s_id`, `details`) VALUES ('".$na."', '".$notiii."')";
                  // $query = mysqli_query($conn,$notii);
                 
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
        <a class="nav-link active" href="index.php">Home<span class="sr-only">(current)</span> </a>
      </li>
      <li class="nav-item ">
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
    <?php
    
      $Date =  date('m/d/Y');
      $sql2 = "SELECT * FROM tasks WHERE  t_id = '$t_id'";
                      $res = $connection->query($sql2);
                      // output data of each row
                      if ($res->num_rows > 0) {
                          while ($row1 = $res->fetch_assoc()) {
if ($row1['cnfirm']=='0') {
    ?>
     <div class="alert alert-warning" role="alert">
        <?php echo $row1['t_discription'];?> <a href="#" class="alert-link"><P><h4><?php echo $row1['t_name'];?></h4></a></P>.link will be deactivated after deadline.<?php echo $row1['t_due_date'];?><input type = "hidden" value="<?php $row1['P_id']; ?>" name="P_id"><input type = "hidden" value="<?php echo $t_id; ?>" name="t_id">
      </div>
      
    
                     
                    <?php
}
else{
  ?>
 <div class="alert alert-success" role="alert">
 <?php echo $row1['t_name'];?> <a href="<?php echo $row1['documetnt'];?>" class="alert-link"> view</a>. this task is completed.

  <?php
}

?>
</div>
<div class="form-group">
			    <label for="productimage">Document</label>
			    <input type="file" name="productimage" id="productimage">
			    <p class="help-block">Only pdf are allowed.</p>
	</div>
  <input value="submit" type="submit" class="btn btn-primary">
</form>   
<?php           //  end of task while  
                     }
                    //  end of task if 
                  }    
      // end of while from project

                ?> 
</table>
    <br/><br />

  
</table>
   </div>       </body><br /><br /> </div>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
</div>
</body>
</html>
