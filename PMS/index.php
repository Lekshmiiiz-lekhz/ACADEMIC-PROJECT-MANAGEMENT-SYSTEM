<?php
session_start();
if(empty($_SESSION['email']))
{
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
	body{
    background-color:#b6d3ff;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.card{
    background-color:#fff;
    border:none;
    height:500px;
    width: 1000px;
    overflow:hidden;
}

.input-field{
    position:relative;
    margin-top:5px;
}

.input-field input{
    height:50px;
    outline:none !important;
    border:2px solid #eee;
   
}

.input-field input:focus{
    box-shadow:none;
    outline:none !important;
}

.input-field label{
    position:absolute;
    top:10px;
    left:6px;
    transition:all 0.5s;
    background-color:#fff;
    padding:0px 10px;
    border-radius:20px;
    
     
}

.input-field input:focus+label,
.input-field input:valid+label
{
    position:absolute;
    top:-10px;
    left:6px;
    font-size:13px;
  
}


.signup-button{
    height:50px;
    font-size:19px;
    text-transform:uppercase;
}

.right-side{
    
    position:relative;
    
}


.right-side-content{
    background-color:#0056fb;
    height:500px;
    width:100%;
    padding:10px;
    position:relative;
}


.right-side-content .content{
    position:absolute;
    top:50%;
    left:0%;
    padding:0px 40px;
}

.right-side span:nth-child(1){
    height:120px;
    width:75px;
    background-color:#ffb91d;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    left:-20px;
}

.right-side span:nth-child(2){
    height:50px;
    width:40px;
    background-color:#ffb91d;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    left:60px;
    top:20px;
}

.right-side span:nth-child(3){
    height:50px;
    width:40px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    right:20px;
    top:-20px;
}

.right-side span:nth-child(4){
    height:140px;
    width:100px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    right:40px;
    top:70px;
}

.right-side span:nth-child(5){
    height:140px;
    width:100px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    right:30px;
    top:60px;
    object-fit:cover;
    overflow:hidden;
}

.right-side span:nth-child(6){
    height:140px;
    width:100px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    top:400px;
    overflow:hidden;
}

.right-side span:nth-child(7){
    height:60px;
    width:40px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    top:400px;
    right:10px;
    overflow:hidden;
}

.right-side span:nth-child(8){
    height:100px;
    width:70px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    top:440px;
    right:40px;
    overflow:hidden;
}


.right-side span:nth-child(9){
    height:70px;
    width:40px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    top:350px;
    right:90px;
    overflow:hidden;
    transition:all 0.5s;
    transition-delay:1s;
}


.right-side span:nth-child(10){
    height:50px;
    width:100px;
    background-color:#3949AB;
    border-radius:2px;
    display:flex;
    transform: skew(20deg);
    position:absolute;
    left:20px;
    top:340px;
    object-fit:cover;
    overflow:hidden;
    transition:all 0.5s;
    
}

.card:hover .right-side span:nth-child(10){
    left:20px;
    top:330px;
}

.card:hover .right-side span:nth-child(9){
    top:340px;
    right:90px;
}


.content{
    display:flex;
    color:#fff;
    justify-content:center;
    align-items:center;
}

.content h6{
    text-align:left;
}

.content span{
    font-size:12px;
}
</style>
<title>Project Management System</title>
</head>
<div>
<body>
<div class="container"> 
  <div class="card"> 
    <div class="row g-0"> 
      <div class="col-md-6">
         <div class="h-100 d-flex justify-content-center align-items-center"> 
          <div class="py-4 px-3"> 
            <h4>Login</h4>
            <form name="login" action="chk.php" method="post">
             <div class="row g-2 mt-1">
             <div class="col-md-12"> 
                      <div class="input-field"> 
                        <input class="form-control" name="id" required> 
                        <label for="input3">Username</label> 
                      </div>
                     </div>
                 </div>
                  <div class="row mt-2"> 
                    <div class="col-md-12"> 
                      <div class="input-field"> 
                        <input class="form-control" type="password" name="pass" required> 
                        <label for="input3">Password</label> 
                      </div>
                     </div>
                     </div>
                      <div class="row mt-2 mb-2">
                         <div class="col-md-12">
                         <select name="role" class="form-control">
                         <option class="form-control"value="Student">STUDENT</option>
                          <option class="form-control"value="Faculty">FACULTY</option>
                          <option class="form-control" value="Admin">ADMIN⚠️</option>          
                           </select>
                          </div> 
                        </div>
                        <div class="row mt-2 mb-2">
                         <div class="col-md-12">      
                         <input  type="submit" class="btn btn-outline-success btn-lg" name="register" value="Submit" />
                         <a href="registration.php">Register</a> as a student...?
                        </div> 
                        </div>
                        
                        </div>
                       </div>
                       </div> 
                       <div class="col-md-6">
                         <div class="right-side-content">
                           <div class="content d-flex flex-column">
                             <h6>Welcome</h6> 
                             <span>Welcome to project management system<p>by:- Lekshmi</p></span>
                             </div> 
                             <div class="right-side">
                               <span>
                               </span>
                                <span>

                                </span> 
                                <span>


                                </span> 
                                <span>

                                </span> 
                                <span>
                                  <img src="https://i.imgur.com/kWmyZvb.jpg">
                                 </span> <span></span> <span></span> <span></span> <span>
                                   <img src="https://i.imgur.com/U0863iD.jpg"> </span> <span></span>
                                   </div> 
                                  </div>
                                 </div> 
                                </div>
                               </div>
                                <div class="parallelogram">
                                   <span>

                                   </span> 
                                   <span>

                                   </span>
                                    <span>

                                    </span> 
                                  </div>
</form>
</div>
<!-- <form name="login" action="chk.php" method="post">
                    
    <table width="100%"  cellspacing="02" cellpadding="05">
         <tr>
      <th colspan="2" scope="col"><font size="6">LOGIN</font></th>
    </tr>
    <tr>
      <td align="right"><font size="5">ID&nbsp;:&nbsp;</font></td>
    <td><input style="height: 20px; font-size: 15px;" type="text" name="id"/><br/>
    </td>
  </tr>
  <tr>
      <td align="right"><font size="5">Password&nbsp;:&nbsp;</font></td>
    <td><input style="height: 20px; font-size: 15px;" type="password" name="pass" /></td>
  </tr>
  <tr>
      <td align="right"><font size="5">Login_As&nbsp;:&nbsp;</font></td>
    <td>
        <select name="role" style="width: 13em; height: 2em; font-size: 15px;">
        <option value="Student">Student</option>
        <option value="Faculty">Faculty</option>
        <option value="Admin">Admin</option>          
        </select>
      </td>
  </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" style="width: 4em;  height: 2em; font-size: 20px;" name="register" value="Submit" /></td>
            </tr>
 </table> 

        <br/>
        &nbsp;
        </form> -->
</body>
</div>
    
</html>

<?php
}
else
{
header("location:Admin.php");
}

?>