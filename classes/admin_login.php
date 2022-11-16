<?php

include_once('../libery/session.php');
Session::loginCheck();
include_once('../libery/Database.php');
include_once('../helpers/Format.php');

class adminLogin{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
   // Login user function
  public function LoginUser($email, $password){
    $email = $this->fr->validation($email);
    $password = $this->fr->validation($password);
    
    if(empty($email) || empty($password)){
      $error = "Field must be not empty";
      return $error;
    }else{
      $select = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
      $result = $this->db->select($select);
      
    if(!empty($result) && $result !== true){
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        
        if($row['v_status'] == 1){
          Session::set('login', true);
          Session::set('username', $row['username']);
          Session::set('userId', $row['userId']);
          Session::set('userImage', $row['image']);
          header('Location: index.php');
        }else{
          $error = "Please first verifi your email";
          return $error;
        }
      }else{
        $error = "This email alredy exists";
        return $error;
      }
    }else{
      $error = "Invalid email or password";
      return $error;
    }
    
  }
  
}

}










?>