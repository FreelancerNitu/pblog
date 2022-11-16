<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');

class Post{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  
  /*****************************
  *   Add post function 
  ******************************/
  public function addPost($data, $file){
   $userId = $this->fr->validation($data['userId']);
   $title = $this->fr->validation($data['title']);
   $catId = $this->fr->validation($data['catId']);
   $disOne = $this->fr->validation($data['disOne']);
   $disTwo = $this->fr->validation($data['disTwo']);
   $postType = $this->fr->validation($data['postType']);
   $tags = $this->fr->validation($data['tags']);
   
  //  For image one
   $premited = array('jpg', 'png', 'gif', 'jpeg');
   $file_name = $file['imageOne']['name'];
   $file_size = $file['imageOne']['size'];
   $file_temp = $file['imageOne']['tmp_name'];
   
   $div = explode('.', $file_name);
   $file_ext = strtolower(end($div));
   $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
   $upload_image = "upload/".$unique_image;
   
  
   
  //  For Image Two
   $premitedTwo = array('jpg', 'png', 'gif', 'jpeg');
   $file_name_two = $file['imageTwo']['name'];
   $file_size_two = $file['imageTwo']['size'];
   $file_temp_two = $file['imageTwo']['tmp_name'];
   
   $div_two = explode('.', $file_name_two);
   $file_ext_two = strtolower(end($div_two));
   $unique_image_two = substr(md5(rand().time()), 0, 10).'.'. $file_ext_two;
   $upload_image_two = "upload/".$unique_image_two;
 
 $premited = array('jpg', 'png', 'gif', 'jpeg');
 $file_name = $file['imageOne']['name'];
 $file_size = $file['imageOne']['size'];
 $file_temp = $file['imageOne']['tmp_name'];
 
 $div = explode('.', $file_name);
 $file_ext = strtolower(end($div));
 $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
 $upload_image = "upload/".$unique_image;
 
 if(empty('title') || empty('catId') || empty('disOne')  || empty('disTwo') || empty('postType') || empty('tags')){
  $msg = "Fild must not be empty";
  return $msg;
}else{
  if(!empty($file_name) || !empty($file_name_two)){
    if($file_size > 1048567){
      $msg = "File size must be less then 1 mb";
      return $msg;
     }elseif($file_size_two > 1048567){
      $msg = "File size must be less then 1 mb";
      return $msg;
     }elseif(in_array($file_ext, $premited) == false){
      $msg = "You can upload only:-". implode(', ', $premited);
      return $msg;
     }elseif(in_array($file_ext_two, $premited) == false){
      $msg = "You can upload only:-". implode(', ', $premited);
      return $msg;
     }else{
      move_uploaded_file($file_temp, $upload_image);
      move_uploaded_file($file_temp_two, $upload_image_two);
      
      $query = "INSERT INTO `post` (`userId`, `title`, `catId`, `imageOne`, `disOne`, `imageTwo`, `disTwo`, `postType`, `tags`) VALUES ('$userId', '$title', '$catId', '$upload_image', '$disOne', '$upload_image_two', '$disTwo', '$postType', '$tags')";
      
      $result = $this->db->insert($query);
      
      if($result){
        $msg = "Post Insert successfully";
        return $msg;
      }else{
        $msg = "Something was wrong! Post not Insert. Please try again";
        return $msg;
      }
    }
  }
}
}
/*****************************
 *   Select all post 
 *****************************/  
 public function GetAllPost($id){
   $getAllPost = "SELECT post.*, category.catName, user.userId FROM post INNER JOIN category ON post.catId = category.catId INNER JOIN user ON post.userId = user.userId WHERE user.userId = '$id'";
   $getAllPostResult = $this->db->select($getAllPost);
   return $getAllPostResult;
 }
/*******************************
 * For quick view model
 ******************************/  
 public function modelData(){
   $modeldata = "SELECT post.*, category.catName FROM post INNER JOIN category ON post.catId = category.catId";
   $modelResult = $this->db->select($modeldata);
   return $modelResult;
 }
 
/***************************************
 *      Post for edit
 ***************************************/
 public function getPostForEdit($id){
   $get_query = "SELECT * FROM post WHERE postId = '$id'";
   $get_result = $this->db->select($get_query);
   return $get_result;
 }
 
 public function EditPost($data, $file, $id){
  $title = $this->fr->validation($data['title']);
  $catId = $this->fr->validation($data['catId']);
  $disOne = $this->fr->validation($data['disOne']);
  $disTwo = $this->fr->validation($data['disTwo']);
  $postType = $this->fr->validation($data['postType']);
  $tags = $this->fr->validation($data['tags']);
  
 //  For image one
  $premited = array('jpg', 'png', 'gif', 'jpeg');
  $file_name = $file['imageOne']['name'];
  $file_size = $file['imageOne']['size'];
  $file_temp = $file['imageOne']['tmp_name'];
  
  $div = explode('.', $file_name);
  $file_ext = strtolower(end($div));
  $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
  $upload_image = "upload/".$unique_image;
  
 
  
 //  For Image Two
  $premitedTwo = array('jpg', 'png', 'gif', 'jpeg');
  $file_name_two = $file['imageTwo']['name'];
  $file_size_two = $file['imageTwo']['size'];
  $file_temp_two = $file['imageTwo']['tmp_name'];
  
  $div_two = explode('.', $file_name_two);
  $file_ext_two = strtolower(end($div_two));
  $unique_image_two = substr(md5(rand().time()), 0, 10).'.'. $file_ext_two;
  $upload_image_two = "upload/".$unique_image_two;


  if(empty('title') || empty('catId') || empty('disOne')  || empty('disTwo') || empty('postType') || empty('tags')){
    $msg = "Fild must not be empty";
    return $msg;
  }else{
    if(!empty($file_name) || !empty($file_name_two)){
      if($file_size > 1048567){
        $msg = "File size must be less then 1 mb";
        return $msg;
       }elseif($file_size_two > 1048567){
        $msg = "File size must be less then 1 mb";
        return $msg;
       }elseif(in_array($file_ext, $premited) == false){
        $msg = "You can upload only:-". implode(', ', $premited);
        return $msg;
       }elseif(in_array($file_ext_two, $premited) == false){
        $msg = "You can upload only:-". implode(', ', $premited);
        return $msg;
       }else{
        move_uploaded_file($file_temp, $upload_image);
        move_uploaded_file($file_temp_two, $upload_image_two);
        
        $query = "UPDATE `post` SET `title`='$title',`catId`='$catId',`imageOne`='$upload_image',`disOne`='$disOne',`imageTwo``='$upload_image_two',`disTwo`='$disTwo',`postType`='$postType',`tags`='$tags' WHERE postId = '$id'";
        
        $result = $this->db->insert($query);
        
        if($result){
          $msg = "Post updated successfully";
          return $msg;
        }else{
          $msg = "Something was wrong! Post not updated. Please try again";
          return $msg;
        }
      }
      }else{
        $query = "UPDATE `post` SET `title`='$title',`catId`='$catId', `disOne`='$disOne',`disTwo`='$disTwo',`postType`='$postType',`tags`='$tags' WHERE postId = '$id'";
        
        $result = $this->db->insert($query);
        
        if($result){
          $msg = "Post updated successfully";
          return $msg;
        }else{
          $msg = "Something was wrong! Post not updated. Please try again";
          return $msg;
        }
    }
  }
  
 }
 
/******************************
 *  Delete Post Function
 ******************************/  
 public function deletepost($id){
   $img_query = "SELECT * FROM post WHERE postId = '$id'";
   $img_result = $this->db->select($img_query);
   
   if($img_result){
     while($img= mysqli_fetch_assoc($img_result)){
       $imgOne = $img['imageOne'];
       unlink($imgOne);
       $imgTwo = $img['imageTwo'];
       unlink($imgTwo);
     }
   }
   $delete_query = "DELETE FROM post WHERE postId = '$id'";
   $delete_result =$this->db->delete($delete_query);
   if($delete_result){
    $msg = "Post Deleted Successfully";
    return $msg;
   }else{
    $msg = "Something was Wrong! Post not Deleted";
    return $msg;
   }
 }
 
 /*****************************
  *Active post function
  *****************************/
 public function activePost($activeId){
  $activeQuery = "UPDATE post SET status = '0' WHERE postId = '$activeId'";
  $activeResult = $this->db->update($activeQuery);
  
  if($activeResult){
    $msg = "Post Deactive";
    return $msg;
  }
}
 
/******************************
 * Deactive post function
 ******************************/
 public function deactivePost($deactiveId){
   $deactiveQuery = "UPDATE post SET status = '1' WHERE postId = '$deactiveId'";
   $deactiveResult = $this->db->update($deactiveQuery);
   
   if($deactiveResult){
     $msg = "Post Active";
     return $msg;
   }
 }
 /**********************************
 * Function latest Posts
 ***********************************/

 public function latestPost($offset, $limit){
   $lPost_query = "SELECT post.*, user.username, user.image FROM post INNER JOIN user ON post.userId = user.userId WHERE post.status = '1' ORDER BY post.postId DESC LIMIT $offset, $limit";
   
   $lPost_Result =$this->db->select($lPost_query);
   return $lPost_Result;
 }
 
 /********************************
 *  Frontend single post by id
 *********************************/
 public function singlePost($id){
   $SinglePostQuery = "SELECT post.*, user.username, user.image, category.catName FROM post INNER JOIN user ON post.userId = user.userId INNER JOIN category ON post.catId = category.catId WHERE post.postId = '$id'";
   
   $SiglePostResult = $this->db->select($SinglePostQuery);
   return $SiglePostResult;
   
 }
 /******************************
 * Show post sidebar
 *******************************/
 
 public function popularPost(){
   $P_query = "SELECT * FROM post ORDER BY postId DESC LIMIT 3";
   $P_result = $this->db->select($P_query);
   return $P_result;
 }
 /**********************************************
 * Show post number(0,1,2,3,4 etc) in categoty
 ***********************************************/

 public function catNum($id){
   $ct_query = "SELECT * FROM post WHERE post.catId = '$id'";
   $ct_result = $this->db->select($ct_query);
   return $ct_result;
 }
 
/******************************
 * Slider Post
 *******************************/
public function sliderPost(){
  $slider_query = "SELECT post.*, category.catName, user.image, user.username FROM post INNER JOIN category ON post.catId = category.catId INNER JOIN user ON post.userId = user.userId WHERE postType = 2 AND status = 1"; 
  
  $slider_result = $this->db->select($slider_query);
  return $slider_result;
}

 /******************************
 * Search Function
 *******************************/
 public function searchPost($id){
   $search_query = "SELECT post.*, user.image, user.username FROM post INNER JOIN user ON post.userId = user.userId WHERE post.title LIKE '%$id%'";
   
   $search_result = $this->db->select($search_query);
   return $search_result;
 }
 
 /******************************
 * Pagination Function
 *******************************/
 public function PaginationNum(){
   $pagination_query = "SELECT * FROM post";
   $pagination_result = $this->db->select($pagination_query);
   return $pagination_result;
 }
 
  
 /******************************
 * Related Post Function
 *******************************/
public function relatedPost($id){
  $relatedP_query = "SELECT post.*, category.catName FROM post INNER JOIN category ON post.catId = category.catId WHERE post.catId = '$id' ORDER BY post.postId DESC LIMIT 3";
  
  $relatedP_result = $this->db->select($relatedP_query);
  return $relatedP_result;
}

 /******************************
 * Show category post 
 *******************************/
public function categoryPost($id, $offset, $limit){
  $catpost_query = "SELECT post.*, user.username, user.image, category.catName FROM post INNER JOIN user ON post.userId = user.userId INNER JOIN category ON post.catId = category.catId WHERE post.status = '1' AND post.catId = '$id' ORDER BY post.postId DESC LIMIT $offset, $limit";
   
  $catpost_Result =$this->db->select($catpost_query);
  return $catpost_Result;
}

/********************************************
 * Index Page total post showing on dashboard
 **********************************************/
public function totalPost(){
  $total_query = "SELECT * FROM post";
  $total_result = $this->db->select($total_query);
  return $total_result;
}


}
?>