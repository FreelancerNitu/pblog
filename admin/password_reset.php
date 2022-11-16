<?php


include_once('../classes/PasswordReset.php');
// Create a class object
$pwr = new PasswordReset();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['email'];
  $reset = $pwr->PasswordReset($email);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
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
          if(isset($reset)){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $rest ?>
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
          <h1 class="card-header">Password Reset</h1>
          <div class="card-body">
            <form method="POST">
              <div class=" form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email">
              </div>

              <button class="btn" type="submit">Password Reset Link</button>
            </form>
          </div>
        </div>
        <!-- Main Card ends here -->

      </div>
    </div>
  </div>


  <script src="./assets/js/app.js"></script>
</body>