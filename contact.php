<?php 


  include_once('inc/header.php');
  
  include_once('./classes/SiteOption.php');
  $site = new SiteOption();
 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $addContact = $site->addContact($_POST);
  }
  
?>


<section class="site-section">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <!-- Contact Message Starts here-->
        <span>
          <?php
          if(isset($addContact)){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $addContact?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
          }
          ?>
        </span>
        <!-- Contact Message Ends here-->
        <h1>Contact Me</h1>
      </div>
    </div>
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
        <form action="#" method="post">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" class="form-control ">
            </div>
            <div class=" col-md-12 form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control ">
            </div>
            <div class="col-md-12 form-group">
              <label for="phone">Phone</label>
              <input type="text" id="phone" name="phone" class="form-control ">
            </div>
            <div class="col-md-12 form-group">
              <label for="message">Write Message</label>
              <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <input type="submit" value="Send Message" class="btn btn-primary">
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- END main-content -->

      <!-- Sidebar starts here -->
      <?php include_once 'inc/sidebar.php'; ?>
      <!-- Sidebar ends here -->

    </div>
  </div>
</section>

<?php include_once 'inc/footer.php'; ?>