<?php 

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/./inc/header.php');
include_once($filepath.'/./inc/sidebar.php');
include_once($filepath.'/../classes/SiteLogo.php');

$siteL = new SiteLogo();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $update_logo = $siteL->updateLogo($_POST);
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
          if(isset($update_logo )){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $update_logo ?>
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
              <h4 class="card-title">Add Logo</h4>
              <hr>
              <?php
              $logo = $siteL->sitelogo();
              if($logo){
                while($row = mysqli_fetch_assoc($logo)){
                  ?>
              <!-- Add Category from starts here -->
              <form action="" method="POST">
                <div class="mb-3">
                  <label class="form-label">Logo</label>
                  <input type="text" class="form-control" name="logo" value="<?=$row['logoName']?>" />
                </div>
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                    Update Logo
                  </button>
                </div>
              </form>
              <!-- Add Category from ends here -->
              <?php 
               }
             } 
             ?>
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