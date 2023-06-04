<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];



include './connection.php';

if(isset($_POST['update']))
{
            $id=$_POST['sid']; 
           $name=$_POST['stname'];
           $email=$_POST['stemail'];
           $phone=$_POST['stphone'];
           $pass=$_POST['stpass']; 
           $year=$_POST['styear'];
           $stream=$_POST['stream'];
           
           if (!empty($id)|| !empty($name)||!empty($email)||!empty($phone)||!empty($pass)||!empty($year)||$stream!="Select")
           {
              
            $sql= "UPDATE `pmas`.`student` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `password` = '$pass', `year` = '$year', `stream` = '$stream' WHERE `student`.`s_id` = '$id';";
                mysqli_query($conn, $sql);
                $conn->close();
                header('Location:stsearch.php');  
           }
        else
            
        {
              echo 'Please fill up all fields';
              header('Location:stsearch.php');
        }  
}







if(empty($_SESSION['Email']))
{
header("location:index.php");
}
else
{
if($role=="Admin")
{
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
	body
	{
		background-image:url(../black.jpeg);
		background-repeat: no-repeat; 
		background-attachment: fixed;
		background-size: 100% 100%;
	}
</style>
<title>Project Management System</title>
</head>
<div>
<body>
<table width="100%"  border="0"cellspacing="00" cellpadding="00">
  <tr bgcolor="#D2691E">
    <th width="74" scope="col">&nbsp;</th>
    <th width="164" scope="col"><a href="../Admin.php"><img src="../logo1.png" alt="LOGO"/></a></th>
    <th width="646" scope="col"><font size="8" color="White">Project Managenent System</font></th>
    <th width="140" scope="col"><font color="White" size="5">
	<?php
    print $role;
    ?></font></th>
    <th width="63" scope="col">&nbsp;</th>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#99CCFF">
      <th width="5%" scope="col"><h4>&nbsp;</h4></th>
      <th width="12%" scope="col"><a href="student.php">Add Student</a></th>
      <th width="11%" scope="col"><a href="faculty.php">Add Faculty</a></th>
      <th width="11%" scope="col"><a href="stsearch.php">Search Student</a></th>
      <th width="11%" scope="col"><a href="fa_search.php">Search Faculty </a></th>
      <th width="11%" scope="col"><a href="view_project.php">Projects</a></th>
      <th width="11%" scope="col"><a href="../logout.php">Logout</a></th>
    <th width="6%" scope="col">&nbsp;</th>
  </tr>
   
</table>
<br/><br/>
    <div class="container">
    <form method="post" action="stsearch.php">
      <div  class="form-group">
   <table>
  <tr>
    <th width="7%" scope="col">&nbsp;</th>
    <th width="43%" scope="col">&nbsp;</th>
    <th width="44%" scope="col">&nbsp;</th>
    <th width="6%" scope="col">&nbsp;</th>
  </tr>
   </table>
          
  <tr>
    <td>&nbsp;</td>
    <td align="right"><font size="5">Student ID&nbsp;:&nbsp;</font> </td>
    <td>
        <?php
            include '../connection.php';
             $sql="select s_id from student";
             $result=  mysqli_query($conn, $sql)
             ?> <select name="id" style="width: 10em; height: 2em; font-size: 15px; ">
                 
                 <?php
                 while($row = mysqli_fetch_assoc($result))
                 {
                     $category= $row['s_id'];
                     ?>
                 <option  value="<?php echo $category; ?>"><?php echo $category;?></option>
                 <?php
                 }
     ?>
            </select> 
    </td>
  </tr>
    <tr>
        <td colspan="3" align="center">
            <input type="submit" class="btn btn-success" name="search" value="Search" id="bt" />
    </td>
    <td>&nbsp;</td>
  </tr>
          </table>
          </div>
          <br/><br/>
          <?php
if(isset($_POST['search']) && !empty($_POST['search'])) {
    ?>
          <div style="background-color: beige; margin-left: 33%; alignment-adjust: central; width: 35%">
              <br/>
             
          <table align="center"  width="100%" cellspacing="00" cellpadding="03">
       <?php
         if (isset($_POST['search'])) {
             $username=$_POST['id'];
             $sql1="select * from student where s_id ='$username'; ";
             $rec=mysqli_query($conn, $sql1);
             $row=mysqli_fetch_assoc($rec);
         }
    ?>
       
       <tr>
    <td>Student ID</td>
    <td><input id="in" type="text" class="form-control" name="sid" value="<?php echo $row['s_id'];?>"/></td>
    
  </tr>
  <tr>
    <td>Name</td>
    <td><input id="in" type="text" class="form-control" name="stname" value="<?php echo $row['name'];?>"/></td>
    
  </tr>
  <tr>
    <td>Email</td>
    <td><input id="in" type="email" class="form-control" name="stemail" value="<?php echo $row['email'];?>"/></td>
    
  </tr>
  <tr>
    <td>Phone</td>
    <td><input id="in" type="text" class="form-control" name="stphone" value="<?php echo $row['phone'];?>"/></td>
  
  </tr>
  <tr>
    <td>Password</td>
    <td><input id="in" type="password" class="form-control" name="stpass" value="<?php echo $row['password'];?>"/></td>
    
  </tr>
  <tr>
    <td>Year</td>
    <td><input  id="in" type="text" class="form-control" name="styear" value="<?php echo $row['year'];?>"/></td>
    
  </tr>
  <tr>
    <td>Stream</td>
    <td><select name="stream" style="width: 13em; height: 2em; font-size: 15px; ">
         <option value="Selcet">Select</option>
         <option value="CSE" <?php if($row['stream']=='CSE') {
             echo 'selected="selected"';
         } ?>>CSE</option>
        <option value="MCA" <?php if($row['stream']=='MCA') {
            echo 'selected="selected"';
        } ?>>MCA</option>
        <option value="ECE" <?php if($row['stream']=='ECE') {
            echo 'selected="selected"';
        } ?>>ECE</option>
        <option value="BCA" <?php if($row['stream']=='BCA') {
            echo 'selected="selected"';
        } ?>>BCA</option>
        <option value="BSc" <?php if($row['stream']=='BSc') {
            echo 'selected="selected"';
        } ?>>MCA</option>
        <option value="CE" <?php if($row['stream']=='CE') {
            echo 'selected="selected"';
        } ?>>MCA</option>          
        </select></td>
  </tr>
  
  <tr align="center">
    <td>&nbsp;</td>
    <td colspan="2">
        <input type="submit" class="btn btn-success" name="update" value="Update" id="bt"/>
    				
    <td>&nbsp;</td>
  </tr>
</table>
<?php
}
?>
<br/>
      </div>
  </form>
 <?php
}
elseif($role=="Faculty")    
{
?>
    <?php
   header('Location:../Admin.php');
   ?>
 <?php
}
else   
{
?>
    <?php
   header('Location:../Admin.php');
   ?>
<?php
}
?>
</table>
<?php
}
?>
  


