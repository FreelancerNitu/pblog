<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');

include_once('../classes/AddCategory.php');
// Create Category class as a object
$ct = new Category();

include_once('../classes/Post.php');
$post = new Post();

if(isset($_GET['editPost'])){
  $id = base64_decode($_GET['editPost']);
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $post_add = $post->EditPost($_POST, $_FILES, $id);
}


?>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-10">
          <!-- Check add actegory Message Starts here-->
          <span>
            <?php
          if(isset($post_add)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $post_add?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          </span>
          <!-- Check add actegory Message Ends here-->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Post Edit</h4>
              <p class="card-title-desc">Edit Your Favorite Post Here</p>

              <!-- Add Category from starts here -->
              <?php
              $getPost = $post->getPostForEdit($id);
               if($getPost){
                 while($prow = mysqli_fetch_assoc($getPost)){
                   ?>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label">Post Title</label>
                  <input type="text" class="form-control" name="title" value="<?=$prow['title']?>" />
                </div>
                <div class=" mb-3">
                  <label class="form-label">Select Category</label>
                  <div>
                    <select class="form-select" name="catId">
                      <option>Select</option>
                      <?php 
                      $allCat = $ct->AllCategory();
                      if($allCat){
                        while($row = mysqli_fetch_assoc($allCat)){
                          ?>
                      <option <?=$prow['catId'] == $row['catId']?'selected': ''?> value="<?=$row['catId']?>">
                        <?=$row['catName']?></option>
                      <?php
                          }
                          }
                          ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Image One</label>
                  <input type="file" class="form-control" name="imageOne" />
                  <img src="<?=$prow['imageOne']?>" alt="" class="img-thumbnail" style="width:100px">
                </div>
                <div class=" mb-3">
                  <label class="form-label">Description One</label>
                  <textarea name="disOne" id="classic-editor"><?=$prow['disTwo']?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Image Two</label>
                  <input type="file" class="form-control" name="imageTwo" />
                  <img src="<?=$prow['imageTwo']?>" alt="" class="img-thumbnail" style=" width:100px">
                </div>
                <div class="mb-3">
                  <label class="form-label">Description Two</label>
                  <textarea name="disTwo" id="classic-editor_two"><?=$prow['disTwo']?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Post Type</label>
                  <div>
                    <select class="form-select" name="postType">
                      <option>Select</option>
                      <?php
                       if($prow['postType'] == 1){
                         ?>
                      <option selected value="1">Post</option>
                      <option value="2">Slider</option>
                      <?php }else{
                        ?>
                      <option value="1">Post</option>
                      <option selected value="2">Slider</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tags</label>
                  <input type="text" class="form-control" name="tags" value="<?=$prow['tags']?>" />
                </div>
                <!-- <div> -->
                <div>
                  <button type=" submit" class="btn btn-primary waves-effect waves-light me-1">
                    Update Post
                  </button>
                </div>
              </form>

              <?php
              } 
             }
              ?>
              <!-- Add Category from ends here -->
            </div>
          </div>
        </div> <!-- end col -->
      </div>
    </div>
  </div>
</div>
<!-- end row -->

<?php
include_once('./inc/footer.php');
?>