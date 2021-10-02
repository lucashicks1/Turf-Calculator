<?php
session_start();
if (empty($_SESSION["totals"])) {
    // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
    $_SESSION["totals"] = [0, 0, 0, 0, 0, 0];
    // ID, Name, Turf Type, Length, Width, Area, Weight, Cost of Turf m/2, Preperation op, lay op, Total Turf Cost, Labours
    $_SESSION["cart"] = [];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="Description" content="This page allows the user to edit their order of turf.">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Turfs Up - Edit</title>
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

    <div class="my-4 mx-5">
        <div class="row">
            <div class="col-md">
                <h2 class="text-center">Edit Turf Configuration</h2>
            </div>
        </div>
    </div>

    <?php

// Checks if the user has clicked the modify button on the cart page
if (isset($_POST['modbutton'])){
    // Stores this as id so it can be used for list indexing
    $id = $_POST['modbutton'];
    // Finds the lawn in particular
    $lawn = $_SESSION['cart'][$id];
    $turflist = ["Couch Grass","Kikuyu Grass", "Buffalo Grass"];
    // Checks for the type of lawn
    $type = $lawn[1];
    // Prints out the form with the existing lawn configuration values already printed out
    echo '
    <div class="container text-center">
        <form action="edit.php" method="post" class="my-4">
            <div class="col-8 offset-2">
                <input type="hidden" id="Id" name="id" value="'.$id.'">
                <h5 class="my-3">Lawn Information:</h5>
                <div class="form-group">
                <p>Lawn Name:<br/>
                    Note: Can'.'t share a name with an existing turf configuration</p>
                    <input type="text" class="form-control" placeholder="Lawn Name:" name="lawnname" required  maxlength="16" value="'.$lawn[0].'" aria-label="Lawn Name Input">
                </div>
                <div class="form-group">
                    <label>Lawn Length (m):</label>
                    <input type="number" class="form-control" placeholder="Lawn Length (m):" name="length" required min="0.01" value="'.$lawn[2].'"  max="1000" aria-label="Lawn Length Input" step="0.01">
                </div>
                <div class="form-group">
                    <label>Lawn Width (m):</label>
                    <input type="number" class="form-control" placeholder="Lawn Width (m):" name="width" required min="0.01" value="'.$lawn[3].'"  max="1000" aria-label="Lawn Width Input" step="0.01">
                </div>
                <p>Type of Turf:</p>';
                // Used to preselect an option in the select input
                if ($type == 0){
                    echo '
                    <div class="form-group">
                        <select class="form-control" name="turftype" required aria-label="Turf Type Select">
                            <option value=0 selected>Couch Grass - $11/m<sup>2</sup></option>
                            <option value=1>Kikuyu Grass - $10/m<sup>2</sup></option>
                            <option value=2>Buffalo Grass - $16/m<sup>2</sup></option>
                        </select>
                    </div>
                    ';
                } else if ($type == 1){
                    echo '
                    <div class="form-group">
                        <select class="form-control" name="turftype" required>
                            <option value=0>Couch Grass - $11/m<sup>2</sup></option>
                            <option value=1 selected>Kikuyu Grass - $10/m<sup>2</sup></option>
                            <option value=2>Buffalo Grass - $16/m<sup>2</sup></option>
                        </select>
                    </div>
                    ';
                } else{
                    echo '
                    <div class="form-group">
                        <select class="form-control" name="turftype" required>
                            <option value=0>Couch Grass - $11/m<sup>2</sup></option>
                            <option value=1>Kikuyu Grass - $10/m<sup>2</sup></option>
                            <option value=2 selected>Buffalo Grass - $16/m<sup>2</sup></option>
                        </select>
                    </div>
                    ';
                }
                // Prechecks input boxes if they selected it previously
                echo '
                <h5 class="my-3">Labour Options:</h5>
                <div class="custom-control custom-checkbox py-3">
                    <input class="custom-control-input" type="checkbox" value="True" name="prepop" id="Groundprep"
                    ';
                if ($lawn[7] == 1){
                    echo' checked ';
                }
                echo '
                 >
                 <label class="custom-control-label" for="Groundprep">
                     Ground Preperation ($30 per m<sup>2</sup>) - Strongly Recommended
                 </label>
             </div>
             <div class="custom-control custom-checkbox py-3">
                 <input class="custom-control-input" type="checkbox" value="True" name="layop" id="Turflay"
                     ';
                if ($lawn[8] == 1){
                    echo' checked ';
                }
                echo '
                  >
                  <label class="custom-control-label" for="Turflay">
                      Professional Turf Laying ($12 per m<sup>2</sup>)
                  </label>
                  </div>
                <button type="submit" class="btn btn-outline-light btn-white" name="submit">Modify</button>
            </div>
        </form>
    </div>
    ';
// If they clicked the submit button
} else if (isset($_POST['submit'])){
    $id = $_POST['id'];
    // Checks for a duplicate
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if (strtolower($_SESSION['cart'][$i][0]) == strtolower($_POST['lawnname']) && $i != $id) {
            $dup = True;
        }
    }
    if (!isset($dup)) {
        $turflist = [["Couch Grass", 11], ["Kikuyu Grass", 10], ["Buffalo Grass", 16]];
        $length = ltrim($_POST['length'], '0');
        $width = ltrim($_POST['width'], '0');
        $area = ceil($length * $width );
        $turftype = $_POST['turftype'];
        $turfval = $turflist[$turftype][1];

        $layop = 0;
        $prepop = 0;
        if (isset($_POST['layop'])) {
            $layop = 1;
        }
        if (isset($_POST['prepop'])) {
            $prepop = 1;
        }
        $labour = ($area * $layop * 12) + ($area * $prepop * 30);
        // ID, Name, Turf Type, Length, Width, Area, Weight, Cost of Turf m/2, Preperation op, lay op, Total Turf Cost, Labour
        // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
        // Stores all the form info in an array
        $lawn = [$_POST['lawnname'], $turftype, $length, $width, $area, $area * 8, $turfval, $prepop, $layop, $area * $turfval, $labour];
        // Stores all the previously lawn info in another array
        $temp = $_SESSION['cart'][$id];

        $totals = $_SESSION['totals'];
        // Deleting the data from the totals array
        // Cost
        $totals[1] -= $temp[9];
        // Weight
        $totals[2] -= $temp[5];
        // Labour
        $totals[4] -= $temp[10];

        // Adding data from turf item back into totals array
        $totals[1] += $lawn[9];
        $totals[2] += $area * 8;
        $totals[3] = ceil($totals[2] / 100) * 60;
        $totals[4] += $labour;
        // Adding the total back together
        $totals[0] = $totals[1] + $totals[3] + $totals[4];
        // Updating the session variables with the local arrays
        $_SESSION['totals'] = $totals;
        $_SESSION['cart'][$id] = $lawn;
        // Redirects to the cart page
        header('Location: cart.php?actionop=m');
    }
    // Lawn name was duplicate
    else{
        // Redirects to the cart page and echos an alert telling the user that the lawn name they entered was a duplicate
        header('location: cart.php?actionop=a');
    }
    // Stops the user from accessing this page by just entering its address into the url bar
} else{
    // Redirects to the home page
    header('location: index.php');
}


?>

</body>

</html>
