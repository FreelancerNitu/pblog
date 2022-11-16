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


class register{
  public $db;
  public $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  
/********** Add User function ***************/ 

  public function addUser($data){

    function sendemail_verify($name, $email, $v_token){
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

      $email_template = "<h2> You have register with Na Shree Nitu</h2>
      <h5>Verify your email address to login, please click the link below</h5>
      <a href='http://localhost/pb/admin/verifi-email.php?token=$v_token'>Click Here</a>";

      $mail->Body = $email_template;
      $mail->send();
      // echo 'Message has been sent';
    }
    
    $name = $this->fr->validation($data['name']);
    $phone = $this->fr->validation($data['phone']);
    $email = $this->fr->validation($data['email']);
    $password = $this->fr->validation(md5($data['password']));
    $v_token = md5(rand());

 

    if(empty($name) || empty($phone) || empty($email) || empty($password)){
      $error = "Field Must Not Be Empty";
      return $error;
    }else{
      $e_query = "SELECT * FROM user WHERE email = '$email'";
      $check_email = $this->db->select($e_query);
  
      if($check_email > '0'){
        $error = "This email is already existes";
        return $error;
        header('Location: register.php');
      }else{
        $insert_query = "INSERT INTO user(username, email, phone, password, v_token) VALUES('$name', '$email', '$phone', '$password', '$v_token')";
        
        $insert_row =$this->db->insert($insert_query);

        if($insert_query){
          sendemail_verify($name, $email, $v_token);
          $success = "Registration Successfull!. Please check your email box for verify email";
          return $success;
        }else{
          echo "Regestration Faild.";
          return $error;
        }
      }
    }
  }
}