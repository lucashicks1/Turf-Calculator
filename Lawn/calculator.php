<?php
session_start();
if (empty($_SESSION["totals"])) {
    // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
    $_SESSION["totals"] = [0, 0, 0, 0, 0, 0];
    // ID, Name, Turf Type, Length, Width, Area, Weight, Cost of Turf m/2, Preperation op, lay op, Total Turf Cost, Labour
    $_SESSION["cart"] = [];
}

// Checks if submit is a variable that is set
if (isset($_POST['submit'])) {
    // Checks if the lawn name that the user entered is already used
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        // Converts the string to all lowercase
        if (strtolower($_SESSION['cart'][$i][0]) == strtolower($_POST['lawnname'])) {
            $dup = True;
        }
    }
    // Checks if there is a duplicate
    // IF NOT:
    if (!isset($dup)) {
        // Turf Info
        $turflist = [["Couch Grass", 11], ["Kikuyu Grass", 10], ["Buffalo Grass", 16]];
        // Removes any 0s on the left of the string eg: 0011 -> 11
        $length = ltrim($_POST['length'], '0');
        // Removes any 0s on the left of the string eg: 0011 -> 11
        $width = ltrim($_POST['width'], '0');
        // Rounds the area up to the nearest whole number
        $area = ceil($length * $width);
        // Gets the type of turf that the user selected
        $turftype = $_POST['turftype'];
        // Gets the price of the turf
        $turfval = $turflist[$turftype][1];

        // Sets both labour options to 0 by default
        $layop = 0;
        $prepop = 0;
        // If the user checked the box, they will be changed into a 1
        if (isset($_POST['layop'])) {
            $layop = 1;
        }
        if (isset($_POST['prepop'])) {
            $prepop = 1;
        }
        // Calculates area (this is why both layop and prepop are 0 or 1 values)
        $labour = ($area * $layop * 12) + ($area * $prepop * 30);
        // ID, Name, Turf Type, Length, Width, Area, Weight, Cost of Turf m/2, Preperation op, lay op, Total Turf Cost, Labour
        // Saves all the lawn info into a variable as an array
        $lawn = [$_POST['lawnname'], $turftype, $length, $width, $area, $area * 8, $turfval, $prepop, $layop, $area * $turfval, $labour];
        // Pushes this array into the session value ('cart')
        array_push($_SESSION['cart'], $lawn);
        // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
        // Updates the totals session array
        $totals = $_SESSION['totals'];
        $totals[1] += $lawn[9];
        $totals[2] += $area * 8;
        $totals[3] = ceil($totals[2] / 100) * 60;
        $totals[4] += $labour;
        $totals[5] += 1;
        $totals[0] = $totals[1] + $totals[3] + $totals[4];
        $_SESSION['totals'] = $totals;
        // Variable used to create an alert notifying the user that there turf order was sucessful
        $result = True;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="Description" content="This page is the a turf calculator which is used by customers to order specific amounts of turf.">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Turfs Up - Calculator</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="products.php">PRODUCTS<span class="sr-only">Products</span></a>
                </li>
                <li class="nav-item active">
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


    <div class="container text-center">
        <h3 class="my-4">TURF CALCULATOR</h2>
        <form action="calculator.php" method="post" class="my-4">
            <div class="col-8 offset-2">
                <h5 class="my-3">Lawn Information:</h5>
                <div class="form-group">
                    <label>
                        <p>Lawn Name:<br/>
                        Note: Can't share a name with an existing turf configuration</p>
                    </label>
                    <input type="text" class="form-control" placeholder="Lawn Name:" name="lawnname" maxlength="16" required aria-label="Lawn Name Input">
                </div>
                <div class="form-group">
                    <label>Lawn Length (m):</label>
                    <input type="number" class="form-control" placeholder="Lawn Length (m):" name="length" required min="0.01" max="1000" step="0.01" aria-label="Lawn Length Input">
                </div>
                <div class="form-group">
                    <label>Lawn Width (m):</label>
                    <input type="number" class="form-control" placeholder="Lawn Width (m):" name="width" required min="0.01" max="1000" step="0.01" aria-label="Lawn Width Input">
                </div>
                <p>Type of Turf:</p>
                <div class="form-group">
                    <select class="form-control" name="turftype" required aria-label="Turf Type Select">

                        <?php
                        // Checks to see if the user already preselected a turf option - via the product page
                        $a = $_GET['a'];
                            if ($a == 0){
                                echo '
                                <option value=0 selected>Couch Grass - $11/m<sup>2</sup></option>
                                <option value=1>Kikuyu Grass - $10/m<sup>2</sup></option>
                                <option value=2>Buffalo Grass - $16/m<sup>2</sup></option>
                                ';
                            } else if ($a == 1){
                                echo '
                                <option value=0>Couch Grass - $11/m<sup>2</sup></option>
                                <option value=1 selected>Kikuyu Grass - $10/m<sup>2</sup></option>
                                <option value=2>Buffalo Grass - $16/m<sup>2</sup></option>
                                ';
                            } else{
                                echo '
                                <option value=0>Couch Grass - $11/m<sup>2</sup></option>
                                <option value=1>Kikuyu Grass - $10/m<sup>2</sup></option>
                                <option value=2 selected>Buffalo Grass - $16/m<sup>2</sup></option>
                                ';
                            }

                         ?>
                    </select>
                </div>
                <h5 class="my-3">Labour Options:</h5>
                <div class="custom-control custom-checkbox py-3">
                    <input class="custom-control-input" type="checkbox" value="True" name="prepop" id="Groundprep">
                    <label class="custom-control-label" for="Groundprep">
                        Ground Preperation ($30 per m<sup>2</sup>) - Strongly Recommended
                    </label>
                </div>
                <div class="custom-control custom-checkbox py-3">
                    <input class="custom-control-input" type="checkbox" value="True" name="layop" id="Turflay">
                    <label class="custom-control-label" for="Turflay">
                        Professional Turf Laying ($12 per m<sup>2</sup>)
                    </label>
                </div>
                <button type="submit" class="btn btn-outline-light btn-white" name="submit">Order</button>
            </div>
        </form>
    </div>

    <?php
    // Checks to see if the user has clicked submit
    if (isset($_POST['submit'])) {
        // If the user's order was succesful, it creates an alert at the bottom
        if (isset($result)) {
            echo '
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success: </strong>Your order was added to cart. <a href="cart.php">View your cart here.</a>
            </div>
        </div>
        ';
        } else {
            // Displays an error alert telling them that there was already a lawn with the same lawn name
            echo '
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning: </strong>Your order was not added to cart since you already have an order with the same lawn name.
            </div>
        </div>
        ';
        }
    }
    ?>



</body>

</html>
