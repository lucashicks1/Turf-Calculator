<?php
session_start();
if (empty($_SESSION['totals'])) {
    // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
    $_SESSION["totals"] = [0, 0, 0, 0, 0, 0];
    // Name, Turf Type, Length, Width, Area, Weight, Cost of Turf m/2, Preperation op, lay op, Total Turf Cost, Labour
    $_SESSION["cart"] = [];
}
// If the user clicked the delete button
if (isset($_POST['deletebutton'])) {
    // Gets the index of the array that needs to be deleted
    $val = $_POST['deletebutton'];
    $lawn = $_SESSION['cart'][$val];
    $totals = $_SESSION['totals'];

// Updates the totals session variable
    $totals[1] -= $lawn[9];
    $totals[2] -= $lawn[5];
    $totals[3] = ceil($totals[2] / 100) * 60;
    $totals[4] -= $lawn[10];
    $totals[5] -= 1;
    $totals[0] = $totals[1] + $totals[3] + $totals[4];
    $_SESSION['totals'] = $totals;

// Deletes the array from the multi-dimensional array
    unset($_SESSION['cart'][$val]);
    // Re-indexes the array so the indexs are consecutive
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // STRUCTURE - [total, turftotal, totalWeight, totalDelivery, totalLabour, totalLawns]
    // Redirects to the cart page so that the user can't refresh the page and then delete another lawn accidentally
    header('Location: cart.php?actionop=d');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="Description" content="This page displays the user's cart with the total cost of all items.">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Turfs Up - Cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
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
                    <li class="nav-item active">
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
                <h2 class="text-center">SHOPPING CART</h2>
            </div>
        </div>
    </div>


    <?php

// Checks if the cart isn't empty
    if (!empty($_SESSION['cart'])) {
        echo '
        <form action="cart.php" method="post" id="deleteform"></form>
        <form action="edit.php" method="post" id="modform"></form>
        <div class="row mx-1">
            <div class="col-10 offset-1">
                <div class="row my-4">
                    <div class=" col-12 col-xl-9 table-responsive-xl">
                        <table class="table-dark table-hover table-striped text-center">
                            <tr>
                                <th>Lawn Name</th>
                                <th>Turf Type</th>
                                <th>Turf Cost/m<sup>2</sup></th>
                                <th>Length (mm)</th>
                                <th>Width (mm)</th>
                                <th>Area</th>
                                <th>Ground Preperation</th>
                                <th>Turf Laying</th>
                                <th>Labour Cost</th>
                                <th>Total Turf Cost</th>
                                <th>Total</th>
                                <th>Options</th>
                            </tr>';
        // Turns the multi-dimensional array that is stored in the session variable as a local variable
        $cart = $_SESSION['cart'];
        $turflist = [["Couch Grass", 11], ["Kikuyu Grass", 10], ["Buffalo Grass", 16]];
        // Iterates through each array in the multi-dimensional array
        for ($i = 0; $i < count($cart); $i++) {
        // Gets the labour options and turns them into strings that will be printed
            if ($cart[$i][7] == 1) {
                $a = "Yes";
            } else {
                $a = "No";
            }
            if ($cart[$i][8] == 1) {
                $b = "Yes";
            } else {
                $b = "No";
            }
            // Creates the t variable
            // $t = 0;
            // Iterates through the turflist and tries to identify what turf the user selected (used to print the price)
            // for ($j = 0; $j < count($turflist); $j++) {
            //     if ($cart[$i][1] == $turflist[$j][0]) {
            //         $t = $j;
            //     }
            // }
            $type = $turflist[$cart[$i][1]][0];
            $price = $turflist[$cart[$i][1]][1];
            $tot = ($cart[$i][9] + $cart[$i][10]);
            // Prints out the lawn information as a table row
            printf( '
                        <tr>
                        <td>%s</td>
                        <td>%s</td>
                        <td class="tda">$%s/m<sup>2</sup></td>
                        <td class="tda">%.2fm</td>
                        <td class="tda">%.2fm</td>
                        <td class="tda">%sm<sup>2</sup></td>
                        <td class="tda">%s</td>
                        <td class="tda">%s</td>
                        <td class="tda">$%.2f</td>
                        <td class="tda">$%.2f</td>
                        <td>$%.2f</td>
                        <td>
                        <div align="center">
                            <table>
                                <tr>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal%s">
                                        <i class="far fa-trash-alt"></i> Remove
                                    </button>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-secondary" form="modform" name="modbutton" value="%s">
                                            <i class="fas fa-cog"></i> Modify
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="modal fade text-dark" id="Modal%s" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Remove item from cart?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="container-fluid">
                                  <div class="modal-body">
                                    Are you sure that you want to remove this item from cart?
                                  </div>
                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-danger" form="deleteform" name="deletebutton" value="%s">Remove</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </td>
                        </tr>

                        ',$cart[$i][0],$type,$price,$cart[$i][2],$cart[$i][3],$cart[$i][4],$a,$b,$cart[$i][10],$cart[$i][9],$tot,$i,$i,$i,$i);
        }
        $totalvals = $_SESSION['totals'];
        // Prints out the total values
        printf( '
                </table>
            </div>
            <div class="col-8 col-xl-2 col-md-4 offset-md-3 offset-xl-1 buttona offset-2 text-right">
                <h3 class="mb-4">Order Summary:</h3>
                <p class="text-right">Total Weight: %.2fkg</p>
                <p class="text-right">Turf Total: $%.2f</p>
                <p class="text-right">Deilvery Cost: $%.2f</p>
                <p class="text-right">Labour Cost: $%.2f</p>
                <h5 class="my-4 text-right">Total: $%.2f</h5>
                <a href="#" data-toggle="popover" data-trigger="focus" data-content="A payment system will be added in Version 2." class="btn btn-outline-light btn-white">Order</a>
            </div>
        </div>
        </div>
        </div>
        ',$totalvals[2],$totalvals[1],$totalvals[3],$totalvals[4],$totalvals[0]);
        // The cart must be empty then
    } else {
        echo '
        <div class="container text-center">
            <h5>Your cart is empty</h3>
            <p>You can add turf to your cart at the turf calculator. <a href="calculator.php">View the calculator here.</a></p>
        </div>
        ';
    }

// Checks if the user has deleted an item
    if (isset($_GET['actionop'])) {
        if ($_GET['actionop'] == 'd'){
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success: </strong>Your item was removed from cart.
                </div>
            </div>
            ';
// Checks if the user has changed an item to a duplicate lawn name
        } else if ($_GET['actionop'] == 'a'){
            echo '
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning: </strong>Your order was not modified since you already have an order with the same lawn name.
                </div>
            </div>
            ';
        }
// Modifed message
        else{
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success: </strong>Your sucessfully modified one of your turf configurations.
                </div>
            </div>
            ';
        }
    }
    ?>

</body>

</html>
