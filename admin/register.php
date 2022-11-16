<?php

include_once('../classes/Register.php');

$re = new register();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $addUser = $re->addUser($_POST);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
  <div class=" container">
    <div class="row">
      <div class="col-md-6">
        <!-- Alert Messager Starts here-->
        <span>
          <?php
          if(isset($addUser)){
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?=$addUser?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden=" true">&times;</span>
            </button>
          </div>
          <?php
          }

          ?>
        </span>
        <!-- Alert Messager Ends here-->

        <div class="card">
          <h1 class="card-header">Registration Form</h1>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" class="form-control" name="phone">
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
              <button type="submit">Singup</button>
              <a class="button" href=" login.php">Login<a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="./assets/js/app.js"></script>
</body>

</html>