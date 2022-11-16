<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');
include_once('../classes/Comments.php');

$cmt = new Comment();


if(isset($_GET['ReplayCmt'])){
  $cmtId = base64_decode($_GET['ReplayCmt']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $replay = $_POST['replay'];
  $cmtReplay = $cmt->AddReplay($replay, $cmtId);
}

?>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6">
          <!-- Check Reply Post Comment Message Starts here-->
          <span>
            <?php
          if(isset($cmtReplay)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $cmtReplay ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          </span>
          <!-- Check Reply Post Comment Message Ends here-->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Reply Post Comment</h4>
              <hr>
              <?php
               $select_cmt = $cmt->commentSelect($cmtId);
               if($select_cmt){
                 while($row = mysqli_fetch_assoc($select_cmt)){
                   ?>
              <!-- Reply Post Comment from starts here -->
              <form action="" method="POST">
                <div class=" mb-3">
                  <label class="form-label">Replay Message</label>
                  <textarea name="replay" class=" form-control" name=""><?=$row['admin_replay']?></textarea>
                </div>
                <div>
                  <div>
                    <button type=" submit" class="btn btn-success waves-effect waves-light me-1">
                      Send Replay
                    </button>
                  </div>
              </form>
              <!-- Reply Post Comment from ends here -->
            </div>
            <?php 
             }
           } 
           ?>
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