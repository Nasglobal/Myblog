<?php
 class Myblog{

 	public function escape($string){
  return htmlentities(trim($string),ENT_QUOTES,'UTF-8');
 	}

	public function add_categories($name){
   $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $name=$db->real_escape_string(ucwords($name));
     $db->query("INSERT INTO categories(name) VALUES ('$name')");
	}

	public function delete_categories($id){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$db->query("DELETE FROM categories WHERE id = '{$id}'");
	}

	public function get_category($id){
		$record=array();
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$result = $db->query("SELECT * FROM categories WHERE id = '{$id}'");
       if($result->num_rows==1){
       $rows=$result->fetch_object();
       $record[]=$rows;
       }
       return $record;
	}
	public function get_image($id){
		$record=array();
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$result = $db->query("SELECT * FROM posts WHERE id = '{$id}'");
       if($result->num_rows){
       while($rows=$result->fetch_object()){
                  $record[]=$rows;
       }
       return $record;
	}

}
	public function update_categories($id,$name1){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $name1=$db->real_escape_string(ucwords($name1));
    $db->query("UPDATE Categories SET name='$name1' WHERE id = '$id' ");
 
	}

	public function view_categories(){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$record=array();
	if($result=$db->query("SELECT * FROM categories")){
		if($result->num_rows){
			while($rows=$result->fetch_object()){
                  $record[]=$rows;
			}
			$result->free();
		}
	}
	return $record;	
	}

	public function add_posts($title,$contents,$category,$image_name,$image_data){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
         $title=$db->real_escape_string($title);
         $contents=$db->real_escape_string($contents);
         $category=$db->real_escape_string((int)$category);
         $image_name=$db->real_escape_string($image_name);
         $image_data=$db->real_escape_string($image_data);
         $db->query("INSERT INTO posts SET cat_id={$category},title='{$title}',contents='{$contents}',date_posted=now(),image_name='{$image_name}',pic='{$image_data}'");
	}
  
public function add_candidate($ccategory,$candidatenum,$cname,$Department,$numvote,$image_name,$image_data){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
         $ccategory=$db->real_escape_string((int)$ccategory);
         $numvote=$db->real_escape_string((int)$numvote);
         $candidatenum=$db->real_escape_string((int)$candidatenum);
         $cname=$db->real_escape_string(ucwords($cname));
         $$Department=$db->real_escape_string($Department);
         $image_name=$db->real_escape_string($image_name);
         $image_data=$db->real_escape_string($image_data);
         $db->query("INSERT INTO vote SET category={$ccategory},candidatenum={$candidatenum},cname='{$cname}',department='{$Department}',numvote={$numvote},image_name='{$image_name}',image_data ='{$image_data}'");
  }
  public function view_candidate($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $record=array();
    $query="SELECT * FROM vote WHERE category={$id}";
   $result=$db->query($query);
      while($rows=$result->fetch_object()){
                  $record[]=$rows;  
  }
  return $record; 
  }

public function upload_music($title,$content,$music_name,$image_name,$image_data){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
         $title=$db->real_escape_string($title);
         $music_name=$db->real_escape_string($music_name);
         $image_name=$db->real_escape_string($image_name);
         $image_data=$db->real_escape_string($image_data);
         $db->query("INSERT INTO music SET title='{$title}',content='{$content}',music_name='{$music_name}',image_name='{$image_name}',image_data='{$image_data}',date_posted=now()");
  }
  public function upload_video($title,$content,$video_name,$image_name,$image_data){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
         $title=$db->real_escape_string($title);
         $video_name=$db->real_escape_string($video_name);
         $image_name=$db->real_escape_string($image_name);
         $image_data=$db->real_escape_string($image_data);
         $db->query("INSERT INTO video SET title='{$title}',content='{$content}',video_name='{$video_name}',image_name='{$image_name}',image_data='{$image_data}',date_posted=now()");
  }
	public function edit_posts($id,$title,$contents,$category,$image_name,$image_data){
     $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
      $title=$db->real_escape_string($title);
         $contents=$db->real_escape_string($contents);
         $category=$db->real_escape_string((int)$category);
         $id=$db->real_escape_string((int)$id);
         $image_name=$db->real_escape_string($image_name);
         $image_data=$db->real_escape_string($image_data);
         $db->query("UPDATE posts SET cat_id={$category},title='{$title}',contents='{$contents}',date_posted=now(),image_name='{$image_name}',pic='{$image_data}' WHERE id = {$id}");
	}

	public function delete_post_by_category($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $db->query("DELETE FROM posts WHERE cat_id='{$id}'");
	}

	public function delete_post_by_id($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $db->query("DELETE FROM posts WHERE id='{$id}'");
	}
   public function delete_music_by_id($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $db->query("DELETE FROM music WHERE id='{$id}'");
  }

	public function view_posts($id=null,$cat_id=null){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $record=array();
    $query="SELECT posts.id AS 'posts_id',categories.id AS 'categories_id',title,contents,date_posted,categories.name FROM posts INNER JOIN Categories ON categories.id = posts.cat_id";
	if(isset($id)){
     $id=(int)$id;
     $query.= " WHERE posts.cat_id = {$id}";
	}else if(isset($cat_id)){
     $cat_id=(int)$cat_id;
     $query.= " WHERE posts.id = {$cat_id}";}
      
	$query.= " ORDER BY posts.id DESC LIMIT 20";
	 $result=$db->query($query);
			while($rows=$result->fetch_object()){
                  $record[]=$rows;	
	}
	return $record;	
	}
public function view_by_search($search){
$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$search=$db->real_escape_string($search);
    $record=array();

$query="SELECT * FROM posts WHERE title LIKE '%$search%' ";
$result=$db->query($query);
if($result->num_rows>=1){
			while($rows=$result->fetch_object()){
                  $record[]=$rows;	
	}
	return $record;	
}
}
public function viewmusic_by_search($search){
$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$search=$db->real_escape_string($search);
    $record=array();  
$query="SELECT * FROM music WHERE title LIKE '%{$search}%' ";
$result=$db->query($query);
if($result->num_rows>=1){
      while($rows=$result->fetch_object()){
                  $record[]=$rows;  
  }
  return $record; 
}
}
public function num_of_totalpage($rowsperpage){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $query="SELECT count(*) FROM posts";
   $result=$db->query($query);
   $r=$result->fetch_row();
   $numrows=$r[0];//how many rows in posts table
    $totalpage=ceil($numrows/$rowsperpage);
    return $totalpage;
     }

    
    public function view_by_pagination($offset,$rowsperpage){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $record=array();
    $query="SELECT posts.id AS 'posts_id',categories.id AS 'categories_id',title,contents,date_posted,categories.name FROM posts INNER JOIN Categories ON categories.id = posts.cat_id ORDER BY posts.id DESC LIMIT $offset,$rowsperpage ";
    $result=$db->query($query);
    while($rows=$result->fetch_object()){
                  $record[]=$rows;	
	}

	
	return $record;	
	}



	public function categories_exist1($field){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$field=$db->real_escape_string($field);
		$field=(int)$field;
      $query=$db->query("SELECT * FROM categories where  id= {$field} ");
      return ($query->num_rows==0) ? true : false;
	}
	public function categories_exist2($field){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$field=$db->real_escape_string($field);
      $query=$db->query("SELECT * FROM categories where  name= '{$field}' ");
      return ($query->num_rows==0) ? false : true;
	}

public function single_next($id=null,$id2=null){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $next=0;
    if(isset($id)){
    $query="SELECT * FROM posts WHERE id>$id ORDER BY id LIMIT 1";
    }else if(isset($id2)){
    $query="SELECT * FROM posts WHERE id<$id2 ORDER BY id DESC LIMIT 1";	
    }
	 $result=$db->query($query);
	$row=$result->fetch_assoc();
       $next=$row['id'];
	return $next;
}
public function next1($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $next=false;
    $query="SELECT * FROM posts WHERE id>$id ORDER BY id LIMIT 1";
	 $result=$db->query($query);
	 if($result->num_rows>0){
	$next=true;
	}else{
		$next=false;
	}
	return $next;
}
public function next2($id2){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $next=false;
    $query="SELECT * FROM posts WHERE id<$id2 ORDER BY id DESC LIMIT 1";	
	 $result=$db->query($query);
	 if($result->num_rows>0){
	$next=true;
	}else{
		$next=false;
	}
	return $next;
}
function date_posted($date){
  $real="";
  $date1=strtotime($date);

  $before=date(" Y",$date1) ;
  $now=date("Y");
 $year=$now-$before;
if($year>0){
  $real=$year." years ago";
}else{
  $montbefore=date("m",$date1) ;
$montnow=date("m") ;
$month=$montnow-$montbefore;
if($month>0 && $month==1){
  $real=$month." month ago";
}else if($month>1){
  $real=$month." months ago";
}
else{
  $daybefore=date("d",$date1) ;
$daynow=date("d") ;
$day=$daynow-$daybefore;
if($day>0 && $day==1){
  $real=$day." day ago";
}else if($day>1){
 $real=$day." days ago";
}else if($day==0){
$hrbefore=date("H",$date1) ;
$hrnow=date("H") ;
$hr=$hrnow-($hrbefore+1);
if($hr>0 && $hr==1){
  $real=$hr." hour ago";
}else if($hr>1){
  $real=$hr." hours ago";
}else if($hr==0){
$minbefore=date("i",$date1) ;
$minnow=date("i") ;
$min=$minnow-$minbefore;
if($min>0 && $min==1){
  $real=$min." minute ago";
}else if($min>1){
  $real=$min." minutes ago";
}else if($min<1){
	$real="Just now";
}
}}}} 
return $real;
}


public function add_comments($post_id,$comment,$name,$likes,$dislikes){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $record=array();
         $post_id=$db->real_escape_string($post_id);
         $comment=$db->real_escape_string($comment);
         $name=$db->real_escape_string($name);
         $likes=$db->real_escape_string((int)$likes);
         $dislikes=$db->real_escape_string((int)$dislikes);
        $db->query("INSERT INTO comments SET post_id={$post_id},comment='{$comment}',name='{$name}',likes={$likes},dislikes={$dislikes},date_commented=now() ");
         $last_id = $db->insert_id;
         $result=$db->query("SELECT * FROM comments WHERE id={$last_id}");
        $row=$result->fetch_object();
        $record[]=$row;
       return $record;	
}


public function view_comments($post_id){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$record=array();
	if($result=$db->query("SELECT * FROM comments WHERE post_id=$post_id")){
		if($result->num_rows){
			while($rows=$result->fetch_object()){
                  $record[]=$rows;
			}
		}
	}
	return $record;	
	}
	public function add_reply($comment_id,$post_id,$rname,$reply,$likes,$dislikes){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $record=array();
         $comment_id=$db->real_escape_string($comment_id);
         $post_id=$db->real_escape_string($post_id);
         $reply=$db->real_escape_string($reply);
         $rname=$db->real_escape_string($rname);
         $likes=$db->real_escape_string((int)$likes);
         $dislikes=$db->real_escape_string((int)$dislikes);
        $db->query("INSERT INTO reply SET comment_id={$comment_id},post_id={$post_id},replys='{$reply}',rname='{$rname}',replylikes={$likes},replydislikes={$dislikes},date_replied=now()");
         
}


public function view_reply($post_id){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$record=array();
	if($result=$db->query("SELECT * FROM reply WHERE comment_id=$post_id")){
		if($result->num_rows){
			while($rows=$result->fetch_object()){
                  $record[]=$rows;
			}
		}
	}
	return $record;	
	}
public function view_comments1($post_id){
		$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$record=array();
	if($result=$db->query("SELECT * FROM comments WHERE id=$post_id")){
		if($result->num_rows){
			while($rows=$result->fetch_object()){
                  $record[]=$rows;
			}
		}
	}
	return $record;	
	}


	public function update_likes($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $id=(int)$id;
    $result=$db->query("SELECT likes FROM comments WHERE id= '$id' ");
    $row=$result->fetch_row();
    $like=$row[0] + 1;
    $db->query("UPDATE comments SET likes={$like} WHERE id= '$id' ");
    $result1=$db->query("SELECT likes FROM comments WHERE id= '$id' ");
    $ro=$result1->fetch_row();
      return $ro[0];
	}

	public function update_dislikes($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $id=(int)$id;
    $result=$db->query("SELECT dislikes FROM comments WHERE id= '$id' ");
    $row=$result->fetch_row();
    $dislike=$row[0] + 1;
    $db->query("UPDATE comments SET dislikes={$dislike} WHERE id= '$id' ");
    $result1=$db->query("SELECT dislikes FROM comments WHERE id= '$id' ");
    $ro=$result1->fetch_row();
      return $ro[0];
	}

	public function update_rlikes($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $id=(int)$id;
    $result=$db->query("SELECT replylikes FROM reply WHERE id= '$id' ");
    $row=$result->fetch_row();
    $like=$row[0] + 1;
    $db->query("UPDATE reply SET replylikes={$like} WHERE id= '$id' ");
    $result1=$db->query("SELECT replylikes FROM reply WHERE id= '$id' ");
    $ro=$result1->fetch_row();
      return $ro[0];
	}

	public function update_rdlikes($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $id=(int)$id;
    $result=$db->query("SELECT replydislikes FROM reply WHERE id= '$id' ");
    $row=$result->fetch_row();
    $dislike=$row[0] + 1;
    $db->query("UPDATE reply SET replydislikes={$dislike} WHERE id= '$id' ");
    $result1=$db->query("SELECT replydislikes FROM reply WHERE id= '$id' ");
    $ro=$result1->fetch_row();
      return $ro[0];
	}

	public function total_comments($comments){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $query="SELECT count(*) FROM comments WHERE comments.post_id={$comments}";
   $result=$db->query($query);
   $r=$result->fetch_row();
   $numrows=$r[0];


   $query="SELECT count(*) FROM reply WHERE reply.post_id={$comments}";
   $result1=$db->query($query);
   $r1=$result1->fetch_row();
   $numrows1=$r1[0];
   $total=$numrows+$numrows1;

    return $total;
     }
     public function view_music($id=null,$idg=null){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $record=array();
    $query="SELECT * FROM music ";
    if(isset($id)){
      $query.=" WHERE id={$id}";
    }
  $query.=" ORDER BY id DESC LIMIT 20";
   $result=$db->query($query);
      while($rows=$result->fetch_object()){
                  $record[]=$rows;  
  }
  return $record; 
  }
  public function view_videos($id=null,$idg=null){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $record=array();
    $query="SELECT * FROM video ";
    if(isset($id)){
      $query.=" WHERE id={$id}";
    }
  $query.=" ORDER BY id DESC LIMIT 20";
   $result=$db->query($query);
      while($rows=$result->fetch_object()){
                  $record[]=$rows;  
  }
  return $record; 
  }
public function update_vote($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $id=(int)$id;
    $result=$db->query("SELECT numvote FROM vote WHERE id= {$id} ");
    $row=$result->fetch_row();
    $numvote=$row[0] + 1;
    $db->query("UPDATE vote SET numvote={$numvote} WHERE id= {$id} ");
    $result1=$db->query("SELECT numvote FROM vote WHERE id= {$id} ");
    $ro=$result1->fetch_row();
      return $ro[0];
  }
  public function update_ipaddress($vote_id,$ip_add){
        $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
         $vote_id=$db->real_escape_string((int)$vote_id);
         $ip_add=$db->real_escape_string($ip_add);
         $db->query("INSERT INTO ip_address SET vote_id={$vote_id},ip_add='{$ip_add}',time_voted=now()");
  }
public function check_ip($ip=null,$ip2=null){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(isset($ip)){
    $result=$db->query("SELECT ip_add FROM ip_address WHERE ip_add='{$ip}' AND vote_id=1");
    return ($result->num_rows==0) ? true: false; 
    }else if(isset($ip2)) {
      $result=$db->query("SELECT ip_add FROM ip_address WHERE ip_add='{$ip2}' AND vote_id=2");
    return ($result->num_rows==0) ? true: false; 
    }
  }
  public function check_votetime($ip=null,$ip2=null){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(isset($ip)){
    $result=$db->query("SELECT time_voted FROM ip_address WHERE ip_add='{$ip}' AND vote_id=1  ORDER BY id DESC" );
    $ro=$result->fetch_row();
      return $ro[0];
  }else if(isset($ip2)) {
    $result=$db->query("SELECT time_voted FROM ip_address WHERE ip_add='{$ip2}' AND vote_id=2  ORDER BY id DESC" );
    $ro=$result->fetch_row();
      return $ro[0];
    }
  }
  public function show_vote($id){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $result1=$db->query("SELECT numvote FROM vote WHERE id= {$id} ");
    $ro=$result1->fetch_row();
      return $ro[0];
  }


   public function viewmusic_by_pagination($offset,$rowsperpage){
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $record=array();
    $query="SELECT * FROM music ORDER BY id DESC LIMIT $offset,$rowsperpage ";
    $result=$db->query($query);
    while($rows=$result->fetch_object()){
                  $record[]=$rows;  
  }

  
  return $record; 
  }
  public function check_password($username,$password){
     $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     $username=$db->real_escape_string($username);
    $password=$db->real_escape_string($password);
    $query = "SELECT username FROM stafflogin where username = '{$username}' AND password = '{$password}' "; 
   $result1=$db->query($query);
   $ro=$result1->fetch_row();
      return $ro[0];
  }

}

?>

