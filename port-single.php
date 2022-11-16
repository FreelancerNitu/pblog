<?php 

include_once 'inc/header.php'; 

include_once('helpers/Format.php');
$fr = new Format();

include_once('classes/Portfolio.php');
$port = new Portfolio();

if(isset($_GET['singleId'])){
  $postId = base64_decode($_GET['singleId']);
}


?>


<section class="site-section py-lg">
  <div class="container">
    <div class="row blog-entries element-animate">
      <?php
      
      $getPort = $port->singlePortfolio($postId);
        if($getPort){
          while($row = mysqli_fetch_assoc($getPort)){
          
      ?>
      <div class="col-md-12 col-lg-8 main-content">
        <div class="post-meta">
          <span class="author mr-2"><img src="admin/<?=$row['image']?>" alt="Colorlib" class="mr-2">
            <?=$row['username']?></span>&bullet;
          <span class="mr-2"><?=$fr->formateDate($row['create_time'])?> </span>
        </div>
        <h1 class="mb-4"><?=$row['ptitle']?></h1>
        <a class="category mb-5" href="#"><?=$row['catName']?></a>

        <img src="admin/<?=$row['pimageOne']?>" alt="Image" class="img-fluid mb-5">

        <div class="post-content-body">
          <p><?=$row['pdisOne']?></p>
          <div class="row mb-5">
            <div class="col-md-12 mb-4">
              <img src="admin/<?=$row['pimageTwo']?>" alt="Image placeholder" class="img-fluid">
            </div>
          </div>
          <p><?=$row['pdisTwo']?></p>
        </div>

        <div class="pt-5">
          <p>Categories: <a href="#"><?=$row['catName']?></a> Tags: <a href="#"><?=$row['tags']?></a></p>
        </div>
      </div>
      <!-- END main-content -->

      <!-- Sidebar starts here -->

      <?php include_once 'inc/sidebar.php'; ?>

      <!-- Sidebar ends here -->

    </div>
  </div>
</section>

<section class="py-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-3 ">Related Portfolio</h2>
      </div>
    </div>
    <div class="row">
      <?php 
       $rel_port =$port->relatedPortfolio($row['catId']);
        if($rel_port){
          while($rp = mysqli_fetch_assoc($rel_port)){
            ?>

      <div class="col-md-6 col-lg-4">
        <a href="port-single.php?singleId=<?=base64_encode($rp['postId'])?>"
          class="a-block sm d-flex align-items-center height-md" pr
          style="background-image: url(admin/<?=$rp['pimageOne']?>); ">
          <div class="text">
            <div class="post-meta">
              <span class="category"><?=$rp['catName']?></span>
              <span class="mr-2">
                <?=$fr->formateDate($rp['create_time'])?>
              </span> &bullet;

            </div>
            <h3><?=$rp['ptitle']?>
            </h3>
          </div>
        </a>
      </div>

      <?php } } ?>

    </div>
  </div>
</section>
<?php 
  }
   }
?>
<!-- END section -->

<?php include_once 'inc/footer.php'; ?>