<?php 

include ("resources/includes/config.php");
include ("resources/func/blogfunctions.php");
$clas = new Myblog(); 
$cat_id="";
if(isset($_GET['id'])){
  $cat_id=$_GET['id'];
if(!empty($cat_id)){
foreach ($clas->get_category($cat_id) as $key) {

        echo " <form action='' method='post'>
      <h2 class='text-left text-danger'>Edit Category</h2>
        <div class=' form-group'>
         <input class='form-control' value='$key->id' name='id' type='text' readonly>
         </div>
          <div class=' form-group'>
          <input class='form-control' value='$key->name' name='name1' type='text' required>
        </div>
      <div class='row'>
        <div class='col-md-12 form-group'>
          <button class='btn btn-primary pull-right' type='submit'>Edit Category</button>
        </div>
      </div>
      </form>";
 } 
}
}

else if(isset($_GET['del'])){
$cat_id=$_GET['del'];
$clas->delete_categories($cat_id);
$clas->delete_post_by_category($cat_id);
header("Location:Admin/admin.php");
}


else if(isset($_GET['view'])){
$cat_id=$_GET['view'];
      foreach ($clas->view_posts($cat_id) as $posts) {
    echo "
  <li class='list-group-item '><img src='../imageloader.php?im= $posts->posts_id ' alt='Cinque Terre' width='150' height='100'>
<h5 ><strong> $posts->title;</strong></h5><a class='btn btn-info input-sm' href='../edit_post.php?ed=$posts->posts_id' /><span class='glyphicon glyphicon-edit' ></span>EDIT</a><a href='../crudepage.php?delpost=$posts->posts_id' onclick='return del()' class='pull-right'>DELETE</a></li>";
}
}


else if(isset($_GET['delpost'])){
$cat_id=$_GET['delpost'];
$clas->delete_post_by_id($cat_id);
header("Location:Admin/admin.php");
}
else if(isset($_POST['name']) && isset($_POST['comment']) && isset($_POST['post_id'])){
  $name=$_POST['name'];
  $comment=$_POST['comment'];
  $post_id=$_POST['post_id'];
  $likes=0;
  $dislikes=0;
  if(empty($name)){
    $name="Anonymous";
  }
  if(empty($comment)){
    echo "sorry you havnt added any comment";
  }
  
  else{
   $row=$clas->add_comments($post_id,$comment,$name,$likes,$dislikes);

  foreach ($row as $value) {
  
   echo "
<div class='col-md-10 col-md-offset-1 text-left'  style='background: #f0f5f5;border-top: 2px solid grey'>
  <div class='row'>
    <div class='col-md-2'>
      <img src='images\img.png' class='img-responsive' alt='Cinque Terre' width='100' height='150' style='border: 2px solid grey;border-radius: 5px;margin-top: 5px'>
    </div>
    <div class='col-md-10  text-center'>
      <h5 class='text-left'><strong class='text-danger'> $value->name</strong>&nbsp;<span><small>Just now</small></span></h5>
      <p style='text-align: justify; margin-top: 2px' > $value->comment</p>
       <div class='row'>
        <div class='col-sm-3 form-group'>
         <a href='' class='text-danger' style='font-weight: bold;''><span class='glyphicon glyphicon-thumbs-up' style='font-weight: bold;'>Likes</span>$value->likes</a> 
        </div>
        <div class='col-sm-3'>
          <a href='' class='text-danger' style='font-weight: bold;''><span class='glyphicon glyphicon-thumbs-down text-danger' style='font-weight: bold;'>Dislikes</span>$value->dislikes</a>
        </div>
       <div class='col-sm-4  form-group'>
         
          <a  class='text-danger' href='singles.php?single=$value->post_id' style='font-weight: bold;'><span class='glyphicon glyphicon-comment text-danger'></span> Reply</a>
        </div>
    </div>
    </div>
  </div>
</div>";
}
}
//echo $name." ".$comment." ".$post_id;
 // }
   }
   
 else if(isset($_GET['rep'])){
  $cat_id=$_GET['rep'];
  $sep=strpos($cat_id, '/');
  $comment_id=substr($cat_id,0,$sep);
  $post_id=substr($cat_id,$sep+1);
  $comment_id=(int)$comment_id;
  $post_id=(int)$post_id;
if(!empty($comment_id) && !empty($post_id)){
foreach ($clas->view_comments1($comment_id) as $key) {
  echo " 
            <form action='' method='post'>
            <input  class='form-control' id='rname' name='rname' placeholder='Name' type='text'>
            <br>
         <textarea class='form-control' id='reply' name='reply' placeholder='Comment' rows='5'></textarea>
         <div class='row'>
         <div class='col-md-6'>
         <input  class='form-control' value='$key->id' style='visibility:hidden;' name='comment_id' placeholder='id'  type='text'>
         </div
         <div class='col-md-6'>
         <input  class='form-control' value='$post_id' style='visibility:hidden;' name='post_id' placeholder='id'  type='text'>
         </div>
        </div>
    <button class='btn btn-danger ' type='submit' >Reply</button>
   </form>  
";
}
 }
}else if(isset($_GET['like'])){
  $id=$_GET['like'];
if(!empty($id)){
 $like=$clas->update_likes($id);
 echo $like;
}
}
else if(isset($_GET['dislike'])){
  $id=$_GET['dislike'];
if(!empty($id)){
  $dislike=$clas->update_dislikes($id);
  echo $dislike;
}
}
else if(isset($_GET['rlike'])){
  $id=$_GET['rlike'];
if(!empty($id)){
 $rlike=$clas->update_rlikes($id);
 echo $rlike;
}
}
else if(isset($_GET['rdlike'])){
  $id=$_GET['rdlike'];
if(!empty($id)){
 $rdislike=$clas->update_rdlikes($id);
 echo $rdislike;
}
}
 
?>