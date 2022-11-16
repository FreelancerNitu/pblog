<?php 

include_once('./inc/header.php');
include_once('./inc/sidebar.php');
include_once('../classes/AddCategory.php');

$ct = new Category();

$allCat = $ct->AllCategory();

if(isset($_GET['delCat'])){
  $id = base64_decode($_GET['delCat']);
  $deleteCat = $ct->DeleteCategory($id);
}
?>

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
          <!-- Delete ctegory Message Starts here-->
          <span>
            <?php
          if(isset($deleteCat)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $deleteCat ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          </span>
          <!-- Delete ctegory Message Ends here-->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Category List</h4>
              <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>S. No</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if($allCat){
                    $i = 0;
                    while($row = mysqli_fetch_assoc($allCat)){
                      $i++;
                  ?>
                  <tr>
                    <td><?= $i?></td>
                    <td><?= $row['catName']?></td>

                    <td>
                      <a href="catEdit.php?editId=<?=base64_encode($row['catId'])?>"
                        class="btn btn-success btn-sm">Edit</a>

                      <a href="?delCat=<?=base64_encode($row['catId'])?>"
                        onclick="return confirm('Are you sure to delete - <?=$row['catName']?>')"
                        class=" btn btn-danger btn-sm">Delete</a>
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
include_once('./inc/footer.php');
?>