<?php


include_once('../classes/Resend_email.php');
// Create a class object
$re = new ResendEmail();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['email'];
  $resend = $re->resendEmail($email);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resend Email</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
  <div class=" container">
    <div class="row">
      <div class="col-md-6">
        <!-- Check Resend Message Starts here-->
        <span>
          <?php
          if(isset($resend)){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $resend ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden=" true">&times;
              </span>
            </button>
          </div>
          <?php
          }
          ?>
        </span>
        <!-- Check Resend Message Ends here-->

        <!-- Main Card starts here -->
        <div class="card">
          <h1 class="card-header">Resend Email</h1>
          <div class="card-body">
            <form method="POST">
              <div class=" form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email">
              </div>

              <button class="btn" type="submit">Resend Email</button>
              <a href="login.php" class="btn">Login</a>
            </form>
          </div>
        </div>
        <!-- Main Card ends here -->

      </div>
    </div>
  </div>


  <script src="./assets/js/app.js"></script>
</body>