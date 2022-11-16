<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../classes/Post.php');
$post = new Post();

include_once($filepath.'/../helpers/Format.php');
$fr = new Format();



?>

<section class="site-section pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="owl-carousel owl-theme home-slider">
          <?php
          $slider_post = $post->sliderPost();
          if($slider_post){
            while($row = mysqli_fetch_assoc($slider_post)){
              ?>
          <div>
            <a href="blog-single.php?singleId=<?=base64_encode($row['postId'])?>"
              class="a-block d-flex align-items-center height-lg"
              style="background-image: url(admin/<?= $row['imageOne']?>); ">
              <div class="text half-to-full">
                <span class="category mb-5"><?= $row['catName']?></span>
                <div class="post-meta">

                  <span class="author mr-2"><img src="admin/<?= $row['image']?>" alt="Username">
                    <?= $row['username']?></span>&bullet;
                  <span class="mr-2"><?= $fr->formateDate($row['create_time'])?></span> &bullet;

                </div>
                <h3><?=$row['title']?></h3>
                <p> <?=$fr->textShorten($row['disOne'], 100)?></p>
              </div>
            </a>
          </div>
          <?php } } ?>

        </div>

      </div>
    </div>

  </div>


</section>
<!-- END section -->