<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');

include_once('../classes/AddCategory.php');
// Create Category class as a object
$ct = new Category();

include_once('../classes/Portfolio.php');
$port = new Portfolio();

if(isset($_GET['editPort'])){
  $id = base64_decode($_GET['editPort']);
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $port_add = $port->EditPort($_POST, $_FILES, $id);
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
          if(isset($port_add)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $port_add?>
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
              <p class="card-title-desc">Edit Your Favorite Portfolio Here</p>

              <!-- Add Category from starts here -->
              <?php
              $getPortfolio = $port->getPortForEdit($id);
               if($getPortfolio){
                 while($prow = mysqli_fetch_assoc($getPortfolio)){
                   ?>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label">Portfolio Title</label>
                  <input type="text" class="form-control" name="ptitle" value="<?=$prow['ptitle']?>" />
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
                  <input type="file" class="form-control" name="pimageOne" />
                  <img src="<?=$prow['pimageOne']?>" alt="" class="img-thumbnail" style="width:100px">
                </div>
                <div class=" mb-3">
                  <label class="form-label">Description One</label>
                  <textarea name="pdisOne" id="classic-editor"><?=$prow['pdisTwo']?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Image Two</label>
                  <input type="file" class="form-control" name="pimageTwo" />
                  <img src="<?=$prow['pimageTwo']?>" alt="" class="img-thumbnail" style=" width:100px">
                </div>
                <div class="mb-3">
                  <label class="form-label">Description Two</label>
                  <textarea name="pdisTwo" id="classic-editor_two"><?=$prow['pdisTwo']?></textarea>
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