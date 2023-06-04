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
                $sql = "INSERT INTO project (name, domain, s_id, f_id, abstract) VALUES ('$pname','$pdomain','$s_id','$f_id','$location$name')";
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
                    include "chat/config.php";
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