<?php
session_start();
// If the session isn't there, it will create one
if (empty($_SESSION["totals"])) {
    $_SESSION["totals"] = [0, 0, 0, 0, 0, 0];
    $_SESSION["cart"] = [];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="Description" content="This is the Turfs Up company home page.">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Turfs Up - Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

</head>

<!-- NAVBAR -->
<body class="text-white bg-dark">

    <nav class="navbar navbar-expand-lg navbar-dark px-5">
        <a class="navbar-brand" href="index.php">
            <img src="Images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Company Logo"><span
                class="px-2">TURFS UP</span></a>
        <!-- Hamburger Menu -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">HOME<span class="sr-only">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">PRODUCTS<span class="sr-only">Products</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calculator.php">CALCULATOR<span class="sr-only">Calculator</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="about.php">ABOUT<span class="sr-only">About</span></a>
                </li>
            </ul>
            <span class="navbar-text">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">CART - <i class="fas fa-shopping-cart"></i>
                            <?php
                            // Displays some brief cart information in the navbar
                            if ($_SESSION["totals"][5] == 1) {
                                // If the amount of turfs in the cart is 1, the cart will print item
                                printf("1 ITEM - $%s", $_SESSION["totals"][5], $_SESSION["totals"][0]);
                            } else {
                                // If its not a 1 it will print the plural form of item (items)
                                printf("%s ITEMS - $%s", $_SESSION["totals"][5], $_SESSION["totals"][0]);
                            }
                            ?></a>
                    </li>
                </ul>
            </span>
        </div>
    </nav>

    <header class="about">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 style="font-size:3.5rem;">ABOUT</h1>
                </div>
                <!-- Bouncing down arrow that will send the user to a quick description of the website -->
                <div class="col-12 text-center align-bottom">
                    <a href="#main" class="noblue" aria-label="Down arrow that links to main home page content"><i class="fas fa-chevron-down fa-3x bounce text-white" ></i></a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
        <div class="container text-center">
            <!-- ID is main becuase its linked to the href in the anchor tag -->
            <h3 class="font-weight-light" id="main">ABOUT PAGE</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </section>


<!-- Page footer -->
<div class="mt-5 pt-5 pb-5 footer bg-secondary text-center">
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-xs-12 about-company">
      <h2>Turfs Up</h2>
      <p class="pr-5 text-white-50">Turfs Up has been growing, delivering and installing the highest quality lawns since 1988, now boasting specialised turf varieties suitable for all across Australia.</p>
    </div>
    <div class="col-lg-3 col-xs-12 links">
      <h4 class="mt-lg-0 mt-sm-3">Links</h4>
        <ul class="m-0 p-0 nobullet">
        <!-- List of links on the page -->
          <li>- <a href="index.php" class="noblue">Home</a></li>
          <li>- <a href="products.php" class="noblue">Products</a></li>
          <li>- <a href="calculator.php" class="noblue">Calculator</a></li>
          <li>- <a href="cart.php" class="noblue">Cart</a></li>
          <li>- <a href="about.php" class="noblue">About</a></li>
        </ul>
    </div>
    <div class="col-lg-4 col-xs-12 location">
      <h4 class="mt-lg-0 mt-sm-4">Contact Details</h4>
      <!-- Quick summary of some fake contact details but the email is a real email -->
      <p class="mb-0"><i class="fa fa-map-marked-alt mr-3"></i>88, Hay Point Road, Alligator Creek</p>
      <p class="mb-0"><i class="fa fa-phone mr-3"></i>(07) 3114 8281</p>
      <p class="mb-0"><i class="fa fa-envelope mr-3"></i>TurfsUpCo@gmail.com</p>
      <p class="mb-0"><i class="fa fa-clock mr-3"></i>9AM - 5PM (AEST)</p>
    </div>
  </div>
</div>
</div>


</body>
</html>
