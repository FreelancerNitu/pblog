<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../libery/Database.php');
include_once($filepath.'/../helpers/Format.php');

class Category{
  private $db;
  private $fr;
  
  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();
  }
 
  public function AddCategory($catName){
    $catName = $this->fr->validation($catName);
    
    if(empty($catName)){
      $msg = "Category fild must not be empty";
      return $msg;
    }else{
      $select_query = "SELECT * FROM category WHERE catName='$catName'";
      $select_result = $this->db->select($select_query);
      
      if($select_result > 0){
        $error = "This category name alredy exists";
        return $error;
      }else{
        $insert_query = "INSERT INTO category(catName) VALUES('$catName')";
        $insert_result = $this->db->insert($insert_query);
        
        if($insert_result){
          $msg = "Category insert / added successfully";
          return $msg;
        }else{
          $msg ="Something was wrong! Please try again";
          return $msg;
        }
      }
    }
  }
  
  //Select all Category
  public function AllCategory(){
    $select_cat = "SELECT * FROM category ORDER BY catId DESC";
    $all_cat = $this->db->select($select_cat);
    
    if($all_cat != false){
      return $all_cat;
    }else{
      return false;
    }
  }
  
  // Edit cat data
  public function getEditCat($id){
    $edit_data_query = "SELECT * FROM category WHERE catId = '$id'";
    $edit_data_result = $this->db->select($edit_data_query);
    return $edit_data_result;
    
  }
  
  // Update category
  public function UpdateCategory($catName, $id){
    $catName = $this->fr->validation($catName);
    
    if(empty($catName)){
      $msg = "Category fild must not be empty";
      return $msg;
    }else{
      $select_query = "SELECT * FROM category WHERE catName='$catName'";
      $select_result = $this->db->select($select_query);
      
      if($select_result > 0){
        $error = "This category name alredy exists";
        return $error;
      }else{
        $update_query = "UPDATE category SET catName='$catName' WHERE catId='$id'";
        $update_result = $this->db->update($update_query);
        
        if($update_result){
          $msg = "Category updated successfull";
          header('Location: category_list.php');
          return $msg;
        }else{
          $msg ="Something was wrong! Category not updated!";
          return $msg;
        }
      }
    }
  }
  
  // Delete Category
  public function DeleteCategory($id){
    $delete_query = "DELETE FROM category WHERE catId = '$id'";
    $delete_result = $this->db->delete($delete_query);
    
    if($delete_result){
      $msg = "Category Delete Successfull";
      return $msg;
    }else{
      $msg = "Something was wrong! Category was not delete";
      return $msg;
    }
  }
  
  // Category name for select AddCategory
  public function catName($id){
    $cat_id = "SELECT * FROM category WHERE catId = '$id'";
    $cat_result = $this->db->select($cat_id);
    return $cat_result;
  }
  
  // Index Page total Category showing dashboard

public function totalCategory(){
  $total_query = "SELECT * FROM category";
  $total_result = $this->db->select($total_query);
  return $total_result;
}

  
}




?>