<?php

include ("resources/includes/config.php");
include ("resources/func/blogfunctions.php");
$clas = new Myblog(); 
 $msg="";
if(isset($_POST['username']) && isset($_POST['password'])){
  $username=htmlentities(trim($_POST['username']));
  $password=htmlentities(trim($_POST['password']));
  if(!empty($username) && !empty($password)){
   $user=$clas->check_password($username,$password);
 if($username==$user){
  session_start();
  $_SESSION['username']=$username;
  header("location:Admin/admin.php");
 }else{
  $GLOBALS['msg']="<div class='alert alert-danger'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Wrong username or password</strong>
</div>";
  }
 } else
  {
    $GLOBALS['msg']="<div class='alert alert-danger'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Please fill in all fields</strong>
</div>";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Mcbaze | LoginPage</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, maximum-scale=1">
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <link rel="stylesheet" type="text/css" href="css/blog.css">
  <link href="images\mcb.jpg" rel="icon"/>
  
  <style type="text/css">
    body{
      background: url('images/background.png');
    }
  </style>
  
</head>
<body>
  
   <div class="col-md-6 col-md-offset-3" style="margin-top:20px">
<section class="panel panel-danger" style="margin-top:50px ">
<div class="panel-heading">
<div class="panel-title text-center" >staff Login</div>
</div>
<div class="panel-body"> 
<?php
echo $GLOBALS['msg'];
?>
<form class="form" method="post">
<div class="form-group"> 
  <label>Username:</label>
<input type="text" class="form-control input-md" placeholder="username" name="username">
</div>
<div class="form-group"> 
  <label>Password:</label>
<input type="password" class="form-control input-md" placeholder="password" name="password">
</div>
<div class="form-group col-md-4 col-md-offset-4" style="padding-left: 60px"> 
<input type="submit" class="input-md btn btn-danger" value="Login" name="submit" style="color:#fff">
</div>
</form>
</section> 
</div>
<footer class="col-md-12 container-fluid navbar-inverse " style="margin-top: 194px">
  <div class="col-md-6 text-center">
  <p style="font-size: 15px;color:white;padding-top: 17px">Copyright &copy <span style="color:red;">McWorld</span> Blog-2018. All right reserved.</p>
</div>
  
</footer>
</body>

</html>