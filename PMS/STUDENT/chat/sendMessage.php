<?php 
include "config.php";
session_start();
if($_POST)
{
	$name=$_SESSION['Email'];
	$reciver=$_POST['reciver'];
    $msg=$_POST['msg']; 
	$sql="INSERT INTO `chat`(`name`, `reciver`, `message`) VALUES ('".$name."', '".$reciver."', '".$msg."')";
	$query = mysqli_query($conn,$sql);
	if($query)
	{
		header('Location: chat_view.php');
	}
	else
	{
		echo "Something went wrong";
	}
	
	}
?>