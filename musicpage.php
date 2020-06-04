
<?php
error_reporting(0);
include ("resources/includes/header.php");
?>
<div class="container col-md-10 col-md-offset-1 text-center " style="background: white;height:auto;margin-bottom: 10px;">
  <div class="col-md-8" style="margin:40px 0px 0px 0px;border: 0.5px solid grey">
   <div class="row">
  <section class="panel" style="margin:-25px 15px 10px 15px">
  <div class="panel-heading " style="background: black;color: tomato" >
      <b><i class="panel-title">Trending Music</i></b>
    </div>
  <div class="panel-body">
 <div class="row" style="margin-top: 15px">
  <?php
   $view_posts=$clas->view_music();
   foreach ($view_posts as $Posts) {
  ?>

<div class="col-md-4 ">
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

<?php
}
?>
</div>
</div>
</section>
</div>
</div>
<div class="col-md-4" style="padding-top: 0px;">
    <div class="row " style="margin:10px 0px 5px 0px">
   <h3 class="text-danger"><b >Stay With Us </b></h3>
    <img src="images\facebook.png" alt="Cinque Terre" width="31" height="30">
   <img src="images\youtube.png" alt="Cinque Terre" width="27" height="27">
   <img src="images\instagram.jpg"  alt="Cinque Terre" width="30" height="30">
   <img src="images\twiter.png" alt="Cinque Terre" width="32" height="32">
 </div>
 <br>

<div class="row" style="margin:10px 10px 10px 10px;border:0.5px solid grey">
<div class=" panel " style="margin:-20px 10px 10px 10px">
    <div class="panel-heading " style="color:white;background:#800000;font-weight: bold;" >
      <b><i class="panel-title">Trending News</i></b>
    </div>
    <div class="panel-body">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
<?php
   foreach ($clas->view_by_pagination(0,3) as $Posts) {
  ?>
    <div class="row">
    <div class="col-md-4">
      <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="80" height="50">
 </div>
 <div class="col-md-6">
  <h5><strong><a style="color:black" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
 </div>
</div>
<hr style=" border: 0.5px solid grey"> 
<?php } ?>
</div>
<div class="item"> 
<?php
   foreach ($clas->view_by_pagination(4,3) as $Posts) {
  ?>
    <div class="row">
    <div class="col-md-4">
      <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="80" height="50">
 </div>
 <div class="col-md-6">
  <h5><strong><a style="color:black" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
 </div>
</div>
<hr style=" border: 0.5px solid grey"> 
<?php } ?>
</div>
<div class="item"> 
 <?php
   foreach ($clas->view_by_pagination(8,3) as $Posts) {
  ?>
    <div class="row">
    <div class="col-md-4">
      <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>"  alt="Cinque Terre" width="80" height="50">
 </div>
 <div class="col-md-6">
  <h5><strong><a style="color:black" target="blank" href="singles.php?single=<?php echo $clas->escape($Posts->posts_id); ?>"><?php echo $clas->escape($Posts->title); ?></a></strong></h5>
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
<?php 
include ("resources/includes/footer.php");
?>