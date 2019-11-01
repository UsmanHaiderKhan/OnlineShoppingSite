<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700|Raleway:400,500,600,700,800&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
    <title>Shopping | Cart</title>
</head>
<body class="bg-light">
<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="opacity: .98">
        <div class="container">
            <a class="navbar-brand" href="AdvCart.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#clothes">Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#clothes">MEN'S</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Contact us</a>
                    </li>

                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="cartphp.php"> Cart
                            <?php
                            if (isset($_SESSION["cart"])) {
                                $count = count($_SESSION['cart']);
                                echo "
                                  <span class=\"p1 fa-stack fa-lg has-badge\" data-count=\"$count\">
                                 
                                    <i class=\"p3 fa fa-shopping-cart fa-stack-1x xfa-inverse\" data-count=\"\"></i>
                                  </span>
                                ";
                            } else {
                                echo "
                                  <span class=\"p1 fa-stack fa-lg has-badge\" data-count=\"0\">
                                 
                                    <i class=\"p3 fa fa-shopping-cart fa-stack-1x xfa-inverse\" data-count=\"0b\"></i>
                                  </span>
                                ";
                            }
                            ?>
                        </a>
                    </li>

                    <?php
                    if (empty($_SESSION['admin'])) {
                        ?>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="../admin/admin_login.php"><span class="fa fa-user-circle"></span>
                                Login</a>
                        </li>
                        <?php

                    } else {
                        ?>

                        <li class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <?php

                                $username = $_SESSION['admin']['username'];
                                echo $username; ?>

                                <img src="../admin/<?php echo $user_image = $_SESSION['admin']['user_image']; ?>"
                                        style="width: 70px;height:70px;border-radius:50%" alt="">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../admin/logout.php">Logout</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                    </a>

                </ul>
            </div>
        </div>
    </nav>
</header>