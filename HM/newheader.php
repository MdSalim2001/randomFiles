<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<?php
 require 'hm-backend/db-connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PRISON Management-System</title>

    <link href="assets/css/prisoner-font.css" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link rel="stylesheet" href="HM/assets/css/styles-nav.css">
  </head>
  <body>
    <div style = "height: 75px;"> 
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <!-- <img src="/images/logo.svg" class="img-logo">
              <a class="navbar-brand brand" href="#">OLYMPICS DATABASE</a> -->
              <a href="HM/home.php" class="navbar-brand brand"><img src="HM/assets/images/nitc-logo.jpg" class = "logo-image" style="height: 50px;">CENTRAL JAIL</a> 
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                  <a class="nav-link bg-dark" href="index_signup.php">New Prisoner</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link bg-dark" href="HM/cell-allocation.php">Cell Allocation</a>
                </li>
                <li class="dropdown nav-item">
                  <a href="#" class="dropdown-toggle bg-dark nav-link" data-toggle="dropdown">Cells
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu agile_short_dropdown">
                    <li>
                      <a href="HM/alloted-cells.php">Allocated Cells</a>
               
                    </li>
                    <li>
                      <a href="HM/empty-cells.php">Empty Cells</a>
                    </li>
                    <li>
                      <a href="HM/vacate-cell.php">Vacate Cells</a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown nav-item">
                  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> 
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu agile_short_dropdown">
                    <li>
                      <a href="HM/profile.php">My Profile</a>
                    </li>
                    <li>
                      <a href="hm-backend/logout-hm.php">Logout</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
<!-- //w3l-header -->