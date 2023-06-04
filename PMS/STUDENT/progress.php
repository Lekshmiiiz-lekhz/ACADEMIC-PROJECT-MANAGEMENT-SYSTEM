<?php
function badger($values) {
  $count = $values;

      if ($count <= 4) {
          $colorClass = 'badge-outline-danger';
      } elseif ($count<= 7) {
          $colorClass = 'badge-outline-warning';
      } else {
        $colorClass = 'badge-outline-success';
      }
     
      $table = '<td class="pr-0 text-right"><div class="badge badge-pill ' . $colorClass . '">' . $count . '</div></td>';
      return $table;
    }


?>
<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
if(empty($_SESSION['Email']))
{
header("location:../index.php");
}
include "connect.php";
include '../connection.php';
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
  

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

 .stretch-card {
     display: -webkit-flex;
     display: flex;
     -webkit-align-items: stretch;
     align-items: stretch;
     -webkit-justify-content: stretch;
     justify-content: stretch
 }

 .grid-margin {
     margin-bottom: 1.875rem
 }

 .card {
     position: relative;
     display: flex;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid #d2d2dc;
     border-radius: 0
 }

 .card .card-body {
     padding: 1.25rem 1.75rem
 }

 .card-body {
     flex: 1 1 auto;
     padding: 1.25rem
 }

 .card .card-title {
     color: #000000;
     margin-bottom: 0.625rem;
     text-transform: capitalize;
     font-size: 0.875rem;
     font-weight: 500
 }

 .card .card-description {
     margin-bottom: .875rem;
     font-weight: 400;
     color: #76838f
 }

 p {
     font-size: 0.875rem;
     margin-bottom: .5rem;
     line-height: 1.5rem
 }

 .table thead th,
 .jsgrid .jsgrid-table thead th {
     border-top: 0;
     border-bottom-width: 1px;
     font-weight: 500;
     font-size: .875rem;
     text-transform: uppercase
 }

 .table td,
 .jsgrid .jsgrid-table td {
     font-size: 0.875rem;
     padding: .875rem 0.9375rem
 }

 .badge {
     border-radius: 0;
     font-size: 12px;
     line-height: 1;
     padding: .375rem .5625rem;
     font-weight: normal
 }
 
 .badge-outline-primary {
    color: #405189;
    border: 1px solid #405189;
}

.badge.badge-pill {
    border-radius: 10rem;
}

.badge-outline-info {
    color: #3da5f4;
    border: 1px solid #3da5f4;
}

.badge-outline-danger {
    color: #f1536e;
    border: 1px solid #f1536e;
}

.badge-outline-success {
    color: #00c689;
    border: 1px solid #00c689;
}

.badge-outline-warning {
    color: #fda006;
    border: 1px solid #fda006;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
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
<div class="page-content page-container" id="page-content">

    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-4 grid-margin stretch-card">
            <?php
$sql = "SELECT * FROM project WHERE s_id='$user'";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $p_id = $row['id'];
    $sql2 = "SELECT * FROM tasks WHERE p_id = $p_id";
    $res = $connection->query($sql2);
?>
    <div class="card">
      <form action="zip_up.php" method="POST">
        <input name="p_id" type="hidden" value="<?php echo $p_id;?>">
        <input class="btn btn-outline-danger" type="submit" value="SORCE CODE UPLOAD">
      </form>
      <div class="card-body">
        <h4 class="card-title"><?php echo $row['name']; ?></h4>
        <p class="card-description">View abstract: <a href="<?php echo $row['abstract'];?>">click</a></p>
        <div class="template-demo">
          <table class="table mb-0">
            <thead>
              <tr>
                <th class="pl-0">Task</th>
                <th class="text-right">Score</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // output data of each row
              if ($res->num_rows > 0) {
                while ($row1 = $res->fetch_assoc()) {
              ?>
                  <tr>
                    <td class="pl-0"><?php echo $row1['t_name']; ?></td>
                    <?php echo badger($row1['mark_percentage']); ?>
                  </tr>
              <?php
                }
              } else {
              ?>
                <tr>
                  <td colspan="2" class="pl-0 text-center">No tasks found.</td>
                </tr>
              <?php
              }
              ?>
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
</div>
</body>
</html>