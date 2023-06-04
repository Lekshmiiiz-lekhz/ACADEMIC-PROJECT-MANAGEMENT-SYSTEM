<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
if(empty($_SESSION['Email']))
{
header("location:index.php");
}
include "connection.php";
    if ($role=="Admin") {
        ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project Management System</title>
</head>
<div>
<body>
    <table width="100%"  border="0"cellspacing="00" cellpadding="00">
  <tr bgcolor="#D2691E">
    <th width="74" scope="col">&nbsp;</th>
    <th width="164" scope="col"><img src="images/logo1.png" alt="LOGO"></th>
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
      <th width="12%" scope="col"><a href="ADMIN/student.php">Add Student</a></th>
      <th width="11%" scope="col"><a href="ADMIN/faculty.php">Add Faculty</a></th>
      <th width="11%" scope="col"><a href="ADMIN/stsearch.php">Search Student</a></th>
      <th width="11%" scope="col"><a href="ADMIN/fa_search.php">Search Faculty </a></th>
      <th width="11%" scope="col"><a href="ADMIN/view_project.php">Projects</a></th>
      <th width="11%" scope="col"><a href="logout.php">Logout</a></th>
    <th width="6%" scope="col">&nbsp;</th>
  </tr>
    <tr>
   
    </tr>
</table>
<div class="container"> 
      
<div class="boy">
<div class="page-content page-container" id="page-content">

    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-4 grid-margin stretch-card">
            <?php
$sql = "SELECT * FROM student";
$k =0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) 
  $row = $k++;{
   

}
}
?>
 <div class="card">
     
     <div class="card-body">
       <h4 class="card-title"> </h4>
       <p class="card-description"></p>
       <div class="template-demo">
         <table class="table mb-0">
           <thead>
             <tr>
               <th class="pl-0">No of STUDENTS </th>
               <th class="text-right"><?php echo $k; ?></th>
             </tr>
           </thead>
           <tbody>
           </tbody>
         </table>
       </div>
     </div>
   </div>


            </div>
        </div>
    </div>
</div>
</div>
<div class="boy">
<div class="page-content page-container" id="page-content">

    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-4 grid-margin stretch-card">
            <?php
$sql = "SELECT * FROM faculty";
$i =0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) 
  $row = $i++;{
   
?>
    <div class="card">
     
      <div class="card-body">
        <h4 class="card-title">  </h4>
        <p class="card-description"></p>
        <div class="template-demo">
          <table class="table mb-0">
            <thead>
              <tr>
                <th class="pl-0">No of FACULTY</th>
                <th class="text-right"><?php echo $i; ?></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<?php
}
}
?>


            </div>
        </div>
    </div>
</div>

</div>
<div class="boy">
<div class="page-content page-container" id="page-content">

    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-4 grid-margin stretch-card">
            <?php
$sql = "SELECT * FROM project";
$j =0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) 
  $row = $j++;{
   

}
}
?>
 <div class="card">
     
     <div class="card-body">
       <h4 class="card-title"></h4>
       <p class="card-description"></p>
       <div class="template-demo">
         <table class="table mb-0">
           <thead>
             <tr>
               <th class="pl-0">No of PROJECTS</th>
               <th class="text-right"><?php echo $j; ?></th>
             </tr>
           </thead>
           <tbody>
           </tbody>
         </table>
       </div>
     </div>
   </div>


            </div>
        </div>
    </div>
</div>

      <div>  
 <?php
    } elseif ($role=="Faculty") {
      header("location:FACULTY/index.php");
    } 
    else{
      header("location:STUDENT/index.php");
    }
    ?>