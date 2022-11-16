<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');

include_once('../classes/Portfolio.php');
$port = new Portfolio();

include_once('../helpers/Format.php');
$fr = new Format();

$userId = Session::get('userId');
$allPort = $port->GetAllPortfolio($userId);

/****************************
 *  Post active
 ***************************/
if(isset($_GET['active'])){
  $activeId = $_GET['active'];
  $active = $port->activePortfolio($activeId );
}

/*******************************
 * Post Deactive
 ***************************/ 
if(isset($_GET['deactive'])){
  $deactiveId = $_GET['deactive'];
  $deactive = $port->deactivePortfolio($deactiveId);
}
/*******************************
 * Post Delete
 ***************************/ 
if(isset($_GET['delport'])){
  $id = $_GET['delport'];
  $deletePortfolio = $port->deletePort($id);
}

?>
<!-- Meta Refresh -->
<?php
 if(!isset($_GET['id'])){
   echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
 }
?>

<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Check Active post Message Starts here-->
          <span>
            <?php
             if(isset($active)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $active ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            }
          ?>
          </span>
          <!-- Check Active post Message Ends here-->

          <!-- Check DeActive post Message Starts here-->
          <span>
            <?php
          if(isset($deactive)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $deactive ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          </span>
          <!-- Check DeActive post Message Ends here-->

          <!-- Check Delete Message Starts here-->
          <span>
            <?php
              if(isset($deletePortfolio)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $deletePortfolio ?>
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
              <h4 class="card-title">All Portfolio</h4>
              <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Img 1</th>
                    <th>Img 2</th>
                    <th>Tags</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  if($allPort){
                    $i = 0;
                    while($row = mysqli_fetch_assoc($allPort)){
                      $i++;
                      ?>
                  <tr>
                    <td><?= $i?></td>
                    <td><?= $row['ptitle']?></td>
                    <td><?= $row['catName']?></td>
                    <td><img style="width:50px; height:50px" src=" <?=$row['pimageOne']?>"></td>
                    <td><img style="width:50px; height:50px" src=" <?=$row['pimageTwo']?>"></td>
                    <td><?= $fr->textShorten($row['tags'], 5)?></td>
                    <td>
                      <a href="portEdit.php?editPort=<?=base64_encode($row['postId'])?>"
                        class="btn btn-small btn-warning"><i class=" fas fa-edit"></i></a>
                      <a href="?delport=<?=$row['postId']?>" onclick="return confirm('Are You Sure To Delete')"
                        class=" btn btn-small btn-danger"><i class=" fas fa-trash"></i></a>
                      <a href="" class="btn btn-small btn-info" data-bs-toggle="modal"
                        data-bs-target="#myModal-<?=$row['postId']?>"><i class=" fas fa-eye"></i></a>
                      <?php
                      if($row['pStatus'] == 0){
                        ?>
                      <a href="?deactive=<?=$row['postId']?>" class="btn btn-small btn-warning"><i
                          class="fas fa-arrow-down"></i></a>
                      <?php
                       }else{
                         ?>
                      <a href="?active=<?=$row['postId']?>" class="btn btn-small btn-success"><i
                          class=" fas fa-arrow-up"></i></a>
                      <?php
                     } ?>

                    </td>
                  </tr>
                  <?php
                   }
                    }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
  </div>
</div>

<?php
  $modelData = $port->modelData();
  if($modelData){
    while($mrow = mysqli_fetch_assoc($modelData)){
?>
<!-- sample modal content -->
<div id="myModal-<?= $mrow['postId']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Quick View</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <td><label for="">Title</label></td>
            <td><?=$mrow['ptitle']?></td>
          </tr>
          <tr>
            <td><label for="">Category</label></td>
            <td><?=$mrow['catName']?></td>
          </tr>
          <tr>
            <td><label for="">Image One</label></td>
            <td><img style="width:100%" src=" <?=$mrow['pimageOne']?>"></td>
          </tr>
          <tr>
            <td><label for="">Details One</label></td>
            <td><?=$mrow['pdisOne']?></td>
          </tr>
          <tr>
            <td><label for="">Image Two</label></td>
            <td><img style="width:100%" src=" <?=$mrow['pimageTwo']?>"></td>
          </tr>
          <tr>
            <td><label for="">Details Two</label></td>
            <td><?=$mrow['pdisTwo']?></td>
          </tr>
          <tr>
            <td><label for="">Tags</label></td>
            <td><?=$mrow['tags']?></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark waves-effect" data-bs-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
 } 
} 
?>


<?php
include_once('./inc/footer.php');
?>