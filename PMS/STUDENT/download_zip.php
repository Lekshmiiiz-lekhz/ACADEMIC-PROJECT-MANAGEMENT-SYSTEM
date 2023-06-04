<?php

$connection = mysqli_connect('localhost', 'root', '', 'pmas');
if(!$connection){
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// get the p_id value from the form submission
$p_id = $_POST['p_id'];

// retrieve the ZIP file location from the database using the p_id value
$sql = "SELECT doc FROM project WHERE id = '$p_id'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$zip_file = $row['doc'];

// download the ZIP file
header("Content-type: application/zip");
header("Content-Disposition: attachment; filename=".basename($zip_file));
header("Content-length: ".filesize($zip_file));
readfile($zip_file);
header("location:progress.php");
?>
