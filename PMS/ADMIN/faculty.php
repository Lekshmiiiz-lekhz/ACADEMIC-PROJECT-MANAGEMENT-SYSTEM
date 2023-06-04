<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
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
</table><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
    <th width="6%" scope="col">&nbsp;</th>
  </tr>
</table>
    <br/><br/>
    <div class="container">
    <form method="post" action="fa.php">
        <br/><br/><br/><br/>
        <div class="form-group">
  <table>
  <tr>
    <th width="7%" scope="col">&nbsp;</th>
    <th width="43%" scope="col">&nbsp;</th>
    <th width="44%" scope="col">&nbsp;</th>
    <th width="6%" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>Faculty ID</td>
    <td><input id="in" class="form-control" type="text" name="id"/></td>
    
  </tr>
  <tr>
    <td>Name</td>
    <td><input id="in" class="form-control" type="text" name="faname"/></td>

  </tr>
  <tr>

    <td>Email</td>
    <td><input id="in" class="form-control" type="email" name="faemail"/></td>
  
  </tr>
  <tr>

    <td>Phone </td>
    <td><input id="in" class="form-control" type="text" name="faphone"/></td>
    
  </tr>
  <tr>

    <td>Password</td>
    <td><input id="in" class="form-control" type="password" name="fapass"/><font color="red">*</font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td>Qualification</td>
    <td><input  id="in" class="form-control" type="text" name="faqulification"/></td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" class="btn btn-success" name="add" value="Add" id="bt"/>
    				
    <td>&nbsp;</td>
  </tr>
            </table>  <br/><br/></div></form>
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
    
    

<p>&nbsp;</p>
