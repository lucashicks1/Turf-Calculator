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
    <link rel="shortcut icon" href="../favicon.ico">
    <meta name="Description" content="This page contains information about Couch Grass.">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>Turfs Up - Couch Grass</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../script.js"></script>

</head>

<body class="text-white bg-dark">

    <nav class="navbar navbar-expand-lg navbar-dark px-5">
        <a class="navbar-brand" href="../index.php">
            <img src="../Images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Company Logo"><span
                class="px-2">TURFS UP</span></a>
        <!-- Hamburger Menu -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">HOME<span class="sr-only">Home</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../products.php">PRODUCTS<span class="sr-only">Products</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../calculator.php">CALCULATOR<span class="sr-only">Calculator</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">ABOUT<span class="sr-only">About</span></a>
                </li>
            </ul>
            <span class="navbar-text">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php">CART - <i class="fas fa-shopping-cart"></i>
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
            <div class="col-12 col-lg-4 offset-lg-4">
                <h2 class="text-center">Couch Grass</h2>
                <hr />
            </div>
        </div>
    </div>

<div class="row text-center">
    <div class="col-10 offset-1 col-xl-8 offset-xl-2">
        <div class="row">
            <div class="col-12 col-md-4">
                    <img src="../Images/Grass/couchgrass.jpg" class="rounded img-fluid m-2" width="250px" alt="Couch Grass image"/>
                    <p class="lead">Couch Grass</p>
                </div>
            <div class="col-12 col-md-6 offset-md-2">
                <p class="mt-5">
                    Couch is a warm-season grass that is now known for its drought and wear tolerance, softness underfoot, greener colour and water efficiency. With a fine leaf blade that produces dense growth, Couch grass is ideal for a wide variety of uses and copes well with high wear situations such as backyards and sporting fields. One of Couch grass’ most favoured features is its natural dark green colour and ability to maintain good colour even in poorer quality soils compared to all other turf varieties.
                </p>
                <div class="row">
                    <div class="col-6">
                        <h5 class="align-bottom mt-3">Cost: 11/m<sup>2</sup></h5>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-outline-light btn-white mx-3 my-2" href="../calculator.php?a=0">Start Order:  <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-4 mx-5">
    <div class="row">
        <div class="col-12 col-lg-4 offset-lg-4">
            <h4 class="text-center">Lawn Characteristics</h4>
            <hr />
        </div>
    </div>
</div>

<!-- Lawn Characteristics row -->
<!-- Large Device: 1 row, 6 columns-->
<!-- Medium Device: 2 rows, 3 columns-->
<!-- Small Device: 3 rows, 2 columns-->
<div class="row text-center mt-4">
    <div class="col-6 col-md-4 col-lg-2 my-4">
        <i class="fas fa-tint-slash fa-2x pb-4"></i>
        <p>Drought Resistance:</p>
        <h6>High</h6>
    </div>
    <div class="col-6 col-md-4 col-lg-2 my-4">
        <i class="fas fa-cloud fa-2x pb-4"></i>
        <p>Shade Tolerance:</p>
        <h6>Up to 25%</h6>
    </div>
    <div class="col-6 col-md-4 col-lg-2 my-4">
        <i class="fas fa-shoe-prints fa-2x pb-4"></i>
        <p>Wear:</p>
        <h6>Very High</h6>
    </div>
    <div class="col-6 col-md-4 col-lg-2 my-4">
        <i class="fas fa-cog fa-2x pb-4"></i>
        <p>Maintenace:</p>
        <h6>High</h6>
    </div>
    <div class="col-6 col-md-4 col-lg-2 my-4">
        <i class="fas fa-leaf fa-2x pb-4"></i>
        <p>Leaf:</p>
        <h6>Fine</h6>
    </div>
    <div class="col-6 col-md-4 col-lg-2 my-4">
        <i class="fas fa-dollar-sign fa-2x pb-4"></i>
        <p>Price:</p>
        <h6>11/m<sup>2</sup></h6>
    </div>
</div>

</body>

</html>
