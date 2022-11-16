<?php

$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../classes/User.php');
$user = new User();

include_once($filepath.'/../classes/SiteOption.php');
$site = new SiteOption();

include_once($filepath.'/../classes/Post.php');
$pt = new Post();

include_once($filepath.'/../classes/Portfolio.php');
$port = new Portfolio();

include_once($filepath.'/../classes/AddCategory.php');
$ct = new Category();

include_once($filepath.'/../helpers/Format.php');
$fr = new Format();

?>
<div class="col-md-12 col-lg-4 sidebar">
  <!-- END sidebar-box -->
  <div class="sidebar-box">
    <?php
    $userInfo = $user->userBio();
    if($userInfo){
      $unifo = mysqli_fetch_assoc($userInfo);
      ?>
    <div class="bio text-center">
      <img src="admin/<?=$unifo['image']?>" alt="Image Placeholder" class="img-fluid">
      <div class="bio-body">
        <h2><?=$unifo['username']?></h2>
        <p><?=$fr->textShorten($unifo['user_bio'], 100)?></p>
        <p><a href="user-bio.php" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
        <?php
        $allLinks = $site->allSocial();
        if($allLinks){
          $links = mysqli_fetch_assoc($allLinks);
          ?>
        <p class="social">
          <a href="<?=$links['facebook']?>" target="_blank" class=" p-2"><span class="fa fa-facebook"></span></a>
          <a href="<?=$links['twitter']?>" target="_blank" class="p-2"><span class="fa fa-twitter"></span></a>
          <a href="<?=$links['instagram']?>" target="_blank" class="p-2"><span class="fa fa-instagram"></span></a>
          <a href="<?=$links['youtube']?>" target="_blank" class="p-2"><span class="fa fa-youtube-play"></span></a>
        </p>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
  <!-- END sidebar-box -->
  <div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
      <ul>
        <?php
        $allPost = $pt->popularPost();
        if($allPost){
          while($prow = mysqli_fetch_assoc($allPost)){
            ?>
        <li>
          <a href="blog-single.php?singleId=<?=base64_encode($prow['postId'])?>">
            <img src="admin/<?=$prow['imageOne']?>" alt="Image placeholder" class="mr-4">
            <div class="text">
              <h4><?=$prow['title']?></h4>
              <div class="post-meta">
                <span class="mr-2">
                  <?=$fr->formateDate($prow['create_time'])?>
                </span>
              </div>
            </div>
          </a>
        </li>
        <?php } } ?>
      </ul>
    </div>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Popular Portfolio</h3>
    <div class="post-entry-sidebar">
      <ul>
        <?php
        $allPort = $port->popularPortfolio();
        if($allPort){
          while($prow = mysqli_fetch_assoc($allPort)){
            ?>
        <li>
          <a href="port-single.php?singleId=<?=base64_encode($prow['postId'])?>">
            <img src="admin/<?=$prow['pimageOne']?>" alt="Image placeholder" class="mr-4">
            <div class="text">
              <h4><?=$prow['ptitle']?></h4>
              <div class="post-meta">
                <span class="mr-2">
                  <?=$fr->formateDate($prow['create_time'])?>
                </span>
              </div>
            </div>
          </a>
        </li>
        <?php } } ?>
      </ul>
    </div>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
      <?php
     $allCat = $ct->AllCategory();
     if($allCat){
       while($catRow = mysqli_fetch_assoc($allCat)){
         ?>
      <li><a href="category.php?catId=<?=base64_encode($catRow['catId'])?>">
          <?=$catRow['catName']?>
          <span>
            <?php
            $catNum = $pt->catNum($catRow['catId']);
            if($catNum){
              echo $num = mysqli_num_rows($catNum);
            }else{
              echo '0';
            }
            ?>
          </span>
        </a></li>

      <?php } } ?>

    </ul>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Tags</h3>
    <ul class="tags">
      <?php
        $allTags = $pt->popularPost();
          if($allTags){
           while($tag = mysqli_fetch_assoc($allTags)){
      ?>
      <li> <a href="#"><?=$tag['tags']?></a></li>
      <?php } } ?>

    </ul>
  </div>
</div>
<!-- END sidebar -->