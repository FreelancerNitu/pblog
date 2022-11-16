<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');

class SiteLogo{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }

  public function sitelogo(){
    $select_query = "SELECT * FROM logo WHERE logoId = '1'";
    $select_result = $this->db->select($select_query);
    return $select_result;
  }

  public function updateLogo($data){
    $logo = $this->fr->validation($data['logo']);
    
    $update_logo = "UPDATE logo SET logoName = '$logo'";
    $update_result = $this->db->update($update_logo);
    
    if($update_result){
      $msg = "Logo updated successfully";
      return $msg;
    }else{
      $msg = "Something was wrong! Logo not updated";
      return $msg;
    }
  }

}


?>