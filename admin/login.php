<?php


include_once('../classes/admin_login.php');
// Create an adminLogin class object
$al = new AdminLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  
  $chkLogin = $al->LoginUser($email, $password);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
  <div class=" container">
    <div class="row">
      <div class="col-md-6">

        <!-- Alert Message Starts here-->
        <span>
          <?php
          if(isset( $_SESSION['status'])){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?=$_SESSION['status']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden=" true">&times;
              </span>
            </button>
          </div>
          <?php
          }
          ?>
        </span>
        <!-- Alert Message Ends here-->

        <!-- Check Login Message Starts here-->
        <span>
          <?php
          if(isset($chkLogin)){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?=$chkLogin ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;
              </span>
            </button>
          </div>
          <?php
          }
          ?>
        </span>
        <!-- Check Login Message Ends here-->

        <!-- Main Card starts here -->
        <div class="card">
          <h1 class="card-header">Login Form</h1>
          <div class="card-body">
            <form method="POST">
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
              <button class="btn" type="submit">Login</button>
              <a href="register.php" class="btn">Sing Up</a>
              <a href="password_reset.php" class="forgetP"> Forget Your Password?</a>
            </form>
            <hr>
            <h5>Did not recive your verifaction email?<a href="resend_email.php">Resend</a></h5>
          </div>
        </div>
        <!-- Main Card ends here -->
      </div>
    </div>
  </div>


  <script src="./assets/js/app.js"></script>
</body>

</html>