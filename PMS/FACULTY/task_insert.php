<?php 
include "chat/config.php";
session_start();
if($_POST)
{
	$name=$_POST['tname'];
	$discription=$_POST['tdiscription'];
    $due_date =$_POST['tdue_date']; 
	$pid = $_POST['p_id'];
   	$sq = "SELECT s_id FROM project WHERE id ='$pid'";
   	$result = $conn->query($sq);
   	if ($result->num_rows > 0) {
  	// output data of each row
    while($row = $result->fetch_assoc()) {
          $s_id =  $row["s_id"]; 
   			}
	}
	$f_id = $_POST['f_id'];
	$sql="INSERT INTO `tasks`(`t_name`,`s_id`, `t_discription`, `t_due_date`, `P_id`, `f_id`) VALUES ('".$name."','".$s_id."', '".$discription."', '".$due_date."', '".$pid."', '".$f_id."')";
	$query = mysqli_query($conn,$sql);
	if($query)
	{
		header('Location: index.php');
	}
	else
	{
		echo "Something went wrong";
	}
	
	}
?>