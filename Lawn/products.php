<?php
session_start();
if (empty($_SESSION["totals"])) {
    // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
    $_SESSION["totals"] = [0, 0, 0, 0, 0, 0];
    // ID, Name, Turf Type, Length, Width, Area, Weight, Cost of Turf m/2, Preperation op, lay op, Total Turf Cost, Labour
    $_SESSION["cart"] = [];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="Description" content="This page is the products page which displays all the different grass varities that Turfs Up has.">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Turfs Up - Products</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>

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
                <li class="nav-item active">
                    <a class="nav-link" href="products.php">PRODUCTS<span class="sr-only">Products</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calculator.php">CALCULATOR<span class="sr-only">Calculator</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">ABOUT<span class="sr-only">About</span></a>
                </li>
            </ul>
            <span class="navbar-text">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">CART - <i class="fas fa-shopping-cart"></i>
                            <?php
                            if ($_SESSION["totals"][5] == 1) {
                                printf("%s ITEM - $%s", $_SESSION["totals"][5], $_SESSION["totals"][0]);
                            } else {
                                printf("%s ITEMS - $%s", $_SESSION["totals"][5], $_SESSION["totals"][0]);
                            }
                            ?></a>
                    </li>
                </ul>
            </span>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="my-4 mx-5">
        <div class="row">
            <div class="col-md">
                <h2 class="text-center">PRODUCTS</h2>
            </div>
        </div>
    </div>

<div class="row text-white text-center">
    <div class="col-8 offset-2">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="mx-2">
                    <h4 class="mt-3">Buffalo Grass</h4>
                    <hr />
                    <img src="Images/Grass/buffalograss.jpg" class="rounded img-fluid m-3" width="200px" alt="Buffalo Grass image"/>
                    <p class="lead">Cost: $16/m<sup>2</sup></p>
                    <p>
                        This warm-season grass is an ideal all-round choice for Australian homes with the new generations of Buffalo been bred with soft leaf blades making them softer underfoot.
                    </p>
                    <div align="center" class="mb-4 buttona">
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="products/buffalo.php">View Product:  <i class="far fa-question-circle"></i></a>
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="calculator.php?a=2">Start Order:  <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="mx-2">
                    <h4 class="mt-3">Couch Grass</h4>
                    <hr />
                    <img src="Images/Grass/Couchgrass.jpg" class="rounded img-fluid m-3" width="200px" alt="Couch Grass image"/>
                    <p class="lead">Cost: $11/m<sup>2</sup></p>
                    <p>
                        Couch grass is now arguably one of the most popular lawns in Australia and well-known by most homeowners for being a highly attractive ornamental variety. Couch grass offer homeowners a hard-wearing and tough lawn that is ideal for coastal areas and poolside due to its high salt-tolerance.
                    </p>
                    <div align="center" class="mb-4 buttona">
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="products/couch.php">View Product:  <i class="far fa-question-circle"></i></a>
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="calculator.php?a=0">Start Order:  <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="mx-2">
                    <h4 class="mt-3">Kikuyu Grass</h4>
                    <hr />
                    <img src="Images/Grass/Kikuyugrass.jpg" class="rounded img-fluid m-3" width="200px" alt="Kikuyu Grass image"/>
                    <p class="lead">Cost: $10/m<sup>2</sup></p>
                    <p>
                        Kikuyu turf is one of the hardiest, best looking, cost-effective grasses on the market. Homeowners choose Kikuyu grass due to its high drought tolerance, excellent wear resistance and ability to maintain good winter colour.
                    </p>
                    <div align="center" class="mb-4 buttona">
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="products/kikuyu.php">View Product:  <i class="far fa-question-circle"></i></a>
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="calculator.php?a=1">Start Order:  <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
