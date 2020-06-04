
<?php
error_reporting(0);
include ("resources/includes/header.php");
?>
<div class="container col-md-10 col-md-offset-1 text-center " style="background: white;height:auto;margin-bottom: 10px;">
  
 <?php
if(isset($_GET['category'])){
  $view_posts=$clas->view_posts($_GET['category']);
   //$clas->view_posts();
?>
<div class="col-md-8" style="margin:10px 0px 10px 0px;border: 0.5px solid lightgrey">
   <div class="row">
    <?php
    foreach ($view_posts as $Posts) {
    ?>
    <div class="col-md-6">
      <h4 ><strong><a class="text-danger" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h4>
    <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="290" height="200">
      <p style="text-align:justify;"><?php echo $clas->escape(substr($Posts->contents,0,105)); ?><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>" class="text-danger"><b>Continue reading....</b></a></p>&nbsp;&nbsp;<span style="color:skyblue;font-size:11px;font-weight:bold;">Posted at :&nbsp;<?php echo $clas->escape($Posts->date_posted); ?>&nbsp;</span>&nbsp;<a >Comments <span class="badge"><?php echo $clas->total_comments($clas->escape($Posts->posts_id))?></span></a>
      <hr style=" border: 0.3px solid red"> 
    </div>
     <?php } ?>
   </div>
   <br>
   <br>
   <div class="row" style="margin:20px 0px 0px 0px;border: 1px solid grey">
  <section class="panel">
  <div class="panel-heading " style="background: black;color: #fff" >
      <b><i class="panel-title">Latest News</i></b>
    </div>
  <div class="panel-body">
 <div class="row" style="margin-top: 15px">
  <?php
   $view_posts=$clas->view_by_pagination(0,12);
   foreach ($view_posts as $Posts) {
  ?>

<div class="col-md-4 ">
      <div class="" style="background:#f0f5f5;padding:5px 0px 5px 0px">
   <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="170" height="100">
   <h5 class="text-danger"><strong><a class="text-danger" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
  <p style="font-size:13px;" ><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>" style="color:black"><?php echo $clas->escape(substr($Posts->contents,0,46)); ?></a>...</p>
   <h6 class="text-primary">posted: <span class="glyphicon glyphicon-time"></span> <?php echo $clas->date_posted(date("h:i:sa M d Y",strtotime($Posts->date_posted))); ?></h6> 
</div>
<br>
 </div>

<?php
}
?>
</div>
</div>
</section>
</div>
   <ul class="pager">
  <li class="next"><a href="index.php?currentpage=1">More Posts..</a></li> 
</ul>  
</div>

<?php
 }
else if(isset($_GET['search'])){
  $search=$_GET['search']; 
   
?>
<div class="col-md-8" style="margin:10px 0px 10px 0px;border: 0.5px solid lightgrey">
   <div class="row">
    <?php
    if(strlen($search)>5){
  $view_posts=$clas->view_by_search($search);
    foreach ($view_posts as $Posts) {
    ?>
    <div class="col-md-6">
      <h4 ><strong><a class="text-danger" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h4>
    <img src="imageloader.php?im=<?php echo $clas->escape($Posts->id); ?>"  alt="Cinque Terre" width="290" height="200">
      <p style="text-align:justify;"><?php echo $clas->escape(substr($Posts->contents,0,105)); ?><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->id); ?>" class="text-danger"><b>Continue reading....</b></a></p>&nbsp;&nbsp;<span style="color:skyblue;font-size:11px;font-weight:bold;">Posted at :&nbsp;<?php echo $clas->escape($Posts->date_posted); ?>&nbsp;</span>&nbsp;<a href="#">Comments <span class="badge"><?php echo $clas->total_comments($clas->escape($Posts->id))?></span></a>
      <hr style=" border: 0.3px solid red"> 
    </div>
    <?php }
     
  $view_music=$clas->viewmusic_by_search($search);
    foreach ($view_music as $Posts) {
    ?>
    <div class="col-md-6">
      <div class="" style="background:#f0f5f5;padding:5px 0px 5px 0px">
   <img src="imageloader.php?sn=<?php echo $clas->escape($Posts->id); ?>"  alt="Cinque Terre" width="170" height="100">
   <h5 class="text-danger"><strong><a class="text-danger" href="singlemusic.php?msn=<?php echo $clas->escape($Posts->id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
   <p style="font-size:13px;" ><a target="blank" href="singlemusic.php?msn=<?php echo $clas->escape($Posts->id); ?>" style="color:black"><?php echo $clas->escape(substr($Posts->content,0,46)); ?></a>...</p>
   <div class="row">
     <div ><a href="singlemusic.php?msn=<?php echo $clas->escape($Posts->id); ?>" class="btn btn-danger btn-sm">Click to Download</a></div>
   </div>
</div>
<br>
 </div>
     <?php }
   }else{
    echo "<div class='alert alert-danger'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Sorry the inputed word is too short</strong>
</div>";
     } ?>  
   </div>
   <br>
   <br>
   <div class="row" style="margin:20px 0px 0px 0px;border: 1px solid grey">
  <section class="panel">
  <div class="panel-heading " style="background: black;color: #fff" >
      <b><i class="panel-title">Latest News</i></b>
    </div>
  <div class="panel-body">
 <div class="row" style="margin-top: 15px">
  <?php
   $view_posts=$clas->view_by_pagination(0,12);
   foreach ($view_posts as $Posts) {
  ?>

<div class="col-md-4 ">
      <div class="" style="background:#f0f5f5;padding:5px 0px 5px 0px">
   <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="170" height="100">
   <h5 class="text-danger"><strong><a class="text-danger" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
  <p style="font-size:13px;" ><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>" style="color:black"><?php echo $clas->escape(substr($Posts->contents,0,46)); ?></a>...</p>
   <h6 class="text-primary">posted: <span class="glyphicon glyphicon-time"></span> <?php echo $clas->date_posted(date("h:i:sa M d Y",strtotime($Posts->date_posted))); ?></h6> 
</div>
<br>
 </div>

<?php
}
?>
</div>
</div>
</section>
</div>
   <ul class="pager">
  <li class="next"><a href="index.php?currentpage=1">More Posts..</a></li> 
</ul>  
</div>

 <?php }
 else if(!isset($_GET['category']) && !isset($_GET['currentpage']) && !isset($_GET['search'])){
 $view_posts=$clas->view_posts(); ?>
 <div class="col-md-8" style="margin:10px 0px 10px 0px;border: 0.5px solid lightgrey">
   <div class="row">
    <?php
    foreach ($view_posts as $Posts) {
    ?>
    <div class="col-md-6">
      <h4 ><strong><a class="text-danger" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h4>
    <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="290" height="200">
      <p style="text-align:justify;"><?php echo $clas->escape(substr($Posts->contents,0,105)); ?><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>" class="text-danger"><b>Continue reading....</b></a></p>&nbsp;&nbsp;<span style="color:skyblue;font-size:11px;font-weight:bold;">Posted at :&nbsp;<?php echo $clas->escape($Posts->date_posted); ?>&nbsp;</span>&nbsp;<a href="#">Comments <span class="badge"><?php echo $clas->total_comments($clas->escape($Posts->posts_id))?></span></a>
      <hr style=" border: 0.3px solid red"> 
    </div>
     <?php } ?>
   </div>
   <div class="row" style="margin:20px 0px 0px 0px;border: 1px solid grey">
 <section class="panel">
  <div class="panel-heading " style="background: black;color: #fff" >
      <b><i class="panel-title">Latest News</i></b>
    </div>
  <div class="panel-body">
 <div class="row" style="margin-top: 15px">
  <?php
   $view_posts=$clas->view_by_pagination(0,12);
   foreach ($view_posts as $Posts) {
  ?>

<div class="col-md-4 ">
      <div class="" style="background:#f0f5f5;padding:5px 0px 5px 0px">
   <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="170" height="100">
   <h5 class="text-danger"><strong><a target="blank" class="text-danger" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
  <p style="font-size:13px;" ><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>" style="color:black"><?php echo $clas->escape(substr($Posts->contents,0,46)); ?></a>...</p>
   <h6 class="text-primary">posted: <span class="glyphicon glyphicon-time"></span> <?php echo $clas->date_posted(date("h:i:sa M d Y",strtotime($Posts->date_posted))); ?></h6> 
</div>
<br>
 </div>

<?php
}
?>
</div>
</div>
</section>
</div>
   <ul class="pager">
  <li class="next"><a href="index.php?currentpage=1">More Posts..</a></li> 
</ul>  
</div>

 <?php } 
 else if(isset($_GET['currentpage'])){
$rowsperpage=12;
  $totalpages=$clas->num_of_totalpage($rowsperpage);
  $currentpage=$_GET['currentpage'];
  if(isset($currentpage) && is_numeric($currentpage)){
      $currentpage=(int)$currentpage;
    }else{
      $currentpage=1;
    }
    if($currentpage<1){
      $currentpage=1;
    }
    $offset=($currentpage-1) * $rowsperpage;
    $range=3;
    ?>
    <div class="col-md-8" style="margin:10px 0px 10px 0px;border: 0.5px solid lightgrey">
    <div class="row" >
  <section class="panel">
  <div class="panel-heading " style="background: black;color: #fff" >
      <b><i class="panel-title">Latest News</i></b>
    </div>
  <div class="panel-body">
 <div class="row" style="margin-top: 15px">
  <?php
   $view_posts=$clas->view_by_pagination($offset,$rowsperpage);
   foreach ($view_posts as $Posts) {
  ?>

<div class="col-md-4 ">
      <div class="" style="background:#f0f5f5;padding:5px 5px 5px 5px">
   <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="170" height="100">
   <h5 class="text-danger"><strong><a target="blank" class="text-danger" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
  <p style="font-size:13px;" ><a target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>" style="color:black"><?php echo $clas->escape(substr($Posts->contents,0,46)); ?></a>...</p>
   <h6 class="text-primary"><span class="glyphicon glyphicon-time"></span> <?php echo $clas->date_posted(date("h:i:sa M d Y",strtotime($Posts->date_posted))); ?></h6> 
</div>
<br>
 </div>

<?php
}
?>
</div>
</div>
</section>
</div>
<?php
  if($currentpage>1){
$prevpage=$currentpage-1;
  echo "<ul class='pager'><li class='Previous '><a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>&lt;&lt;Previous Posts</a></li></ul>";
}
if($currentpage != $totalpages){
  $nextpage=$currentpage+1;
  echo "<ul class='pager'><li class='Next'><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Next Posts.&gt;&gt;</a></li></ul>"; 
} ?>
</div>
<?php } ?>
<div class="col-md-4" style="padding-top: 0px;">
    <div class="row " style="margin:10px 0px 5px 0px">
   <div class="row " style="margin:10px 0px 5px 0px">
      <a href="votingpage.php" target="blank">BSU MR AND MISS FRESHER(<span style="color:red">CLICK TO VOTE FOR CANDIDATE</span>)
   <img src="images\mrbsu.jpg" alt="Cinque Terre" class="img-responsive" alt="Cinque Terre" width="250" height="100">
 </a>
 </div>
 <br>
    <div class="row " >
   <h3 class="text-danger"><b >Stay With Us </b></h3>
    <img src="images\facebook.png" alt="Cinque Terre" width="31" height="30">
   <img src="images\youtube.png" alt="Cinque Terre" width="27" height="27">
   <img src="images\instagram.jpg"  alt="Cinque Terre" width="30" height="30">
   <img src="images\twiter.png" alt="Cinque Terre" width="32" height="32">
 </div>
 <br>

<div class="row">
<div class=" panel panel-default" style="margin:10px 10px 10px 10px;">
    <div class="panel-heading " style="color: #fff;background: #800000" >
      <b><i class="panel-title">Hot music</i></b>
    </div>
    <div class="panel-body">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
<?php
   foreach ($clas->viewmusic_by_pagination(0,3) as $Posts) {
  ?>
    <div class="row">
    <div class="col-md-4">
      <img src="imageloader.php?sn=<?php echo $clas->escape($Posts->id); ?>"  alt="Cinque Terre" width="80" height="50">
 </div>
 <div class="col-md-6">
  <h5><strong><a style="color:black" href="singlemusic.php?msn=<?php echo $clas->escape($Posts->id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
 </div>
</div>
<hr style=" border: 0.5px solid grey"> 
<?php } ?>
</div>
<div class="item"> 
<?php
   foreach ($clas->viewmusic_by_pagination(4,3) as $Posts) {
  ?>
    <div class="row">
    <div class="col-md-4">
      <img src="imageloader.php?sn=<?php echo $clas->escape($Posts->id); ?>"  alt="Cinque Terre" width="80" height="50">
 </div>
 <div class="col-md-6">
  <h5><strong><a style="color:black" href="singlemusic.php?msn=<?php echo $clas->escape($Posts->id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
 </div>
</div>
<hr style=" border: 0.5px solid grey"> 
<?php } ?>
</div>
<div class="item"> 
 <?php
   foreach ($clas->viewmusic_by_pagination(8,3) as $Posts) {
  ?>
    <div class="row">
    <div class="col-md-4">
      <img src="imageloader.php?sn=<?php echo $clas->escape($Posts->id); ?>"   alt="Cinque Terre" width="80" height="50">
 </div>
 <div class="col-md-6">
  <h5><strong><a style="color:black" href="singlemusic.php?msn=<?php echo $clas->escape($Posts->id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
 </div>
</div>
<hr style=" border: 0.5px solid grey"> 
<?php } ?>
</div>

</div> 
  </div>
    </div>
  </div> 
</div>
<br>
<div class="col-md-12">
<img src="images\zenith.jpg" class="img-responsive" alt="Cinque Terre" width="350" height="300">
</div>
</div>

</div>

<div class="btn btn-danger " style="background: black;">
  <p>------- Visitors -------<br></p> 
  <?php echo $clas->total_visitors(); ?>
</div>
</div>
<?php 
include ("resources/includes/footer.php");
?>
