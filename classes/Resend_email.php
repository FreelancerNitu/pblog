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


class ResendEmail{
  
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  public function resendEmail($email){
    
 function resend_email_varifi($name, $email, $v_token){
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
      $mail->Subject = 'Email Varification for Na Shree Nitu';

      $email_template = "
      <h2> You have register with Na Shree Nitu</h2>
      <h5>Verify your email address to login, please click the link below</h5>
      <a href='http://localhost/pb/admin/verifi-email.php?token=$v_token'>Click Here</a>";

      $mail->Body = $email_template;
      $mail->send();
      echo 'Message has been sent';
    }
    // Email validation
    $email = $this->fr->validation($email);
    $email = mysqli_real_escape_string($this->db->link, $email);
    
    if(empty($email)){
      $error = "Email fild must not be empty";
      return $error;
    }else{
      $checkEmail = "SELECT * FROM user WHERE email='$email'";
      $emailResult = $this->db->select($checkEmail);
      
      if(mysqli_num_rows($emailResult) > 0){
        $row =mysqli_fetch_assoc($emailResult);
        
        if($row['v_status'] == 0){
          $name = $row['username'];
          $email = $row['email'];
          $v_token = $row['v_token'];
          
          resend_email_varifi($name, $email, $v_token);
          $success = "Varifiction email link has been sent your email";
          return $success;
        }else{
          $error = "Your email alredy varified, Please login";
          return $error;
        }
      }else{
        $error = "This email is not register, Please register first your email";
        return $error;
      }
    }
  }
}

?>