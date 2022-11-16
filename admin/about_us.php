<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');
include_once('../classes/SiteOption.php');

$site = new SiteOption();



if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $update = $site->aboutUpdate($_POST, $_FILES);
}

?>
<div class="main-content">

  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6">
          <!-- About Message Starts here -->
          <span>
            <?php
             if(isset($update)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=$update?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          </span>
          <!-- About Message Ends here -->
          <div class="card">
            <h4 class="card-title">About Us</h4>
            <div class="card-body">

              <?php
                $getAbout = $site->aboutInfo();
                if($getAbout){
                  while($row = mysqli_fetch_assoc($getAbout)){
              ?>
              <!-- About from starts here -->
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label">User Name</label>
                  <input type="text" class="form-control" name="username" value="<?=$row['username']?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label">User Image</label>
                  <input type="file" class="form-control" name="image" />
                  <img src="<?=$row['image']?>" class="img-thumbnail">
                </div>

                <div class="mb-3">
                  <label class="form-label">User Details</label>
                  <textarea class="form-control" name="user_bio"><?=$row['user_details']?></textarea>
                </div>

                <div>
                  <div>
                    <button type=" submit" class="btn btn-primary waves-effect waves-light me-1">
                      Update About Us
                    </button>
                  </div>
              </form>
              <!-- About from ends here -->
              <?php } } ?>
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