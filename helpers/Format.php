<?php 

class format{
  
  /*****************************
   * Validation function
   ****************************/
  public function validation($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
  }
   /*****************************
   * Text shorten function 
   ****************************/
  public function textShorten($text, $limit=400){
    $text = $text." ";
    $text = substr($text, 0, $limit);
    $text = $text . "...";
    return $text;
  }
  /*****************************
   * For time and date format
   ****************************/
  public function formateDate($data){
    return date(" M d, Y", strtotime($data));
  }
  
}

?>