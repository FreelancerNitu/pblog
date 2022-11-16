<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../classes/AddCategory.php');
$ct = new Category();

include_once($filepath.'/../classes/SiteOption.php');
$site = new SiteOption();

include_once($filepath.'/../classes/SiteLogo.php');

$siteL = new SiteLogo();
?>

<!doctype html>
<html lang="en">

<head>
  <title>Colorlib Wordify &mdash; Minimal Blog Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <!-- Theme Style -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Theme Main Css -->
  <link rel="stylesheet" href="css/main.css">

<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <div class=" wrap">
    <header role="banner">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <?php
            $allLink = $site->allSocial();
              if($allLink){
                while($link = mysqli_fetch_assoc($allLink)){
            ?>
            <div class="col-9 social">
              <a href="<?=$link['twitter']?>" target="_blank"><span class="fa fa-twitter"></span></a>
              <a href="<?=$link['facebook']?>" target="_blank"><span class="fa fa-facebook"></span></a>
              <a href="<?=$link['instagram']?>" target="_blank"><span class="fa fa-instagram"></span></a>
              <a href="<?=$link['youtube']?>" target="_blank"><span class="fa fa-youtube-play"></span></a>
            </div>
            <?php } }  ?>

            <div class="col-3 search-top">
              <!-- <a href="#"><span class="fa fa-search"></span></a> -->
              <form action="search.php" class="search-top-form">
                <span class="icon fa fa-search"></span>
                <input type="text" name="search" id=" s" placeholder="Type keyword to search...">
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="container logo-wrap">
        <div class="row pt-5">
          <div class="col-12 text-center">
            <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button"
              aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
            <?php
             $logo = $siteL->sitelogo();
                if($logo){
                  while($log = mysqli_fetch_assoc($logo)){
            ?>
            <h1 class="site-logo"><a href="index.php">
                <?=$log['logoName']?>
              </a>
            </h1>
            <?php
              } 
            } 
           ?>

          </div>
        </div>
      </div>

      <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container">

          <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="category.php" id="dropdown05" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                  <?php 
                    $allCat = $ct->AllCategory();
                     if($allCat){
                      while($catRow = mysqli_fetch_assoc($allCat)){
                  ?>
                  <a class="dropdown-item"
                    href="category.php?catId=<?=base64_encode($catRow['catId'])?>"><?=$catRow['catName']?></a>
                  <?php }
                  } 
                 ?>

                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="portfolio.php">Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
            </ul>

          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->