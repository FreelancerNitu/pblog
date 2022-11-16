<?php

 include_once 'inc/header.php';
 
 include_once('classes/User.php');
 $ur = new User();
 
 include_once('helpers/Format.php');
 $fr = new format();
 
 ?>

<section class="site-section pt-5">
  <div class="container">
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
          <h2 class="mb-4">All User Information</h2>
          <?php
            $userInfo = $ur->userBio();
             if($userInfo){
               while($urow = mysqli_fetch_assoc($userInfo)){
                 ?>
          <div class="col-md-12">
            <h2 class="mb-4 uname">Hi There! I'm <?=$urow['username']?></h2>
            <p class="mb-5 uimage"><img src="admin/<?=$urow['image']?>" alt="Image placeholder" class="img-fluid"></p>
            <p class="ubio"><?=$urow['user_bio']?></pc>
          </div>


          <?php } } ?>
        </div>


      </div>
      <!-- END main-content -->

      <!--Sidebar Starts here  -->
      <?php include_once 'inc/sidebar.php'; ?>
      <!--Sidebar ends here  -->

    </div>
  </div>
</section>

<?php include_once 'inc/footer.php'; ?>