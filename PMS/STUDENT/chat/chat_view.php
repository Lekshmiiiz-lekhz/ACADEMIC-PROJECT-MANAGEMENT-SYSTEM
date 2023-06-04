<?php
session_start();
$user =  $_SESSION['Email'];
$role = $_SESSION['Role'];
if(!empty($_POST["reciver"]))
{
    $_SESSION['reciver'] = $_POST['reciver'];
}
$reciver = $_SESSION['reciver'];
include "../connect.php";
include '../../connection.php';
if(empty($_SESSION['Email']))
{
header("location:index.php");
}
function timeAgo($time_ago) {
    $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
    $time  = time() - $time_ago;

switch($time):
// seconds
case $time <= 60;
return 'just now';
// minutes
case $time >= 60 && $time < 3600;
return (round($time/60) == 1) ? 'a minute' : round($time/60).' minutes ago';
// hours
case $time >= 3600 && $time < 86400;
return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago';
// days
case $time >= 86400 && $time < 604800;
return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' day ago';
// weeks
case $time >= 604800 && $time < 2600640;
return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
// months
case $time >= 2600640 && $time < 31207680;
return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
// years
case $time >= 31207680;
return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ;

endswitch;
}
$myAudioFile = "sent.mp3";
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
body{
    background-color: #f4f7f6;
    margin-top:20px;
}
.card {
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.chat-app .people-list {
    width: 280px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
    margin-left: 280px;
    border-left: 1px solid #eaeaea
}

.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}

.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px
}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}

@media only screen and (max-width: 767px) {
    .chat-app .people-list {
        height: 465px;
        width: 100%;
        overflow-x: auto;
        background: #fff;
        left: -400px;
        display: none
    }
    .chat-app .people-list.open {
        left: 0
    }
    .chat-app .chat {
        margin: 0
    }
    .chat-app .chat .chat-header {
        border-radius: 0.55rem 0.55rem 0 0
    }
    .chat-app .chat-history {
        height: 300px;
        overflow-x: auto
    }
}

@media only screen and (min-width: 768px) and (max-width: 992px) {
    .chat-app .chat-list {
        height: 650px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: 600px;
        overflow-x: auto
    }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
    .chat-app .chat-list {
        height: 480px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: calc(100vh - 350px);
        overflow-x: auto
    }
}
</style>
    </script>
</head>
<body>
<audio src="sent.mp3" autoplay="autoplay" ></audio>
<div class="container">
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card chat-app">
            <div id="plist" class="people-list">
                <div class="input-group">
                    <a href="../chat.php"> <button  type="button" class="btn btn-outline-danger">Back</button></a>
                </div>
                <ul class="list-unstyled chat-list mt-2 mb-0">
                  
                    <li class="clearfix active">
                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                        <div class="about">
                            <div class="name"><?php echo $reciver;?></div>
                            <div class="status"> <i class="fa fa-circle online"></i> online </div>
                        </div>
                    </li>
                    <!-- limit by max5  -->
                </ul>
            </div>
            <div class="chat">
                <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0"><?php echo $reciver;?></h6>
                                <small></small>
                            </div>
                        </div>
                        <div class="col-lg-6 hidden-sm text-right">
                            <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                        </div>
                    </div>
                </div>
                <div class="chat-history">
                <?php
                $sql = "SELECT * FROM chat WHERE name='$user' AND reciver='$reciver' OR name='$reciver' AND reciver='$user'";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                 ?>
                    <div class="container">
                    <ul class="m-b-0">
                        <?php
                        $name = $row["name"];
                        if($user== $name)
                        {
                            ?>

                       <li class="clearfix">
                            <div class="message other-message float-right"><?php echo $row["message"];?></div>
                            <span class="message-data-time float-right"><?php echo timeAgo($row["created_on"]);;?></span>
                        </li>
                    <?php
                        }
                       else
                        {
                            ?>
                            <li class="clearfix">
                            <div class="message other-message float-left"><?php echo $row["message"];?></div>
                            <span class="message-data-time float-left"><?php echo timeAgo($row["created_on"]);;?></span>
                            </li>  
                            <?php
                        }?>
                    
                     </div>
                     <?php
                }}
                    else 
                    {       
                    ?>  
                         <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">SEND MESSAGE</span>
                            </div>
                            <div class="message my-message">NO CHAT AVAILABLE?</div>                                    
                        </li>
                   <?php
                    }
                    ?> 
                    </ul> 



                </div>
                <div class="chat-message clearfix">
                <form action="sendMessage.php" method="post">
                    <input type="hidden" value="<?php echo $reciver;?>" name="reciver">
                        <input name="msg" type="text" class="form-control" placeholder="Enter text here...">     
                        <input type="submit" value="Send"class="btn btn-success">         
                        </form>
                                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>


