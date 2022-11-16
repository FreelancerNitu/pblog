<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');
include_once('../classes/AddCategory.php');

include_once('../classes/Portfolio.php');
$port = new Portfolio();

// Create Category class as a object
$ct = new Category();

$allCat = $ct->AllCategory();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $portfolio_add = $port->addPortfolio($_POST, $_FILES);
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
          if(isset($portfolio_add)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $portfolio_add?>
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
              <h4 class="card-title">Add Portfolio</h4>
              <p class="card-title-desc">Add Your Portfolio Here</p>
              <!-- Add Category from starts here -->
              <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="userId" value="<?=Session::get('userId')?>" />

                <div class="mb-3">
                  <label class="form-label">Portfolio Title</label>
                  <input type="text" class="form-control" name="ptitle" placeholder="Add title" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Select Category</label>
                  <div>
                    <select class="form-select" name="catId">
                      <option>Select</option>
                      <?php 
                      $allCat = $ct->AllCategory();
                      if($allCat){
                        while($row = mysqli_fetch_assoc($allCat)){
                          ?>
                      <option value="<?=$row['catId']?>">
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
                </div>
                <div class="mb-3">
                  <label class="form-label">Description One</label>
                  <textarea name="pdisOne" id="classic-editor"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Image Two</label>
                  <input type="file" class="form-control" name="pimageTwo" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Description Two</label>
                  <textarea name="pdisTwo" id="classic-editor_two"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tags</label>
                  <input type="text" class="form-control" name="tags" placeholder="Post Tags" />
                </div>
                <!-- <div> -->
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                    Add Posrtfolio
                  </button>
                </div>
              </form>
              <!-- Add Category from ends here -->
            </div>
          </div>
        </div> <!-- end col -->

      </div>
    </div>
  </div>
</div>
<!-- end row -->

<?php include_once('./inc/footer.php');?>