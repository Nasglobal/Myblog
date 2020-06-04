<?php 
error_reporting(0);
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
    #output_image{
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
  $error[]= "Pls Select image again";
}
if ($image_name > 50000000) {
  $error[]= "Sorry, your file is too large.";
}
if(($file_extention !=="jpg") && ($file_extention !=="png") && ($file_extention !=="jpeg") && ($file_extention !=="gif") && ($file_extention !=="JPG") && ($file_extention !=="PNG") && ($file_extention !=="JPEG") && ($file_extention !=="GIF")){
   $error[]= "Sorry only png,jpeg,jpg and gif images are accepted;Select image again";
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

  $clas->edit_posts($_GET['ed'],$title,$comment,$category,$image_name,$image_data);
  
  header("Location:Admin/admin.php");
}

}
?>
    <div class="col-md-8 col-md-offset-2"  >
      <h2 class="text-left text-danger">EDIT POST</h2>
      <?php
      if(isset($error) && !empty($error)){
        echo "<ul><li>", implode('</li><li>', $error),"</li></ul>";
      }
      ?>
      <div class="row">
        <?php
        if(isset($_GET['ed'])){

          foreach ($clas->view_posts($id=null,$_GET['ed']) as $posts) {

          ?>
      <div class="col-md-8 ">
         <img src="imageloader.php?im=<?php echo $clas->escape($posts->posts_id); ?>"  alt="Cinque Terre" width="300" height="200" id="output_image"> 
    </div>
  </div>
  <br>
  <p class="text-left">Select Image again</p>
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
            foreach ($clas->view_categories() as $category){
              $selected = ($category->name==$posts->name)? 'selected':'';
             ?>
            <option value="<?php echo $clas->escape($category->id); ?>" <?php echo $selected; ?> ><?php echo $clas->escape($category->name); ?></option>
           <?php } ?>
          </select>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="title" value="<?php echo $clas->escape($posts->title) ?>" name="title"  type="text" >
        </div>
      </div>
      <textarea class="form-control"  name="comment" placeholder="text.." rows="5"><?php echo $clas->escape($posts->contents); ?></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-danger pull-right" name="submit" type="submit">EDIT</button>
        </div>
      </div> 
      </form> 
    </div>
    <?php }} ?>

</div>
</div>
<?php

include ("resources/includes/footer.php");

?>