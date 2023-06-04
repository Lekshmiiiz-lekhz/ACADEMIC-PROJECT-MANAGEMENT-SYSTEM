<?php
include 'connection.php';
    if(isset($_POST['add']))
    {
        if($_POST['stpass']==$_POST['cstpass'])
        {
            $id=$_POST['id']; 
            $name=$_POST['stname'];
            $email=$_POST['stemail'];
            $phone=$_POST['stphone'];
            $pass=$_POST['stpass']; 
            $year=$_POST['styear'];
            $stream=$_POST['stream'];
          if (!empty($id)|| !empty($name)||!empty($email)||!empty($phone)||!empty($pass)||!empty($year)||$stream!="Select")
            {
               
             $sql= "INSERT INTO `pmas`.`student` (`s_id`, `name`, `email`, `phone`, `password`, `year`, `stream`) VALUES ('$id', '$name', '$email', '$phone', '$pass', '$year', '$stream');";
                 mysqli_query($conn, $sql);
                 $conn->close();
                 header('Location:index.php');  
            }
         else
             
         {
               echo 'Please fill up all fields';
               header('Location:reistration.php');
         }   
        }
        else{
          echo '<script type="text/javascript">alert("Password Miss match")</script>';
        }
           
              
    }

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
  <a class="navbar-brand"href="#">                   Registration Gains you acess to our premium gudes who would guide you to your goals.</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<div class="boy">
  <form form action="" method="post">
    <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="id"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Must be unique" onkeyup="if (/[^|a-z0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|a-z0-9]+/g,'')" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" id="in" name="stname"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Name" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" id="in" name="stemail"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="number" id="in" name="stphone"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="[789][0-9]{9}" placeholder="Enter valid Indian phone no" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="styear" class="form-control">
        <option value="1">1st year</option>
        <option value="2">2nd year</option>
        <option value="3">3rd year</option> 
        <option value="4">4th year</option>          
        </select>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="password" id="in" name="stpass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Conform Password</label>
    <input type="password" id="in" name="cstpass"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Conform Password" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">STREAM</label>
    <select name="stream" class="form-control">
        <option value="CSE">CSE</option>
        <option value="MCA">MCA</option>
        <option value="BCA">BCA</option> 
        <option value="BSC">BSC</option>          
        </select>
    </div>
    <input value="submit"  type="submit"  name="add" id="bt"class="btn btn-primary">
    </form>
</div>
</div>
</body>
</html>