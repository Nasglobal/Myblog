<?php

include ("resources/includes/config.php");
include ("resources/func/blogfunctions.php");
$clas = new Myblog(); 
$ip_add=$_SERVER['REMOTE_ADDR'] ;
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


  </script>
  <style type="text/css">
    body{
      background: url('images/back.gif');
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
    .jumbotron{
      background: #5f7682;
      color:red;
      font-weight:bold;
      margin-top: -8px;
      
    }

  </style>
	
</head>
<body >
  <p class="tex-center" style="font-size:20px;font-weight:900;color:red;font-style: italic;background: black;text-shadow: 2px 2px 5px white;"><marquee>WELCOME TO BSU VOTING POOL....... VOTE WISELY &nbsp; &nbsp; &nbsp; &nbsp; WELCOME TO BSU VOTING POOL....... VOTE WISELY</marquee></p>
  <div class="container fluid">
    <div class="jumbotron">
      <div class="row">
      <div class="col-md-4">
        <img src="images/logo1.png" width="100px" height="100px">
      </div>
      <div class="col-md-8">
    <h2 style="color:red;font-size: 30px;font-weight:900;font-style: italic;text-shadow: 2px 2px 5px white;">MR AND MISS FRESHERS</h2> 
  </div>
</div>
  </div>
  <div class="row text-center" style="background: white;margin:-15px 0px 5px 0px;border-radius: 5px"> 
  <div class="bg-primary"><li class="list-group-item"><a> Select a candidate and click on vote button below to vote. NOTE: only one candidate can be voted per day for each category(mr and miss)</a></li></div> 
  <div class="col-md-10 col-md-offset-1">
  <h3 class="text-danger"><i><u>MR FRESHERS</u></i></h3>
  <br>
  <script type="text/javascript">
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
  <?php
  $view_posts=$clas->view_candidate(1);
   foreach ($view_posts as $Posts) {
    
?>
  <div class="row"><div class="col-md-3"><img src="imageloader.php?cand=<?php echo $clas->escape($Posts->id); ?>" class="img-circle img-responsive" alt="Cinque Terre" width="200" height="200"></div>
  <div class="col-md-3 " style="margin: 30px 0px 0px 0px;">
  <p><b>Contestant number:</b> <?php echo $clas->escape($Posts->candidatenum); ?></p>
  <p><b>Name:</b><?php echo $clas->escape($Posts->cname); ?></p>
  <p><b>Department:</b><?php echo $clas->escape($Posts->department); ?></p>
</div>

    <div class="col-md-2">
      <p><b>Number of votes:</b></p>
    <div class="text-danger" id="cont<?php echo $clas->escape($Posts->id); ?>"><b><?php echo $clas->escape($Posts->numvote); ?></b>
    <!-- <div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    </div>
  </div> -->
    <br>
    <br>
      <?php
    $votedtim=strtotime($clas->check_votetime($ip_add,$ip2=null));
   if(($clas->check_ip($ip_add,$ip2=null)==true || $clas->check_ip($ip_add,$ip2=null)==false) && date('Y:m:d',$votedtim)==date('Y:m:d')){
    ?>
      <input type="button" name="" value="you cannot vote again today">
      <?php
    }else{
      ?>
      <input type="button" name="" onclick="load1('cont<?php echo $clas->escape($Posts->id); ?>','crudepage.php?votemr=<?php echo $clas->escape($Posts->id).'/'.$ip_add; ?>')" class="btn btn-danger" value="click to vote">
      <?php
    }
    ?>
  </div>
  </div>
</div>
  <hr style=" border: 0.3px solid grey;"> 
  <?php } ?>
<br>
  <h3 class="text-danger"><i><u>MISS FRESHERS</u></i></h3>
  <br>
  <?php
  $view_posts=$clas->view_candidate(2);
   foreach ($view_posts as $Posts) {
?>
  <div class="row"><div class="col-md-3"><img src="imageloader.php?cand=<?php echo $clas->escape($Posts->id); ?>" class="img-circle img-responsive" alt="Cinque Terre" width="200" height="200"></div>
  <div class="col-md-3 " style="margin: 30px 0px 0px 0px;">
  <p><b>Contestant number:</b> <?php echo $clas->escape($Posts->candidatenum); ?></p>
  <p><b>Name:</b><?php echo $clas->escape($Posts->cname); ?></p>
  <p><b>Department:</b><?php echo $clas->escape($Posts->department); ?></p>
</div>

    <div class="col-md-2">
      <p><b>Number of votes:</b></p>
    <div class="text-danger" id="cont1<?php echo $clas->escape($Posts->id); ?>" ><b><?php echo $clas->escape($Posts->numvote); ?></b>
    <br>
    <br>
    <?php
    $votedtim1=strtotime($clas->check_votetime($ip2=null,$ip_add));
   if(($clas->check_ip($ip2=null,$ip_add)==true || $clas->check_ip($ip2=null,$ip_add)==false) && date('Y:m:d',$votedtim1)==date('Y:m:d')){
    ?>
      <input type="button" name="" value="you cannot vote again today">
      <?php
    }else{
      ?>
      <input type="button" name="" onclick="load1('cont1<?php echo $clas->escape($Posts->id); ?>','crudepage.php?votemiss=<?php echo $clas->escape($Posts->id).'/'.$ip_add; ?>')" class="btn btn-danger" value="click to vote">
      <?php
    }
    ?>
  </div>
  </div>
</div>
  <hr style=" border: 0.3px solid grey"> 
  <?php } ?>
    </div>
    </div>
  </div>

<?php 

include ("resources/includes/footer.php");
?>