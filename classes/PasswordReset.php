<?php

include_once('../libery/Database.php');
include_once('../helpers/Format.php');

 // Php Mailer
 include_once('../phpMailer/PHPMailer.php');
 include_once('../phpMailer/SMTP.php');
 include_once('../phpMailer/Exception.php');

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;


class PasswordReset{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  
  public function PasswordReset($email){
    
    function send_password_reset($name, $email, $v_token){
      $mail = new PHPMailer(true);
      $mail->isSMTP(); 
      $mail->SMTPAuth   = true; 

      $mail->Host       = 'smtp.gmail.com';   
      $mail->Username   = 'shreenitu01@gmail.com';                   
      $mail->Password   = 'Nitu Barmon1';
      
      $mail->SMTPSecure = 'tls';   
      $mail->Port       = 587;   
      
      $mail->setFrom('shreenitu01@gmail.com', $name);
      $mail->addAddress($email);  

      $mail->isHTML(true);    
      $mail->Subject = 'Password Reset with Na Shree Nitu';

      $email_template ="<h2> You have register with Na Shree Nitu</h2>
      <h5>Reset your password easy away, please click the link below</h5>
      <a href='http://localhost/pb/admin/password_change.php?token=$v_token&email=$email'>Click Here</a>";

      $mail->Body = $email_template;
      $mail->send();
      echo 'Message has been sent';
    }
    
    
    $email = $this->fr->validation($email);
    $v_token = md5(rand());
    
    if(empty($email)){
      $error = "Email Fild must not be emoty!";
      return $error;
    }else{
      $check_email = "SELECT * FROM user WHERE email='$email'";
      $email_result = $this->db->select($check_email);
      
      // Checking email database ase ki na
      if(mysqli_num_rows($email_result) > 0){
        $row = mysqli_fetch_assoc($email_result);
        
        // Update token, name
        $name = $row['username'];
        $email= $row['email'];
        $query = "UPDATE user SET v_token='$v_token' WHERE email='$email' LIMIT 1";
        
        $update_token = $this->db->update($query);
        
        if($update_token){
          send_password_reset($name, $email, $v_token);
          $success = "Password reset email Link send in your email";
          return $success;
        }else{
          $error = "Something was wrong! Token was not updated";
          return $error;
        }
        
      }else{
        $error = "Email not found";
        return $error;
      }
    }
  }
}

?>