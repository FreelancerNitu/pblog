<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');
include_once('../classes/User.php');

$user = new User();

?>

<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-6">
                  <h5>User profile</h5>
                </div>
                <div class="col-sm-6">
                  <a href="edit-profile.php?uid=<?=Session::get('userId');?>"
                    class="btn btn-info btn-sm d-flex justify-content-center">Edit
                    Profile</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- User Profole table starts here -->
              <table class="table table-bordered table-responsive">
                <tr>
                  <td><label for="">User Name</label></td>
                  <td><?=Session::get('username');?></td>
                </tr>
                <tr>
                  <td><label for="">User Image</label></td>
                  <td><img class="pImage" style="width:100%" src=" <?=Session::get('userImage')?>"></td>
                </tr>
              </table>
              <!-- User Profole table ends here -->
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