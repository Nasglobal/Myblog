<?php

include ("resources/includes/config.php");
include ("resources/func/blogfunctions.php");
$clas = new Myblog(); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=0.1">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/blog.css">
  <script type="text/javascript">
    function load_comment(thediv,thefile) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(thediv).innerHTML = xmlhttp.responseText;
            }
        };
        parameters ="name=" + document.getElementById('names').value + "&comment=" + document.getElementById('comments').value + '&post_id='+<?php echo $_GET['single']?>;
        xmlhttp.open("POST", thefile, true);
        xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xmlhttp.send(parameters);
}
function load_commentmusic(thediv,thefile) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(thediv).innerHTML = xmlhttp.responseText;
            }
        };
        parameters ="name=" + document.getElementById('names').value + "&comment=" + document.getElementById('comments').value + '&post_id='+<?php echo $_GET['msn']?>;
        xmlhttp.open("POST", thefile, true);
        xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xmlhttp.send(parameters);
}
function load1(thediv,thefile) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(thediv).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", thefile, true);
        xmlhttp.send();
}

  </script>
  <style type="text/css">
    body{
      background: url('images/background.png');
    }
    a:hover{
      text-decoration: none;
    }
    
   #myNavbar ul li a{
      color: white;
    }
    #myNavbar ul li a:hover{
      color:red;
    }

  </style>
	
</head>
<body >
	
	<div class="container col-md-10 col-md-offset-1  text-center">

		<div >
			<h1 style="color:red;font-size: 70px;font-weight:900;font-style: italic;text-shadow: 2px 2px 5px white;">Nasglobal</h1>
      <p style="font-size:20px;color:red;font-style: italic;background: grey">Experience the Thrill......</p>
		</div>
		<nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav ">
        <?php
        foreach($clas->view_categories() as $nav){
    if(isset($_GET['category']) && $nav->id==$_GET['category']){
        ?>
        <li class="active"><a style="color: red" href="index.php?category=<?php echo $clas->escape($nav->id)?>"><?php echo $clas->escape($nav->name)?></a></li>
        <?php
      }else{
        echo "<li><a href='index.php?category=$nav->id'>$nav->name</a></li>";
      }
    }
        ?>
       <li><a href="musicpage.php">Music</a></li> 
      </ul> 
    </div>
     <div class="navbar-nav navbar-right col-md-3" >
      
      <form action="index.php" method="GET">
      <div class="form-group input-group ">
    <input type="text" class="form-control "  name="search" placeholder="Search..." required>
    <span class="input-group-btn" ><button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i></button></span>
  </div>
  </form>
</div>
  </div>
</nav>
</div>