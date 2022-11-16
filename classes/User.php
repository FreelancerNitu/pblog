<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');


class User{
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  
  public function userInfo($id){
    $userQuery = "SELECT * FROM user WHERE userId = '$id'";
    $userResult = $this->db->select($userQuery);
    return $userResult;
  }
  /******* Show Forntend User Bio or Details ******/ 
  public function userBio(){
    $userBQuery = "SELECT * FROM user";
    $userBResult = $this->db->select($userBQuery);
    return $userBResult;
  }

   /****** Show Forntend User Update *******/ 
  public function userUpdate($data, $file, $id){
    $username = $this->fr->validation($data['username']);
    $user_bio = $this->fr->validation($data['user_bio']);
    
    $premited = array('jpg', 'png', 'gif', 'jpeg');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];
  
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
    $upload_image = "upload/".$unique_image;
    
    if(empty($username) || empty($user_bio)){
      $msg = "Username & User Bio is must not be empty";
      return $msg;
    }else{
      if(!empty($file_name)){
        /********  Checking file size getter then 1 MB or Not *******/ 
        if($file_size > 1048567){
          $msg = "File size must be less then 1 mb";
          return $msg;
         }elseif(in_array($file_ext, $premited) == false){
          $msg = "You can upload only:-". implode(', ', $premited);
          return $msg;
         }else{
          move_uploaded_file($file_temp, $upload_image);
          
          $query = "UPDATE user SET username = '$username', image = '$upload_image', user_bio = '$user_bio' WHERE userId = '$id'";
          
          $result = $this->db->insert($query);
          
          if($result){
            $msg = "Profile updated successfully";
            return $msg;
          }else{
            $msg = "Something was wrong! Profile not updated. Please try again";
            return $msg;
          }
        }
      }else{
        $query = "UPDATE user SET username = '$username', user_bio = '$user_bio' WHERE userId = '$id'";
          
        $result = $this->db->insert($query);
          
          if($result){
            $msg = "Profile updated successfully";
            return $msg;
          }else{
            $msg = "Something was wrong! Profile not updated. Please try again";
            return $msg;
          }
      }
    }
  
  }
  
  /********************************
 *  Frontend single post by id
 *********************************/
 public function userDetails(){
  $userq = "SELECT * FROM user WHERE user.image = '$image', user.user_bio = '$user_bio'";
  
  $userResult = $this->db->select($userq);
  return $userResult;
  
}
  
/*******  Index Page total user showing on dashboard ********/ 
public function totalUser(){
  $total_query = "SELECT * FROM user";
  $total_result = $this->db->select($total_query);
  return $total_result;
}

}

?>