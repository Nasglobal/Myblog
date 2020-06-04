<?php
//error_reporting(0);
session_start();
if(!isset($_SESSION['username'])){
  header("location:../results.php");
}
else{
include ("resources/includes/config.php");
include ("resources/func/blogfunctions.php");
$clas = new Myblog(); 
if (isset($_POST["name"])){
  $name=trim($_POST["name"]);
  if(empty($name)){
    $GLOBALS['msg']="Sorry no category entered";
  }else if($clas->categories_exist2($name)){
    $GLOBALS['msg']="Category already exist";
  }else if(strlen($name)>24){
    $GLOBALS['msg']="Category name too long(maximum of 20 characters)";
  }
  if(isset($GLOBALS['msg'])){
     ?>
   <script>alert('<?php echo $GLOBALS['msg']; ?>');</script>
   <?php
  }else{
    $clas->add_categories($name);
    ?>
    <script>alert('category added successfully');</script>
  <?php  
  }
   
}
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

function preview_image(event){
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('output_image');
    output.src = reader.result;}
    reader.readAsDataURL(event.target.files[0]);
  }
  function preview_image1(event){
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('output_image1');
    output.src = reader.result;}
    reader.readAsDataURL(event.target.files[0]);
  }
  function preview_image2(event){
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('output_image2');
    output.src = reader.result;}
    reader.readAsDataURL(event.target.files[0]);
  }
   function preview_image3(event){
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('output_image3');
    output.src = reader.result;}
    reader.readAsDataURL(event.target.files[0]);
  }
  function del(){
  var s = confirm("Are u sure you want to delete Posts?");
            if(s==true){
                return true;
                
            }else{
                return false;
                window.preventDefault();
            }
}
</script>
  <style type="text/css">
    body{
      background: url('images/backgroun.png');

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
    #output_image{
        width: 300px;
        height: 150px;
    }
    #output_image1{
        width: 300px;
        height: 150px;
    }
    #output_image2{
        width: 300px;
        height: 150px;
    }
    #output_image3{
        width: 300px;
        height: 150px;
    }
  </style>
  
</head>
<body >
  
  <div class="container  text-center">

    <div >
      <h1 style="color:red;font-size: 50px;font-weight:900;font-style: italic;">Admin dashboared</h1>
      <p style="font-size:20px;color:red;font-style: italic;background: grey">NASGlobal World......</p>
    </div>
    <div class="container col-md-12"  style="background: #fff;height:aut">

<br>
<?php

if(isset($_POST['submit'])){
  $error= array();
$image_name =trim($_FILES["fileToUpload"]["name"]);//image name
$image_type = $_FILES["fileToUpload"]["type"];//image type
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);// Check if image file is a actual image or fake image
$image_data=file_get_contents($_FILES["fileToUpload"]["tmp_name"]);// image data i.e image code representation;
$category=trim($_POST['category']);
$title=trim($_POST['title']);
$comment=trim($_POST['comment']);
$ext=strpos($image_name,".",0);
$file_extention=trim(substr($image_name,$ext+1));
if($check === false) {
  $error[]= " File is not an image.";
}
if(empty($image_name)) {
  $error[]= "image not selected";
}
if ($_FILES["fileToUpload"]["size"] > 1000000) {
  $error[]= "Sorry, your file is too large.";
}
if(($file_extention !=="jpg") && ($file_extention !=="png") && ($file_extention !=="jpeg") && ($file_extention !=="gif") && ($file_extention !=="JPG") && ($file_extention !=="PNG") && ($file_extention !=="JPEG") && ($file_extention !=="GIF")){
   $error[]= "Sorry only png,jpeg,jpg and gif images are accepted";
}

if(empty($title)){
   $error[]="title field cannot be empty";
 }
  else if(strlen($title)>255){
  $error[]="title too long(not more than 255 characters)";
 }    
 if(empty($comment)){
   $error[]="No comment added";
 }
 if($clas->categories_exist1($category)){
  $error[]="category does not exist";
 }  
 if(empty($error)){
  $clas->add_posts($title,$comment,$category,$image_name,$image_data);
  ?>
  <script type="text/javascript">
    window.alert("posted successfully");
  </script>

  <?php
}

}


if(isset($_POST['csubmit'])){
  $error= array();
$image_name =trim($_FILES["fileToUpload2"]["name"]);//image name
$image_type = $_FILES["fileToUpload2"]["type"];//image type
$check = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);// Check if image file is a actual image or fake image
$image_data=file_get_contents($_FILES["fileToUpload2"]["tmp_name"]);// image data i.e image code representation;
$ccategory=trim($_POST['ccategory']);
$candidatenum=trim($_POST['candidatenum']);
$cname=trim($_POST['cname']);
$numvote=0;
$Department=trim($_POST['Department']);
$ext=strpos($image_name,".",0);
$file_extention=trim(substr($image_name,$ext+1));
if($check === false) {
  $error2[]= " File is not an image.";
}
if(empty($image_name)) {
  $error2[]= "image not selected";
}
if ($_FILES["fileToUpload2"]["size"] > 1000000) {
  $error2[]= "Sorry, your file is too large.";
}
if(($file_extention !=="jpg") && ($file_extention !=="png") && ($file_extention !=="jpeg") && ($file_extention !=="gif") && ($file_extention !=="JPG") && ($file_extention !=="PNG") && ($file_extention !=="JPEG") && ($file_extention !=="GIF")){
   $error2[]= "Sorry only png,jpeg,jpg and gif images are accepted";
}

if(empty($cname)){
   $error2[]="name field cannot be empty";
 }
 if(empty($ccategory)){
  $error2[]="select a caregory(mr/miss)";
 }    
 if(empty($candidatenum)){
   $error2[]="No candidate number added";
 }
 if(empty($Department)){
   $error2[]="No Department added";
 }

 if(isset($error2) && !empty($error2)){
    ?>
    <script type="text/javascript">
    window.alert("<?php echo  implode('*', $error2) ?>");
  </script>
   <?php     
      }   
     else{
  $clas->add_candidate($ccategory,$candidatenum,$cname,$Department,$numvote,$image_name,$image_data);
  ?>
  <script type="text/javascript">
    window.alert("candidate uploaded successfully");
  </script>
  <?php
}

}
 

if(isset($_POST['music_upload'])){
  $error1= array();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["music"]["name"]);
$music_data=trim($_FILES["music"]["tmp_name"]);
$music_name =trim($_FILES["music"]["name"]);//music name
$image_name = $_FILES["pic"]["name"];//image name
$image_data=file_get_contents($_FILES["pic"]["tmp_name"]);// image data i.e image code representation;
$check = getimagesize($_FILES["pic"]["tmp_name"]);//check if image is a real image
$title=trim($_POST['mtitle']);
$mcontent=trim($_POST['mcontent']);
$ext=strpos($image_name,".",0);
$ext1=strpos($music_name,".",0);
$file_extention=trim(substr($image_name,$ext+1));
$musicfile_extention=trim(substr($music_name,$ext1+1));
if (file_exists($target_file)) {
  $error1[]= "Sorry,music file already exists.";
}
if ($_FILES["music"]["size"] > 2000000) {
  $error1[]= "Sorry,music file too large";
   }
if(($musicfile_extention !== "mp3") && ($musicfile_extention !== "mp4") && ($musicfile_extention !== "wav") ) {
    $error1[]="Sorry, only mp3 and mp4 allowed";
}
if($check === false) {
  $error1[]= " File is not an image.";
}
if(empty($image_name)) {
  $error1[]= "image not selected";
}
if ($_FILES["pic"]["size"] > 1000000) {
  $error1[]= "Sorry, your image file is too large.";
}
if(($file_extention !=="jpg") && ($file_extention !=="png") && ($file_extention !=="jpeg") && ($file_extention !=="gif") && ($file_extention !=="JPG") && ($file_extention !=="PNG") && ($file_extention !=="JPEG") && ($file_extention !=="GIF")){
   $error1[]= "Sorry only png,jpeg,jpg and gif images are accepted";
}
if(empty($mcontent)){
   $error1[]="comment field cannot be empty";
 }

if(empty($title)){
   $error1[]="title field cannot be empty";
 }
  else if(strlen($title)>255){
  $error1[]="title too long(not more than 255 characters)";
 } 

  if(isset($error1) && !empty($error1)){
    ?>
    <script type="text/javascript">
    window.alert("<?php echo  implode('*', $error1) ?>");
  </script>
   <?php     
      }   
     else{
  if(move_uploaded_file($music_data,$target_file)){
   $clas->upload_music($title,$mcontent,$music_name,$image_name,$image_data);
  ?>
  <script type="text/javascript">
    window.alert("Music Uploaded successfully");
  </script>
  <?php
}

}
}



if(isset($_POST['music_video'])){
  $errorv= array();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["video"]["name"]);
$video_data=trim($_FILES["video"]["tmp_name"]);
$video_name =trim($_FILES["video"]["name"]);//music name
$image_name = $_FILES["picv"]["name"];//image name
$image_data=file_get_contents($_FILES["picv"]["tmp_name"]);// image data i.e image code representation;
$check = getimagesize($_FILES["picv"]["tmp_name"]);//check if image is a real image
$title=trim($_POST['vtitle']);
$vcontent=trim($_POST['vcontent']);
$ext=strpos($image_name,".",0);
$ext1=strpos($video_name,".",0);
$file_extention=trim(substr($image_name,$ext+1));
$musicfile_extention=trim(substr($video_name,$ext1+1));
/*if (file_exists($target_file)) {
  $errorv[]= "Sorry,video file already exists.";
}
if ($_FILES["video"]["size"] > 200000000) {
  $errorv[]= "Sorry,video file too large";
   }
if(($musicfile_extention !== "mp3") && ($musicfile_extention !== "mp4") && ($musicfile_extention !== "wav") ) {
    $errorv[]="Sorry, only mp3 and mp4 allowed";
}
if($check === false) {
  $errorv[]= " File is not an image.";
}
if(empty($image_name)) {
  $errorv[]= "image not selected";
}
if ($_FILES["picv"]["size"] > 1000000) {
  $errorv[]= "Sorry, your image file is too large.";
}
if(($file_extention !=="jpg") && ($file_extention !=="png") && ($file_extention !=="jpeg") && ($file_extention !=="gif") && ($file_extention !=="JPG") && ($file_extention !=="PNG") && ($file_extention !=="JPEG") && ($file_extention !=="GIF")){
   $errorv[]= "Sorry only png,jpeg,jpg and gif images are accepted";
}
if(empty($vcontent)){
   $errorv[]="comment field cannot be empty";
 }

if(empty($title)){
   $errorv[]="title field cannot be empty";
 }
  else if(strlen($title)>255){
  $errorv[]="title too long(not more than 255 characters)";
 } 

  if(isset($errorv) && !empty($errorv)){
    ?>
    <script type="text/javascript">
    window.alert("<?php echo  implode('*', $errorv) ?>");
  </script>
   <?php     
      }   
     else{*/
  //if(move_uploaded_file($video_data,$target_file)){
  $clas->upload_video($title,$vcontent,$video_name,$image_name,$image_data);
  ?>
  <script type="text/javascript">
    window.alert("Video Uploaded successfully");
  </script>
  <?php
//}

}
//}
?>

    <div class="col-md-10 col-md-offset-1" >
    <ul class="nav nav-pills ">
  <li ><a  href="../index.php" target="blank">View Blog</a></li>
  <li class="active"><a data-toggle="pill" href="#addpost">Add Posts</a></li>
  <li><a data-toggle="pill" href="#addcategory">Add Category</a></li>
  <li><a data-toggle="pill" href="#viewcategory">View Categories</a></li>
  <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">View All Posts<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li class="active"><a href="#">**Select Category To View**</a></li>
       <?php
            foreach ($clas->view_categories() as $category) {
             ?>
      <li><a data-toggle="modal" data-target="#viewPost" onclick="load1('viewcpost','../crudepage.php?view=<?php echo $clas->escape($category->id); ?>')"><?php echo $clas->escape($category->name); ?></a></li>
     <?php } ?>
     <li ><a data-toggle="modal" data-target="#viewMusic">music</a></li>
    </ul>
  </li>
  <li><a data-toggle="pill" href="#uploadmusic">Upload Music</a></li>
  <li><a data-toggle="pill" href="#uploadvideo">Upload Video</a></li>
  <li><a data-toggle="pill" href="#votingpage">Voting Page</a></li>
  <form method="post">
  <li ><button class="btn btn-danger" type="submit" name="logout">logout</button></li>
</form>
</ul>
<?php
if(isset($_POST['logout'])){
  session_destroy(); 
  header("location:../index.php");
}
?>
<div class="tab-content">
  
  <div id="addpost" class="tab-pane fade in active">
    <div class="col-md-7 "  >
      <h2 class="text-left text-danger">Add Posts</h2>
      <?php
      if(isset($error) && !empty($error)){
        echo "<ul><li>", implode('</li><li>', $error),"</li></ul>";
      }
      ?>
      <div class="row">
      <div class="col-md-8 ">
        <img id="output_image" >
    </div>
  </div>
  <br>
  <p class="text-left">Select an Image</p>
      <form  method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-sm-6 ">
       <input type="file" class="form-control" name="fileToUpload"  accept="image/*" onchange="preview_image(event)"> 
     </div>
   </div>
   <br>
      <div class="row">
        <div class="col-sm-6 form-group">
          <select class="form-control" name="category">
            <option value="">select category..</option>
            <?php
            foreach ($clas->view_categories() as $category) {
             ?>
            <option value="<?php echo $clas->escape($category->id); ?>"><?php echo $clas->escape($category->name); ?></option>
          <?php } ?>
          </select>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="title" value="<?php if(isset($_POST['title'])){ echo $_POST['title'] ; } ?>" name="title" placeholder="title.." type="text" required>
        </div>
      </div>
      <textarea class="form-control"  name="comment" placeholder="text.." rows="5"><?php if(isset($_POST['comment'])){ echo $_POST['comment']; } ?></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-danger pull-right" name="submit" type="submit">POST</button>
        </div>
      </div> 
      </form> 
    </div>
  </div>
  <div id="votingpage" class="tab-pane fade">
    <div class="col-md-7 "  >
      <h2 class="text-left text-danger">upload candidate details</h2>
      
      <div class="row">
      <div class="col-md-8 ">
        <img id="output_image2" >
    </div>
  </div>
  <br>
  <p class="text-left">Select an Image</p>
      <form  method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-sm-6 ">
       <input type="file" class="form-control" name="fileToUpload2"  accept="image/*" onchange="preview_image2(event)"> 
     </div>
   </div>
   <br>
      <div class="row">
        <div class="col-sm-6 form-group">
          <select class="form-control" name="ccategory">
            <option value="">select category(mr/miss)</option>
            <option value="1">Mr fresher</option>
            <option value="2">Miss fresher</option>
          </select>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="candidatenum" value="<?php if(isset($_POST['candidatenum'])){ echo $_POST['candidatenum'] ; } ?>" name="candidatenum" placeholder="candidate number" type="number" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="cname" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname'] ; } ?>" name="cname" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="Department" value="<?php if(isset($_POST['Department'])){ echo $_POST['Department'] ; } ?>" name="Department" placeholder="Department" type="text" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-danger pull-right" name="csubmit" type="submit">Upload candidate</button>
        </div>
      </div> 
      </form> 
    </div>
  </div>
  <div id="addcategory" class="tab-pane fade">
    <div class="col-md-7 "  >
      
      <form action="" method="post">
      <h2 class="text-left text-danger">Add Category</h2>
        <div class=" form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn btn-danger pull-right" type="submit">Add Category</button>
        </div>
      </div>
      </form>  
    </div>
  </div>
  <div id="uploadmusic" class="tab-pane fade">
    <div class="col-md-7 "  >
      <h2 class="text-left text-danger">Upload Music</h2>
      
      <div class="row">
      <div class="col-md-8 ">
        <img id="output_image1" >
    </div>
  </div>
  <br>
  
      <form  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-6 ">
          <p class="text-left">Select picture :</p>
       <input type="file" class="form-control" name="pic"  accept="image/*" onchange="preview_image1(event)"> 
     </div> 
     <div class="col-sm-6 ">
      <p class="text-left">Select Music :</p>
       <input type="file" class="form-control" name="music"  > 
     </div>
   </div>
   <br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="form-control" id="mtitle" value="<?php if(isset($_POST['mtitle'])){ echo $_POST['mtitle'] ; } ?>" name="mtitle" placeholder="title.." type="text" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <textarea name="mcontent" rows="5" placeholder="comment..." class="form-control"><?php if(isset($_POST['mcontent'])){ echo $_POST['mcontent']; } ?></textarea>
      </div>
    </div>
        <div class="col-sm-12 form-group">
          <button class="btn btn-danger pull-right" name="music_upload" type="submit">Upload Music</button>
        </div>
      </form> 
    </div>
  </div>
  <div id="uploadvideo" class="tab-pane fade">
    <div class="col-md-7 "  >
      <h2 class="text-left text-danger">Upload Video</h2>
      
      <div class="row">
      <div class="col-md-8 ">
        <img id="output_image3" >
    </div>
  </div>
  <br>
  
      <form  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-6 ">
          <p class="text-left">Select picture :</p>
       <input type="file" class="form-control" name="picv"  accept="image/*" onchange="preview_image3(event)"> 
     </div> 
     <div class="col-sm-6 ">
      <p class="text-left">Select Video:</p>
       <input type="file" class="form-control" name="video"  > 
     </div>
   </div>
   <br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="form-control" id="vtitle" value="<?php if(isset($_POST['vtitle'])){ echo $_POST['vtitle'] ; } ?>" name="vtitle" placeholder="title.." type="text" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <textarea name="vcontent" rows="5" placeholder="comment..." class="form-control"><?php if(isset($_POST['vcontent'])){ echo $_POST['vcontent']; } ?></textarea>
      </div>
    </div>
        <div class="col-sm-12 form-group">
          <button class="btn btn-danger pull-right" name="music_video" type="submit">Upload Video</button>
        </div>
      </form> 
    </div>
  </div>
  <div id="viewcategory" class="tab-pane fade ">
    <div class="col-md-7 ">
      <br>
      <h2 class="text-left text-danger">List Of Categories</h2>
    <ul class="list-group">
      <?php 
if (isset($_POST["id"]) &&isset($_POST["name1"])){
  $id=trim($_POST["id"]);
  $name1=trim($_POST["name1"]);
  if(!empty($id) && !empty($name1)){
  $clas->update_categories($id,$name1);
  ?>
  <script type="text/javascript">
    window.alert("Category Updated successfully");
  </script>

  <?php
}
}
      foreach ($clas->view_categories() as $category){
      ?>
      
  <li class="list-group-item text-left"><button type="button" class="btn btn-info input-sm" data-toggle="modal" data-target="#myModal"  onclick="load1('editform','../crudepage.php?id=<?php echo $clas->escape($category->id); ?>')" /><span class="glyphicon glyphicon-edit" ></span>EDIT</button><a href="../crudepage.php?del=<?php echo $clas->escape($category->id); ?>" class="pull-right">DELETE</a> <?php echo $clas->escape($category->name); ?> </li>

  <?php
}
  ?>
</ul>
</div>
  </div>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Edit Category</h4>
      </div>
      <div class="modal-body" >
        
        <div id="editform"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="viewPost" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">List of All Posts under this category</h4>
      </div>
      <div class="modal-body" >
     <div id="viewcpost"> </div>

      </div>
      
    </div>

  </div>
</div>
<div id="viewMusic" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">List of All Music under this category</h4>
      </div>
      <div class="modal-body">
        <?php
        $view_music=$clas->view_music();
        foreach ($view_music as $posts) {
    echo "
  <li class='list-group-item '><img src='../imageloader.php?sn=$posts->id' alt='Cinque Terre' width='150' height='100'>
<h5 ><strong> $posts->title;</strong></h5><a class='btn btn-info input-sm' ><span class='glyphicon glyphicon-edit' ></span>EDIT</a><a href='../crudepage.php?delmusic=$posts->id' onclick='return del()' class='pull-right'>DELETE</a></li>";
}
?>
      </div>
      
    </div>

  </div>
</div>

</div>
</div>
<?php

include ("resources/includes/footer.php");
}
?>