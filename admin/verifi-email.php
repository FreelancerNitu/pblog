<?php

include_once('../libery/Database.php');
include_once('../libery/session.php');
Session::init();

$db = new Database();

if(isset($_GET['token'])){
  $token = $_GET['token'];
  $query = "SELECT v_token, v_status FROM user WHERE v_token='$token'";
  $result = $db->select($query);

  if($result != false){
    $row = mysqli_fetch_assoc($result);
    if($row['v_status'] == 0){
      $click_token = $row['v_token'];
      
      $update_status = "UPDATE user SET v_status = '1' WHERE v_token='$click_token'";

      $update_result = $db->update($update_status);
      
      if($update_result){
        $_SESSION['status'] = "Your account has been Varified Successfully";
        header('Location: login.php');
      }else{
        $_SESSION['status'] = "Varification Field";
        header('Location: login.php');
      }
    }else{
      $_SESSION['status'] = "This email alredy Varified, Please login";
      header('Location: login.php');
    }
  }else{
    $_SESSION['status'] = "This token does not exists";
    header('Location: login.php');
  }
}else{
  $_SESSION['status']  = "Not Allowed";
  header('Location: login.php');
}


?>