<?php 

include_once 'inc/header.php';
include_once('./helpers/Format.php');
$fr = new Format();

include_once('./classes/Post.php');
$post = new Post();

include_once('./classes/Portfolio.php');
$port = new Portfolio();



if(!isset($_GET['search']) || $_GET['search'] == NULL){
  echo "<h1 class='text-danger'>Search Result Not Found!</h1>";
}else{
  $search = $_GET['search'];
}

?>


<!-- For blog post -->
<section class="site-section py-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="m-4">Search Results For: <em>"<?php echo $_GET['search']?>"</em></h2>
      </div>
    </div>
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
          <?php
        $getPost = $post->searchPost($search);
        if($getPost){
          while($row = mysqli_fetch_assoc($getPost)){
            ?>
          <div class="col-md-6">
            <a href="blog-single.php?singleId=<?=base64_encode($row['postId'])?>" class="blog-entry element-animate"
              data-animate-effect="fadeIn">
              <img class="postImg" src="admin/<?=$row['imageOne']?>" alt="Image placeholder">
              <div class="blog-content-body">
                <div class="post-meta">
                  <span class="author mr-2"><img src=" admin/<?=$row['image']?>" alt="U">
                    <?=$row['username']?>
                  </span>&bullet;
                  <span class="mr-2">
                    <?=$fr->formateDate($row['create_time'])?>
                  </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h2><?=$row['title']?></h2>
              </div>
            </a>
          </div>
          <?php
          } 
         }else{
          echo "<h1 class='text-danger'>Search Result Not Found!</h1>";
         }
          ?>

        </div>
      </div>
      <!-- END main-content -->

    </div>
  </div>
</section>

<!-- For Portfolio post -->
<!-- <section class="site-section py-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="m-4">Search Results For: <em>"<?php echo $_GET['search']?>"</em></h2>
      </div>
    </div>
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
          <?php
        $getPortfolio = $port->searchPortfolio($search);
        if($getPortfolio){
          while($row = mysqli_fetch_assoc($getPortfolio)){
            ?>
          <div class="col-md-6">
            <a href="port-single.php?singleId=<?=base64_encode($row['postId'])?>" class="blog-entry element-animate"
              data-animate-effect="fadeIn">
              <img class="postImg" src="admin/<?=$row['pimageOne']?>" alt="Image placeholder">
              <div class="blog-content-body">
                <div class="post-meta">
                  <span class="author mr-2"><img src=" admin/<?=$row['image']?>" alt="U">
                    <?=$row['username']?>
                  </span>&bullet;
                  <span class="mr-2">
                    <?=$fr->formateDate($row['create_time'])?>
                  </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h2><?=$row['ptitle']?></h2>
              </div>
            </a>
          </div>
          <?php
          } 
         }else{
          echo "<h1 class='text-danger'>Search Result Not Found!</h1>";
         }
          ?>

        </div>
      </div>
      <!-- END main-content -->

</div>
</div>
</section> -->

<?php include_once 'inc/footer.php'; ?>