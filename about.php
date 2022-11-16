<?php

 include_once 'inc/header.php';
 
 include_once('classes/SiteOption.php');
 $site = new SiteOption();

 include_once('classes/Post.php');
 $pt = new Post();
 
 include_once('helpers/Format.php');
 $fr = new format();
 
 ?>

<section class="site-section pt-5">
  <div class="container">
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
          <?php
            $allAbout = $site->aboutInfo();
             if($allAbout){
               while($arow = mysqli_fetch_assoc($allAbout)){
                 ?>
          <div class="col-md-12">
            <h2 class="mb-4">Hi There! I'm <?=$arow['username']?></h2>
            <p class="mb-5"><img src="admin/<?=$arow['image']?>" alt="Image placeholder" class="img-fluid"></p>
            <p><?=$arow['user_details']?></p>
          </div>

          <?php } } ?>
        </div>

        <!-- Latest Post starts here  -->
        <div class="row mb-5 mt-5">
          <div class="col-md-12 mb-5">
            <h2>My Latest Posts</h2>
          </div>
          <div class="col-md-12">
            <?php
            $limit = 4;
            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            $offset = ($page - 1) * $limit;
            
             $latestPost = $site->latestPost($offset, $limit);
             if($latestPost){
               while($row = mysqli_fetch_assoc($latestPost)){
                 ?>
            <div class="post-entry-horzontal">
              <a href="blog-single.php?singleId=<?=base64_encode($row['postId'])?>">
                <div class="image" style="background-image: url(admin/<?=$row['imageOne']?>">
                </div>
                <span class="text">
                  <div class="post-meta">
                    <span class="author mr-2"><img src="admin/<?=$row['image']?>" alt="username">
                      <?=$row['username']?>
                    </span>&bullet;
                    <span class="mr-2">
                      <?=$fr->formateDate($row['create_time'])?>
                    </span> &bullet;
                  </div>
                  <h2>
                    <?=$row['title']?>
                  </h2>
                </span>
              </a>
            </div>
            <?php } } ?>

          </div>
        </div>
        <!-- Latest Post ends here  -->

        <!-- pagination starts here -->
        <div class="row">
          <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
              <?php
              $pag_post =$pt-> PaginationNum();
              if($pag_post){
                  $total_record = mysqli_num_rows($pag_post);
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
              <?php  } ?>

            </nav>
          </div>
        </div>
        <!-- pagination ends here -->

      </div>
      <!-- END main-content -->

      <!--Sidebar Starts here  -->
      <?php include_once 'inc/sidebar.php'; ?>
      <!--Sidebar ends here  -->

    </div>
  </div>
</section>

<?php include_once 'inc/footer.php'; ?>