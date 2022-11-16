<?php 

include_once 'inc/header.php';
include_once 'inc/slider.php';

include_once('./helpers/Format.php');
$fr = new Format();

include_once('./classes/Post.php');
$post = new Post();

include_once('./classes/Portfolio.php');
$port = new Portfolio();



?>


<section class="site-section py-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-4">Latest Posts</h2>
      </div>
    </div>
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">

          <?php
            
          $limit = 6;
          if(isset($_GET['page'])){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          $offset = ($page - 1) * $limit;
          
          $getPost = $post->latestPost($offset, $limit);
          if($getPost){
            while($row = mysqli_fetch_assoc($getPost)){
          ?>
          <!-- Latest Post  -->
          <div class="col-md-6">
            <a href="blog-single.php?singleId=<?=base64_encode($row['postId'])?>" class="blog-entry element-animate"
              data-animate-effect="fadeIn">
              <img class="postImg" src="admin/<?=$row['imageOne']?>" alt="Image placeholder">
              <div class="blog-content-body">
                <div class="post-meta">
                  <span class="author mr-2"><img src=" admin/<?=$row['image']?>" alt="User">
                    <?=$row['username']?>
                  </span>&bullet;
                  <span class="mr-2">
                    <?=$fr->formateDate($row['create_time'])?>
                  </span>

                </div>
                <h2><?=$row['title']?>
                </h2>
              </div>
            </a>
          </div>

          <?php } }?>

        </div>

        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">

              <?php
              $num_page = $post->PaginationNum();
              if($num_page){
                $total_record = mysqli_num_rows($num_page);
                $total_page = ceil($total_record / $limit);
                ?>
              <ul class="pagination">
                <?php
                if($page > 1){
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?=$page - 1?>">&lt;</a></li>
                <?php } ?>

                <?php
                  for($i = 1; $i <= $total_page; $i++){
                    if($i == $page){
                      $active = 'active';
                    }else{
                      $active = '';
                    }
                    ?>
                <li class="page-item <?=$active?>"><a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a>
                </li>
                <?php } ?>
                <?php
                if($total_page > $page){
                  ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?=$page + 1?>">&gt;</a></li>
                <?php } ?>
              </ul>

              <?php } ?>


            </nav>
          </div>
        </div>

      </div>

      <!-- END main-content -->

      <!-- Sidebar Starts -->
      <?php include_once 'inc/sidebar.php'; ?>
      <!-- Sidebar ends -->

    </div>
  </div>
</section>

<section class="site-section port py-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-4">Latest Portfolio</h2>
      </div>
    </div>
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">

          <?php
            
          $limit = 4;
          if(isset($_GET['page'])){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          $offset = ($page - 1) * $limit;
          
          $getPort = $port->latestPortfolio($offset, $limit);
          if($getPort){
            while($row = mysqli_fetch_assoc($getPort)){
          ?>
          <!-- Latest Post  -->
          <div class="col-md-6">
            <a href="port-single.php?singleId=<?=base64_encode($row['postId'])?>" class="blog-entry element-animate"
              data-animate-effect="fadeIn">
              <img class="postImg" src="admin/<?=$row['pimageOne']?>" alt="Image placeholder">
              <div class="blog-content-body">
                <div class="post-meta">
                  <span class="author mr-2"><img src=" admin/<?=$row['image']?>" alt="User">
                    <?=$row['username']?>
                  </span>&bullet;
                  <span class="mr-2">
                    <?=$fr->formateDate($row['create_time'])?>
                  </span>

                </div>
                <h2><?=$row['ptitle']?>
                </h2>
              </div>
            </a>
          </div>

          <?php } }?>

        </div>

        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">

              <?php
              $num_page = $port->PaginationNum();
              if($num_page){
                $total_record = mysqli_num_rows($num_page);
                $total_page = ceil($total_record / $limit);
                ?>
              <ul class="pagination">
                <?php
                if($page > 1){
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?=$page - 1?>">&lt;</a></li>
                <?php } ?>

                <?php
                  for($i = 1; $i <= $total_page; $i++){
                    if($i == $page){
                      $active = 'active';
                    }else{
                      $active = '';
                    }
                    ?>
                <li class="page-item <?=$active?>"><a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a>
                </li>
                <?php } ?>
                <?php
                if($total_page > $page){
                  ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?=$page + 1?>">&gt;</a></li>
                <?php } ?>
              </ul>

              <?php } ?>


            </nav>
          </div>
        </div>

      </div>

      <!-- END main-content -->

      <!-- Sidebar Starts -->
      <?php include_once 'inc/sidebar.php'; ?>
      <!-- Sidebar ends -->

    </div>
  </div>
</section>
<?php include_once 'inc/footer.php'; ?>