<?php
include ("resources/includes/header.php");
$single=$_GET['single'];
if(isset($_POST['rname']) && isset($_POST['reply']) && isset($_POST['comment_id']) && isset($_POST['post_id'])){

  $rname=$_POST['rname'];
  $reply=$_POST['reply'];
  $comment_id=$_POST['comment_id'];
  $post_id=$_POST['post_id'];
  $likes=0;
  $dislikes=0;

  if(empty($rname)){
    $rname="Anonymous";
  }
  if(!empty($reply)){
    $clas->add_reply($comment_id,$post_id,$rname,$reply,$likes,$dislikes);
  }
}
?>
<div class="container col-md-10 col-md-offset-1 text-center" style="background: white;height:auto;">
  <div class="col-md-8 " style="margin:20px 0px 10px 0px;border:0.5px solid lightgrey">
    <?php
   if(isset($_GET['single'])){
    foreach($clas->view_posts($id=null,$_GET['single']) as $Posts){

      ?>
  	<div class="btn btn-danger"><?php echo $clas->escape($Posts->name); ?></div>
    
      <h3 class="text-danger"><strong><?php echo $clas->escape($Posts->title); ?></strong></h3>
    <img src="imageloader.php?im=<?php echo $clas->escape($Posts->posts_id); ?>" class="img-responsive" alt="Cinque Terre" width="600" height="300">
    <div class="row">
      <p style="text-align: justify; padding: 10px 20px 10px 20px;"
><?php echo $clas->escape($Posts->contents); ?></p>
</div>
      <div class="row">
    <div  class="btn btn-danger">Comments &nbsp;<span><?php echo $clas->total_comments($_GET['single'])?></span></div>
  </div>
    <?php
}

    if ($clas->next1($_GET['single'])==true && $clas->next2($_GET['single'])==true){
       $id2=$_GET['single'];
      $van1=$clas->single_next($id2);
     $van2=$clas->single_next($id=null,$id2);
      echo "<div class='row'>
      <div class='col-md-10 col-md-offset-1'>
      <ul class='pager'>
      <li class='Previous pull-left'><a href='singles.php?single=$van2'>&lt;&lt;Previous Posts</a></li>
      <li class='Next pull-right'><a href='singles.php?single=$van1' >Next Posts.&gt;&gt;</a></li>
      </ul> 
      </div> 
      </div>";    

 }else if($clas->next1($_GET['single']) ){
      $id=$_GET['single'];
      $van=$clas->single_next($id);
     
      echo "<div class='row'>
      <div class='col-md-10 col-md-offset-1'>
      <ul class='pager'>
      <li class='Previous pull-left'><a >Previous Posts</a></li>
      <li class='next pull-right'><a href='singles.php?single=$van'>Next Posts.&gt;&gt;</a></li>
      </ul> 
      </div> </div>";    
 } 
 else{
       $id2=$_GET['single'];
      $van=$clas->single_next($id=null,$id2);
     
      echo "<div class='row'>
      <div class='col-md-10 col-md-offset-1'>
      <ul class='pager'>
      <li class='Previous pull-left'><a href='singles.php?single=$van' >&lt;&lt;Previous Posts</a></li>
      <li class='next pull-right'><a>Next Posts</a></li>
      </ul> 
      </div> 
      </div";    

 } 
}?>
<div class="row">
 
  <?php
  foreach ($clas->view_comments($_GET['single']) as $value) {
  
   ?>
<div class="col-md-10 col-md-offset-1 text-left"  style="background: #f0f5f5;border-top: 2px solid grey">
	<div class="row">
		<div class="col-md-2">
			<img src="images\img.png" class="img-responsive" alt="Cinque Terre" width="100" height="150" style="border: 2px solid grey;border-radius: 5px;margin-top: 5px">
		</div>
		<div class="col-md-10  text-center">
			<h5 class="text-left"><strong class="text-danger"><?php echo $clas->escape($value->name); ?></strong>&nbsp;<span><small><?php echo $clas->date_posted(date("h:i:sa M d Y",strtotime($value->date_commented))); ?></small></span></h5>
			<p style="text-align: justify; margin-top: 2px" ><?php echo $clas->escape($value->comment); ?></p>
			 <div class="row">
        <div class="col-sm-3 form-group">
         <a onclick="load1('like<?php echo $clas->escape($value->id); ?>','crudepage.php?like=<?php echo $clas->escape($value->id); ?>')" class="text-danger " style="font-weight: bold;"><span class="glyphicon glyphicon-thumbs-up" style="font-weight: bold;" ></span>LIkes</a>&nbsp;<span class="text-danger " style="font-weight: bold;" id="like<?php echo $clas->escape($value->id); ?>"><?php echo $clas->escape($value->likes); ?></span>
        </div>
        <div class="col-sm-3 ">
          <a onclick="load1('dlike<?php echo $clas->escape($value->id); ?>','crudepage.php?dislike=<?php echo $clas->escape($value->id); ?>')" class="text-danger " style="font-weight: bold;"><span class="glyphicon glyphicon-thumbs-up" style="font-weight: bold;"></span>Dislikes</a>&nbsp;<span class="text-danger " style="font-weight: bold;" id="dlike<?php echo $clas->escape($value->id); ?>"><?php echo $clas->escape($value->dislikes); ?></span>
        </div>
        <div class="col-sm-4  form-group">
         
          <a  class="text-danger " data-toggle="modal" data-target="#viewReply" onclick="load1('viewreply','crudepage.php?rep=<?php echo $clas->escape($value->id."/".$single); ?>')" style="font-weight: bold;"><span class="glyphicon glyphicon-comment text-danger"></span> Reply</a>
          <div id="viewReply" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
            <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">cancel</button>
        <h4 class="modal-title text-danger">Reply comment:</h4>
      </div>
      <div class="modal-body">
         
        <div id="viewreply"></div>
      </div>

          </div>
        </div>
      </div>
      </div>
    </div>
    <?php
    $comment_id=$clas->escape($value->id);
  foreach ($clas->view_reply($comment_id) as $reply) {
   ?>
    <div class="col-md-10 col-md-offset-1 text-left"  style="background: #f0f5f5;border-top: 0.5px solid grey">
  <div class="row">
    <div class="col-md-2">
      <img src="images\img.png" class="img-responsive" alt="Cinque Terre" width="80" height="130" style="border: 2px solid grey;border-radius: 5px;margin-top: 5px">
    </div>
    <div class="col-md-10  text-center">
      <h5 class="text-left"><strong class="text-danger"><?php echo $clas->escape($reply->rname); ?>&nbsp;</strong><span><small><?php echo $clas->date_posted(date("h:i:sa M d Y",strtotime($reply->date_replied))); ?></small></span></h5>
      <p style="text-align: justify; margin-top: 2px" ><?php echo $clas->escape($reply->replys); ?></p>
       <div class="row">
        <div class="col-sm-4 form-group">
         <a onclick="load1('rlike<?php echo $clas->escape($reply->id); ?>','crudepage.php?rlike=<?php echo $clas->escape($reply->id); ?>')" class="text-danger " style="font-weight: bold;"><span class="glyphicon glyphicon-thumbs-up" style="font-weight: bold;"></span>Likes</a>&nbsp;<span class="text-danger " style="font-weight: bold;" id="rlike<?php echo $clas->escape($reply->id); ?>"><?php echo $clas->escape($reply->replylikes); ?></span>
        </div>
        <div class="col-sm-6 ">
          <a onclick="load1('rdlike<?php echo $clas->escape($reply->id); ?>','crudepage.php?rdlike=<?php echo $clas->escape($reply->id); ?>')" class="text-danger " style="font-weight: bold;"><span class="glyphicon glyphicon-thumbs-up" style="font-weight: bold;"></span>Dislikes</a>&nbsp;<span class="text-danger " style="font-weight: bold;" id="rdlike<?php echo $clas->escape($reply->id); ?>"><?php echo $clas->escape($reply->replydislikes); ?></span>
        </div>
        
      </div>
    </div>
  </div>
</div>
<?php } ?>
		</div>
	</div>
  
</div>

<?php } ?>
 <div id="viewcomments">
  </div>
</div>
<div class="row">
  
<div id="contact" class="col-md-10">
    	<h2 class="text-left text-danger">Add Comment</h2>
      <form action="" method="post">
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="form-control" id="names" placeholder="Name" type="text" >
        </div>
      </div>
      <textarea class="form-control" id="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-danger pull-right" type="button" onclick="load_comment('viewcomments','crudepage.php')" >Comment</button>
        </div>
      </div>	
  </form>
</div>
   </div>
   </div>
  <div class="col-md-4" style="padding-top: 0px;">
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
    <img src="images\zenith.jpg" class="img-responsive" alt="Cinque Terre" width="350" height="300">
</div>
</div>

  <?php
include ("resources/includes/footer.php");
  ?>
 