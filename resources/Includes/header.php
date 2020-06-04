<?php

include ("resources/includes/config.php");
include ("resources/func/blogfunctions.php");
$clas = new Myblog(); 
$ip_add=$_SERVER['REMOTE_ADDR'] ;
if($clas->ip_exist($ip_add)==true){
$clas->insert_ip($ip_add);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>McWorld blog</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=0.1">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/blog.css">
  <link href="images\mcb.jpg" rel="icon"/>
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
<span style="color:red;font-size: 20px;font-weight:bold;color:white;position: absolute;right: 20px;top: 70px" data-toggle="modal" data-target="#myContact">Contact Us</span>


<!-- Modal -->
<div id="myContact" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Us</h4>
      </div>
      <div class="modal-body">
        <p>McWorld blog...</p>
        <p>Phone number: 07065284978, 08138700447</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
		<div >

			<h1 style="color:red;font-size: 70px;font-weight:900;font-style: italic;text-shadow: 2px 2px 5px white;">McWorld</h1>
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