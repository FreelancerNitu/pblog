<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');

class SiteOption{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }

  public function allSocial(){
    $select_query = "SELECT * FROM social WHERE sId = '1'";
    $s_result = $this->db->select($select_query);
    return $s_result;
  }

  public function updateLinks($data){
    $tw = $this->fr->validation($data['twitter']);
    $fb= $this->fr->validation($data['facebook']);
    $in = $this->fr->validation($data['instagram']);
    $yt = $this->fr->validation($data['youtube']);
    
    $update_query = "UPDATE social SET twitter = '$tw', facebook = '$fb', instagram = '$in', youtube = '$yt'";
    $update_result = $this->db->update($update_query);
    
    if($update_result){
      $msg = "Socail link updated successfully";
      return $msg;
    }else{
      $msg = "Something was wrong! Socail link not updated";
      return $msg;
    }
  }

  // About us option
  public function aboutInfo(){
    $about_query = "SELECT * FROM about WHERE about_Id = '1'";
    $about_result = $this->db->select($about_query);
    return $about_result;
  }
  
  public function aboutUpdate($data, $file){
      $username = $this->fr->validation($data['username']);
      $user_details = $this->fr->validation($data['user_bio']);
      
      $premited = array('jpg', 'png', 'gif', 'jpeg');
      $file_name = $file['image']['name'];
      $file_size = $file['image']['size'];
      $file_temp = $file['image']['tmp_name'];
    
      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
      $upload_image = "upload/".$unique_image;
      
      if(empty($username) || empty($user_details)){
        $msg = "Username & User Bio is must not be empty";
        return $msg;
      }else{
        if(!empty($file_name)){
          /****** Checking file size getter then 1 MB or Not *******/ 
          if($file_size > 1048567){
            $msg = "File size must be less then 1 mb";
            return $msg;
           }elseif(in_array($file_ext, $premited) == false){
            $msg = "You can upload only:-". implode(', ', $premited);
            return $msg;
           }else{
            move_uploaded_file($file_temp, $upload_image);
            
            $query = "UPDATE about SET username = '$username', image = '$upload_image', user_details = '$user_details' WHERE about_Id = '1'";
            
            $result = $this->db->insert($query);
            
            if($result){
              $msg = "About Us updated successfully";
              return $msg;
            }else{
              $msg = "Something was wrong! About Us not updated. Please try again";
              return $msg;
            }
          }
        }else{
          $query = "UPDATE about SET username = '$username', user_details = '$user_details' WHERE about_Id = '1'";
            
          $result = $this->db->insert($query);
            
            if($result){
              $msg = "About Us updated successfully";
              return $msg;
            }else{
              $msg = "Something was wrong! About Us not updated. Please try again";
              return $msg;
            }
        }
      }
  
    }
    
/**********************************
 * About latest Posts
 ***********************************/

 public function latestPost($offset, $limit){
  $lPost_query = "SELECT post.*, user.username, user.image FROM post INNER JOIN user ON post.userId = user.userId WHERE post.status = '1' ORDER BY post.postId DESC LIMIT $offset, $limit";
  
  $lPost_Result =$this->db->select($lPost_query);
  return $lPost_Result;
}

/**********************************
 * Contact Us function
 ***********************************/
public function addContact($data){
  $name = $this->fr->validation($data['name']);
  $email = $this->fr->validation($data['email']);
  $phone = $this->fr->validation($data['phone']);
  $message = $this->fr->validation($data['message']);
  
  if($name == '' || $email == '' || $phone == '' || $message == ''){
    $msg = 'Field must not be empty!';
    return $msg;
  }else{
    $contct_query = "INSERT INTO contact(name,email,phone,message) VALUES('$name', '$email', '$phone', '$message')";
    $contact_result = $this->db->insert($contct_query);
    
    if($contact_result){
      $msg = 'Message send Successfully!';
      return $msg;
    }else{
      $msg = 'Something was wrong! Message not send';
      return $msg;
    }
  }
}

/******* All Contact Message ********/ 
public function allContact(){
  $select = "SELECT * FROM contact ORDER BY contactId DESC";
  $result = $this->db->select($select);
  return $result;
}

/******* Delete Conatct ********/ 
public function deleteContact($id){
  $dCon_query = "DELETE FROM contact WHERE contactId = '$id'";
  $dCon_result = $this->db->delete($dCon_query);
  if($dCon_result){
    $msg = 'Message Delete Succssfully';
    return $msg;
  }else{
    $msg = 'Something was wrong! Message not delete';
    return $msg;
  }
}
}



?>