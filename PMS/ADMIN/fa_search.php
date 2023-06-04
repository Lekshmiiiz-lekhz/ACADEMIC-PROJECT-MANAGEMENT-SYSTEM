<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];



include './connection.php';

if(isset($_POST['update']))
{
           $id=$_POST['fid']; 
           $name=$_POST['faname'];
           $email=$_POST['faemail'];
           $phone=$_POST['faphone'];
           $pass=$_POST['fapass']; 
           $qualification=$_POST['faqualification'];
           
           if (!empty($id)|| !empty($name)||!empty($email)||!empty($phone)||!empty($pass)||!empty($qualification))
           {
              
            $sql= "UPDATE `pmas`.`faculty` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `password` = '$pass', `qualification` = '$qualification' WHERE `faculty`.`f_id` = '$id';";
                mysqli_query($conn, $sql);
                $conn->close();
                header('Location:fa_search.php');  
           }
        else
            
        {
              echo 'Please fill up all fields';
              header('Location:fa_search.php');
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
    <br/><br/><br/>
    <div class="container">
    <form method="post" action="fa_search.php">
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
    <td align="right"><font size="5">Faculty ID&nbsp;:&nbsp; </font>    </td>
    <td>
        <?php
            include '../connection.php';
             $sql="select f_id from faculty";
             $result=  mysqli_query($conn, $sql)
             ?> <select name="id" style="width: 10em; height: 2em; font-size: 15px;">
                 <?php
                 while($row = mysqli_fetch_assoc($result))
                 {
                     $category= $row['f_id'];
                     ?>
                 <option selected="selected" value="<?php echo $category; ?>"><?php echo $category;?></option>
                 <?php
                 }
     ?>
             
             </select></td>
  </tr>
               <tr>
                   <td colspan="3" align="center"><input id="bt" type="submit" class="btn btn-success" name="search" value="Search" />
    </td>
    <td>&nbsp;</td>
  </tr>
       </table>
       </div> 
       <br/><br/>
       <div style="background-color: beige; margin-left: 33%; alignment-adjust: central; width: 35%">
<?php
 if(isset($_POST['search']) && !empty($_POST['search']))
{ 
  ?>
       <table align="center"  width="100%" cellspacing="00" cellpadding="05">
       <?php
       if (isset($_POST['search']))
       {
                    $username=$_POST['id'];
                    $sql1="select * from faculty where f_id ='$username'; ";
                    $rec=mysqli_query($conn, $sql1);
                    $row=mysqli_fetch_assoc($rec);
       }
       ?>
       
       <tr>
    <td>Faculty ID</td>
    <td><input id="in" type="text" class="form-control" name="fid" value="<?php echo $row['f_id'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
       
       
  <tr>
    <td>Name</td>
    <td><input id="in" type="text" class="form-control" name="faname" value="<?php echo $row['name'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input id="in" type="email" class="form-control" name="faemail" value="<?php echo $row['email'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input id="in" type="text" class="form-control" name="faphone" value="<?php echo $row['phone'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Password </td>
    <td><input id="in" type="password" class="form-control" name="fapass" value="<?php echo $row['password'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Qualification</td>
    <td><input  id="in" type="text" class="form-control" name="faqualification" value="<?php echo $row['qualification'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr align="center">
    <td>&nbsp;</td>
    <td colspan="2">
        <input type="submit" name="update" class="btn btn-success" value="Update" id="bt" />
    				
    <td>&nbsp;</td>
  </tr>
</table>
<?php }
?>
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
      


