<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');


class Comment{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  /************************
   * Add comment function
   ************************/
  public function addComment($data){
    $userId = $this->fr->validation($data['userId']);
    $postId = $this->fr->validation($data['postId']);
    $name = $this->fr->validation($data['name']);
    $email = $this->fr->validation($data['email']);
    $website = $this->fr->validation($data['website']);
    $message = $this->fr->validation($data['message']);
    
    if($name == '' || $email == '' || $message == ''){
      $msg = "Field must be not empty";
      return $msg;
    }else{
      $insert_cmt = "INSERT INTO `comments`(`userId`, `postId`, `name`,`email`, `website`, `message`) VALUES ('$userId','$postId', '$name', '$email', '$website', '$message')";
      
      $result = $this->db->insert($insert_cmt);
      
      if($result){
        $msg = "Comment Success";
        return $msg;
      }
    }
  }
  
  /***************************
   * All Comments function
   * *************************/ 
  public function allComment($id){
    $select_cmt = "SELECT comments.*, post.postId, user.username, user.image FROM comments INNER JOIN post ON comments.postId = post.postId INNER JOIN user ON comments.userId = user.userId WHERE comments.postId = '$id' AND comments.status = '1'";
    
    $select_result = $this->db->select($select_cmt);
    return $select_result;
  }

  
  /**************************
   * Admin comment function
   *************************/ 
  public function adminComment($id){
    $admin_cmt = "SELECT comments.*, user.userId FROM comments INNER JOIN user ON comments.userId = user.userId WHERE comments.userId = '$id'";
    $result = $this->db->select($admin_cmt);
    return $result;
  }
  
  /*****************************
  * Comment Active function
  *****************************/
 public function activeComment($activeId){
  $activeQuery = "UPDATE comments SET status = '0' WHERE cmtId = '$activeId'";
  $activeResult = $this->db->update($activeQuery);
  
  if($activeResult){
    $msg = "Comment Deactive";
    return $msg;
  }
}
 
/******************************
 * Comment Deactive function
 *****************************/
 public function deactiveComment($deactiveId){
   $deactiveQuery = "UPDATE comments SET status = '1' WHERE cmtId = '$deactiveId'";
   $deactiveResult = $this->db->update($deactiveQuery);
   
   if($deactiveResult){
     $msg = "Comment Active & Show";
     return $msg;
   }
 }
 
 /**************************************
 * Select comment for update and replay
 **************************************/
 public function commentSelect($id){
   $select_cmt = "SELECT * FROM comments WHERE cmtId = '$id'";
   $select_result = $this->db->select($select_cmt);
   return $select_result;
 }
 
 /*********************************
  * Admin Comment replay function
 *********************************/ 
 public function AddReplay($replay, $id){
   $replay = $this->fr->validation($replay);
   $update_date = date("M d, Y");
   
   if(empty($replay)){
     $msg = "Replay field must be Required";
     return $msg;
   }else{
     $update = "UPDATE comments SET admin_replay = '$replay', update_date = '$update_date' WHERE cmtId ='$id'";
     $update_result = $this->db->update($update );
     
     if($update_result){
       $msg = "Replay Success";
       return $msg;
     }else{
      $msg = "Replay Faild";
      return $msg;
     }
   }
 }
 /*********************************
  * For Delete comment function
 *********************************/

 public function deleteCmt($id){
   $delete_query = "DELETE FROM comments WHERE cmtId = '$id'";
   $del_result = $this->db->delete($delete_query);
   if($del_result){
    $msg = "Comment delete successfully";
    return $msg;
   }else{
    $msg = "Comment not delete";
    return $msg;
   }
 }
 
/**************************************************
  * Index Page total Comments showing on dashboard
***************************************************/
public function totalComments(){
  $total_query = "SELECT * FROM comments";
  $total_result = $this->db->select($total_query);
  return $total_result;
}

 
}
?>