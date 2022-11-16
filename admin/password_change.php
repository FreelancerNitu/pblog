<?php


include_once('../classes/ChangePassword.php');
// Create an adminLogin class object
$cng = new ChangePassword();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $ChangP = $cng->changePass($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Change</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
  <div class=" container">
    <div class="row">
      <div class="col-md-6">

        <!-- Check Login Message Starts here-->
        <span>
          <?php
          if(isset($ChangP)){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $ChangP ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
          }
          ?>
        </span>
        <!-- Check Login Message Ends here-->

        <!-- Main Card starts here -->
        <div class="card">
          <h1 class="card-header">Password Change</h1>
          <div class="card-body">
            <form method="POST">

              <input type="hidden" class="form-control" name="token" value="<?php
              if(isset($_GET['token'])){
               echo $_GET['token'];
              }
              ?>">

              <div class=" form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" value="<?php
                  if(isset($_GET['email'])){
                    echo $_GET['email'];
                  }
                ?>">
              </div>
              <div class=" form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="npassword">
              </div>
              <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword">
              </div>
              <button class="btn" type="submit">Change Password</button>
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

</html>