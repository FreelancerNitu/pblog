<?php
include_once('../libery/session.php');
include_once('../libery/Database.php');
include_once('../helpers/Format.php');

class changePassword{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  /*****************************
   * Change password function
   ****************************/
  public function changePass($data){
    $email = $this->fr->validation($data['email']);
    $newPassword = $this->fr->validation(md5($data['npassword']));
    $cpassword = $this->fr->validation(md5($data['cpassword']));
    $token = $this->fr->validation($data['token']);
    
    if(!empty($token)){
      if(!empty($email) || !empty($newPassword) || !empty($cpassword)){
        $token_query = "SELECT v_token FROM user WHERE v_token='$token'";
        $token_resqult = $this->db->select($token_query);
        
        if(!empty($token_resqult) && $token_resqult !== true){
          if(mysqli_num_rows ($token_resqult) > 0){
            if($newPassword == $cpassword){
              $update_password = "UPDATE user SET password='$newPassword' WHERE v_token='$token'";
              $update_result = $this->db->update($update_password);
              
             if($update_result){
              $new_token = md5(rand());
              $up_token = "UPDATE user SET v_token='$new_token' WHERE v_token='$token'";
              $newT_result = $this->db->update($up_token);
              
              $success = "Password Change Successfully! Congratulations!!";
              return $success;
             }else{
              $error = "Password not Change. Please try again and check everything carefully";
              return $error;
             }
            }else{
              $error = "Password not match";
              return $error;
            }
          }else{
            $error = "Invalied token";
            return $error;
          }
        }else{
          $error = "Invalied token";
          return $error;
        }
      
      }else{
        $error = "Token is not avaliable";
        return $error;
      }
    }else{
      $error = "Fild must not be empty";
      return $error;
    }
  }
  
  
}



?>