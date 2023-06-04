
<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
$_SESSION['p_id'] = $_POST['p_id'];
if(empty($_SESSION['Email']))
{
header("location:../index.php");
}
include "connect.php";
include '../connection.php';
if(isset($_POST['submit'])) {
    // specify the target directory to store the uploaded file
    $target_dir = "../STUDENT/zip/";
    // get the filename of the uploaded file
    $filename = basename($_FILES["fileToUpload"]["name"]);
    // set the target path of the uploaded file
    $target_file = $target_dir . $filename;
    // get the file extension of the uploaded file
    $file_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // check if the file is a zip file
    if($file_extension != "zip") {
        echo "Only ZIP files are allowed.";
    } else {
        // check if the file already exists in the target directory
        if (file_exists($target_file)) {
            // show a JavaScript alert to confirm replacing the existing file
            echo '<script type="text/javascript">if(confirm("File already exists. Do you want to update and replace the file?")){ document.forms[0].submit(); }</script>';
        } else {
            // attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars($filename). " has been uploaded.";
                
                // store p_id as a variable
               
                $p_id = $_GET['p_id'];
             
                
                // update the project table in the database
                $location_and_name = $target_dir . $filename;
                $sql = "UPDATE project SET doc='$location_and_name' WHERE id=$p_id";
                if(mysqli_query($conn, $sql)) {
                    echo "The database has been updated.";
                    header("location:progress.php");
                } else {
                    echo "Error updating the database: " . mysqli_error($conn);
                }
                mysqli_close($conn);
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
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
  max-width: 40%;
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
<audio src="noti.mp3" autoplay="autoplay" ></audio>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item  active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="project.php">Project</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="notification.php">Notification</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="progress.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Progress</button>
    </form>
  </div>
</nav>
<div class="boy">
<form action="zip_up.php?p_id=<?php echo $_POST['p_id']; ?>" method="post" enctype="multipart/form-data">
    <input class ="btn btn-outline-primary" type="file" name="fileToUpload">
    <input class ="btn btn-outline-warning" type="submit" value="Upload File" name="submit">
</form>
try using project name for the zip, The default maximum size of POST data is set to 8MB in PHP.

<form method="post" action="download_zip.php">
  <input type="hidden" name="p_id" value="<?php $_POST['p_id']; ?>">
  <button class ="btn btn-outline-success" type="submit" name="download_zip">Download Sorce Code</button>
</form>
</div>
</div>
</div>
</div>
</body>
</html>