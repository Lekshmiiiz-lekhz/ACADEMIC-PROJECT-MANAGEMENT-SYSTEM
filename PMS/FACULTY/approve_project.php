<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
$pname =  $_POST['pname'];
$p_id =  $_POST['p_id'];
$s_id =  $_POST['s_id'];
if(empty($_SESSION['Email']))
{
header("location:index.php");
}
////////////////////////////////////
include "connect.php";
////////////////////////////////////////////////////////////////////////////
// Collecting  data
                include "../STUDENT/chat/config.php";
                $not="You have initiated a project waiting for approval";
	            $noti="UPDATE `project` SET approval ='1' WHERE id = '$p_id'";
	            $query = mysqli_query($conn,$noti);
	             if($query!=TRUE)
	                  {
	                	echo "Something went wrong";
                    }
                    $notiii=$pname." project is accepted by ".$user." now ".$user." can send you messages check chat";
	                  $notii="INSERT INTO `notification`(`s_id`, `details`) VALUES ('".$s_id."', '".$notiii."')";
	                  $query = mysqli_query($conn,$notii);
	                  if($query!=TRUE)
	                  {
	                	echo "Something went wrong";
                    }
					else{
						header("location:view.php");
					}

?>