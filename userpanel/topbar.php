<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cartphp.php"> <span class="fa fa-shopping-cart"></span> Cart
                            <?php
                            if (isset($_SESSION["cart"])) {
                                $count = count($_SESSION['cart']);
                                echo " <span id=\"cart_count\">$count</span> ";
                            } else {
                                echo " <span id=\"cart_count\">0</span> ";
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>