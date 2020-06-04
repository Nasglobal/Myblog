<?php
header("Content-type:image/jpg");
include ("resources/includes/config.php");
if (isset($_GET['im'])){
  $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $cat_id=$db->real_escape_string($_GET['im']);
   $result=$db->query("SELECT * FROM posts WHERE id='{$cat_id}'");
   while ($row=$result->fetch_assoc()) {
     $image_data = $row['pic'];
     $image_name = $row['image_name'];
     $ext=strpos($image_name,".",0);
     $file_extention=trim(substr($image_name,$ext+1));

   }
     
    header("Content-type:image/$file_extention");
    echo $image_data;   

}else if (isset($_GET['sn'])){
  $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $cat_id=$db->real_escape_string($_GET['sn']);
   $result=$db->query("SELECT * FROM music WHERE id='{$cat_id}'");
   while ($row=$result->fetch_assoc()) {
     $image_data = $row['image_data'];
     $image_name = $row['image_name'];
     $ext=strpos($image_name,".",0);
     $file_extention=trim(substr($image_name,$ext+1));

   }
     
    header("Content-type:image/$file_extention");
    echo $image_data;   

}
else if (isset($_GET['cand'])){
  $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $cat_id=$db->real_escape_string($_GET['cand']);
   $result=$db->query("SELECT * FROM vote WHERE id='{$cat_id}'");
   while ($row=$result->fetch_assoc()) {
     $image_data = $row['image_data'];
     $image_name = $row['image_name'];
     $ext=strpos($image_name,".",0);
     $file_extention=trim(substr($image_name,$ext+1));

   }
     
    header("Content-type:image/$file_extention");
    echo $image_data;   

}
?>