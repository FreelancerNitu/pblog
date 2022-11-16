<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');

include_once('../classes/SiteOption.php');
$site = new SiteOption();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $update_link = $site->updateLinks($_POST);
}

?>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6">
          <!-- Social Message Starts here-->
          <span>
            <?php
              if(isset($update_link)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $update_link ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          </span>
          <!-- Social Message Ends here-->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add Social Links</h4>
              <hr>
              <?php
                $allSocial = $site->allSocial();
                 if($allSocial){
                  while($row = mysqli_fetch_assoc($allSocial)){
              ?>
              <!-- Add Social from starts here -->
              <form action="" method="POST">
                <div class="mb-3">
                  <label class="form-label">twitter</label>
                  <input type="text" class="form-control" name="twitter" value="<?=$row['twitter']?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">fcebook</label>
                  <input type="text" class="form-control" name="facebook" value="<?=$row['facebook']?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="<?=$row['instagram']?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="<?=$row['youtube']?>" />
                </div>
                <div>
                  <div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                      Update Social Link
                    </button>
                  </div>
              </form>
              <!-- Add Social from ends here -->

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