<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
$suggestion =  $_POST['suggestion'];
$score =  $_POST['score'];
$t_id =  $_POST['t_id'];
if(empty($_SESSION['Email']))
{
header("location:index.php");
}
////////////////////////////////////
include "connect.php";
////////////////////////////////////////////////////////////////////////////
// Collecting  data
                include "chat/config.php";
	            $noti="UPDATE `tasks` SET  `suggestion`='$suggestion',`mark_percentage`='$score',`cnfirm`='808' WHERE t_id = '$t_id'";
	            $query = mysqli_query($conn,$noti);
	             if($query!=TRUE)
	                  {
	                	echo "Something went wrong";
                    }
					else{
						header("location:task.php");
					}

?>