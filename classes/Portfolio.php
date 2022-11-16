<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');

class Portfolio{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
  
  /*****************************
  *   Add portfolio function 
  ******************************/
  public function addPortfolio($data, $file){
   $userId = $this->fr->validation($data['userId']);
   $ptitle = $this->fr->validation($data['ptitle']);
   $catId = $this->fr->validation($data['catId']);
   $pdisOne = $this->fr->validation($data['pdisOne']);
   $pdisTwo = $this->fr->validation($data['pdisTwo']);
   $tags = $this->fr->validation($data['tags']);
   
  //  For image one
   $premited = array('jpg', 'png', 'gif', 'jpeg');
   $file_name = $file['pimageOne']['name'];
   $file_size = $file['pimageOne']['size'];
   $file_temp = $file['pimageOne']['tmp_name'];
   
   $div = explode('.', $file_name);
   $file_ext = strtolower(end($div));
   $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
   $upload_image = "upload/".$unique_image;
   
  
   
  //  For Image Two
   $premitedTwo = array('jpg', 'png', 'gif', 'jpeg');
   $file_name_two = $file['pimageTwo']['name'];
   $file_size_two = $file['pimageTwo']['size'];
   $file_temp_two = $file['pimageTwo']['tmp_name'];
   
   $div_two = explode('.', $file_name_two);
   $file_ext_two = strtolower(end($div_two));
   $unique_image_two = substr(md5(rand().time()), 0, 10).'.'. $file_ext_two;
   $upload_image_two = "upload/".$unique_image_two;
 
 $premited = array('jpg', 'png', 'gif', 'jpeg');
 $file_name = $file['pimageOne']['name'];
 $file_size = $file['pimageOne']['size'];
 $file_temp = $file['pimageOne']['tmp_name'];
 
 $div = explode('.', $file_name);
 $file_ext = strtolower(end($div));
 $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
 $upload_image = "upload/".$unique_image;
 
 if(empty('ptitle') || empty('catId') || empty('pdisOne')  || empty('pdisTwo') || empty('tags')){
  $msg = "Fild must not be empty";
  return $msg;
}else{
  if(!empty($file_name) || !empty($file_name_two)){
    if($file_size > 1048567){
      $msg = "File size must be less then 1 mb";
      return $msg;
     }elseif($file_size_two > 1048567){
      $msg = "File size must be less then 1 mb";
      return $msg;
     }elseif(in_array($file_ext, $premited) == false){
      $msg = "You can upload only:-". implode(', ', $premited);
      return $msg;
     }elseif(in_array($file_ext_two, $premited) == false){
      $msg = "You can upload only:-". implode(', ', $premited);
      return $msg;
     }else{
      move_uploaded_file($file_temp, $upload_image);
      move_uploaded_file($file_temp_two, $upload_image_two);
      
      $query = "INSERT INTO `portfolio` (`userId`, `ptitle`, `catId`, `pimageOne`, `pdisOne`, `pimageTwo`, `pdisTwo`, `tags`) VALUES ('$userId', '$ptitle', '$catId', '$upload_image', '$pdisOne', '$upload_image_two','$pdisTwo', '$tags')";
      
      $result = $this->db->insert($query);
      
      if($result){
        $msg = "Portfolio Insert successfully";
        return $msg;
      }else{
        $msg = "Something was wrong! Portfolio not Insert. Please try again";
        return $msg;
      }
    }
  }
}
}
/*****************************
 *   Select all portfolio
 *****************************/  
 public function GetAllPortfolio($id){
   $getAllPortfolio = "SELECT portfolio.*, category.catName, user.userId FROM portfolio INNER JOIN category ON portfolio.catId = category.catId INNER JOIN user ON portfolio.userId = user.userId WHERE user.userId = '$id'";
   $getAllPortResult = $this->db->select($getAllPortfolio);
   return $getAllPortResult ;
 }
/*******************************
 * For quick view model
 ******************************/  
 public function modelData(){
   $modeldata = "SELECT portfolio.*, category.catName FROM portfolio INNER JOIN category ON portfolio.catId = category.catId";
   $modelResult = $this->db->select($modeldata);
   return $modelResult;
 }
 
/***************************************
 *      Portfolio for edit
 ***************************************/
 public function getPortForEdit($id){
   $get_query = "SELECT * FROM portfolio WHERE postId = '$id'";
   $get_result = $this->db->select($get_query);
   return $get_result;
 }
 
 public function EditPort($data, $file, $id){
  $ptitle = $this->fr->validation($data['ptitle']);
  $catId = $this->fr->validation($data['catId']);
  $pdisOne = $this->fr->validation($data['pdisOne']);
  $pdisTwo = $this->fr->validation($data['pdisTwo']);
  $tags = $this->fr->validation($data['tags']);
  
 //  For image one
  $premited = array('jpg', 'png', 'gif', 'jpeg');
  $file_name = $file['pimageOne']['name'];
  $file_size = $file['pimageOne']['size'];
  $file_temp = $file['pimageOne']['tmp_name'];
  
  $div = explode('.', $file_name);
  $file_ext = strtolower(end($div));
  $unique_image = substr(md5(time()), 0, 10).'.'. $file_ext;
  $upload_image = "upload/".$unique_image;
  
 
  
 //  For Image Two
  $premitedTwo = array('jpg', 'png', 'gif', 'jpeg');
  $file_name_two = $file['pimageTwo']['name'];
  $file_size_two = $file['pimageTwo']['size'];
  $file_temp_two = $file['pimageTwo']['tmp_name'];
  
  $div_two = explode('.', $file_name_two);
  $file_ext_two = strtolower(end($div_two));
  $unique_image_two = substr(md5(rand().time()), 0, 10).'.'. $file_ext_two;
  $upload_image_two = "upload/".$unique_image_two;


  if(empty('ptitle') || empty('catId') || empty('pdisOne')  || empty('pdisTwo') || empty('tags')){
    $msg = "Fild must not be empty";
    return $msg;
  }else{
    if(!empty($file_name) || !empty($file_name_two)){
      if($file_size > 1048567){
        $msg = "File size must be less then 1 mb";
        return $msg;
       }elseif($file_size_two > 1048567){
        $msg = "File size must be less then 1 mb";
        return $msg;
       }elseif(in_array($file_ext, $premited) == false){
        $msg = "You can upload only:-". implode(', ', $premited);
        return $msg;
       }elseif(in_array($file_ext_two, $premited) == false){
        $msg = "You can upload only:-". implode(', ', $premited);
        return $msg;
       }else{
        move_uploaded_file($file_temp, $upload_image);
        move_uploaded_file($file_temp_two, $upload_image_two);
        
        $query = "UPDATE `portfolio` SET `ptitle`='$title',`catId`='$catId',`pimageOne`='$upload_image',`pdisOne`='$pdisOne',`pimageTwo``='$upload_image_two',`pdisTwo`='$pdisTwo',`tags`='$tags' WHERE postId = '$id'";
        
        $result = $this->db->insert($query);
        
        if($result){
          $msg = "Portfolio updated successfully";
          return $msg;
        }else{
          $msg = "Something was wrong! Portfolio not updated. Please try again";
          return $msg;
        }
      }
      }else{
        $query = "UPDATE `portfolio` SET `ptitle`='$ptitle',`catId`='$catId', `pdisOne`='$pdisOne',`pdisTwo`='$pdisTwo',`tags`='$tags' WHERE postId = '$id'";
        
        $result = $this->db->insert($query);
        
        if($result){
          $msg = "Portfolio updated successfully";
          return $msg;
        }else{
          $msg = "Something was wrong! Portfolio not updated. Please try again";
          return $msg;
        }
    }
  }
  
 }
 
/******************************
 *  Delete Portfolio Function
 ******************************/  
 public function deletePort($id){
   $img_query = "SELECT * FROM portfolio WHERE postId = '$id'";
   $img_result = $this->db->select($img_query);
   
   if($img_result){
     while($img= mysqli_fetch_assoc($img_result)){
       $pimgOne = $img['pimageOne'];
       unlink($pimgOne);
       $pimgTwo = $img['pimageTwo'];
       unlink($pimgTwo);
     }
   }
   $delete_query = "DELETE FROM portfolio WHERE postId = '$id'";
   $delete_result =$this->db->delete($delete_query);
   if($delete_result){
    $msg = "Portfolio Deleted Successfully";
    return $msg;
   }else{
    $msg = "Something was Wrong! Portfolio not Deleted";
    return $msg;
   }
 }
 
 /*****************************
  *Active portfolio function
  *****************************/
 public function activePortfolio($activeId){
  $activeQuery = "UPDATE portfolio SET pStatus = '0' WHERE postId = '$activeId'";
  $activeResult = $this->db->update($activeQuery);
  
  if($activeResult){
    $msg = "Portfolio Deactive";
    return $msg;
  }
}
 
/******************************
 * Deactive portfolio function
 ******************************/
 public function deactivePortfolio($deactiveId){
   $deactiveQuery = "UPDATE portfolio SET pStatus = '1' WHERE postId = '$deactiveId'";
   $deactiveResult = $this->db->update($deactiveQuery);
   
   if($deactiveResult){
     $msg = "Portfolio Active";
     return $msg;
   }
 }
 /**********************************
 * Function latest Portfolio
 ***********************************/

 public function latestPortfolio($offset, $limit){
   $lPort_query = "SELECT portfolio.*, user.username, user.image FROM portfolio INNER JOIN user ON portfolio.userId = user.userId WHERE portfolio.pStatus = '1' ORDER BY portfolio.postId DESC LIMIT $offset, $limit";
   
   $lPort_Result =$this->db->select($lPort_query);
   return $lPort_Result;
 }
 
 /********************************************
 *  Frontend single portfolio by id
 *******************************************/
 public function singlePortfolio($id){
   $SinglePortQuery = "SELECT portfolio.*, user.username, user.image, category.catName FROM portfolio INNER JOIN user ON portfolio.userId = user.userId INNER JOIN category ON portfolio.catId = category.catId WHERE portfolio.postId = '$id'";
   
   $SiglePortResult = $this->db->select($SinglePortQuery);
   return $SiglePortResult;
   
 }
 /******************************
 * Show portsidebar
 *******************************/
 
 public function popularPortfolio(){
   $P_query = "SELECT * FROM portfolio ORDER BY postId DESC LIMIT 3";
   $P_result = $this->db->select($P_query);
   return $P_result;
 }
 /***************************************************
 * Show portfolio number(0,1,2,3,4 etc) in categoty
 ***************************************************/

 public function catName($id){
   $ct_query = "SELECT * FROM portfolio WHERE portfolio.catId = '$id'";
   $ct_result = $this->db->select($ct_query);
   return $ct_result;
 }
 

 /******************************
 * Search Function
 *******************************/
 public function searchPortfolio($id){
   $search_query = "SELECT portfolio.*, user.image, user.username FROM portfolio INNER JOIN user ON portfolio.userId = user.userId WHERE portfolio.ptitle LIKE '%$id%'";
   
   $search_result = $this->db->select($search_query);
   return $search_result;
 }
 
 /******************************
 * Pagination Function
 *******************************/
 public function PaginationNum(){
   $pagination_query = "SELECT * FROM portfolio";
   $pagination_result = $this->db->select($pagination_query);
   return $pagination_result;
 }
 
  
 /******************************
 * Related Portfolio Function
 *******************************/
public function relatedPortfolio($id){
  $relatedP_query = "SELECT portfolio.*, category.catName FROM portfolio INNER JOIN category ON portfolio.catId = category.catId WHERE portfolio.catId = '$id' ORDER BY portfolio.postId DESC LIMIT 3";
  
  $relatedP_result = $this->db->select($relatedP_query);
  return $relatedP_result;
}

 /******************************
 * Show category portfolio 
 *******************************/
public function categoryPort($id, $offset, $limit){
  $catpost_query = "SELECT portfolio.*, user.username, user.image, category.catName FROM portfolio INNER JOIN user ON portfolio.userId = user.userId INNER JOIN category ON portfolio.catId = category.catId WHERE portfolio.pStatus = '1' AND portfolio.catId = '$id' ORDER BY portfolio.postId DESC LIMIT $offset, $limit";
   
  $catpost_Result =$this->db->select($catpost_query);
  return $catpost_Result;
}
/********************************************
 * Index Page total portfolio
 **********************************************/
public function totalPort(){
  $total_query = "SELECT * FROM portfolio";
  $total_result = $this->db->select($total_query);
  return $total_result;
}


}
?>