<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');
include_once('../classes/AddCategory.php');

$ct = new Category();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $catName = $_POST['catName'];
  
  $catAdd = $ct->AddCategory($catName);
}

?>
<div class="main-content">

  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6">
          <!-- Check add actegory Message Starts here-->
          <span>
            <?php
          if(isset($catAdd)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $catAdd ?>
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
              <h4 class="card-title">Add Category</h4>
              <p class="card-title-desc">Add Your Favorite Category Here</p>
              <!-- Add Category from starts here -->
              <form action="" method="POST">
                <div class=" mb-3">
                  <label class="form-label">Category Name</label>
                  <input type="text" class="form-control" name="catName" placeholder="Category Name" />
                </div>
                <div>
                  <div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                      Add Category
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

<?php
include_once('./inc/footer.php');
?>