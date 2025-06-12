<?php
require_once("Classes/Database.php");
require_once("Classes/CartItem.php");
require_once("Classes/Cart.php");


function Navigation()
{
    $dbContext = new Database();
    $catName = $_GET['catName'] ?? "";

    $userId = null;
    $session_id = null;

    if ($dbContext->getUserDatabase()->getAuth()->isLoggedIn()) {
        $userId = $dbContext->getUserDatabase()->getAuth()->getUserId();
    }

    $session_id = session_id();
    $cart = new Cart($dbContext, $session_id, $userId);
    ?>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="container-list">

                <!-- Dropdown Menu -->
                <div class="">
                    <section class="menu-nav">
                        <input id="menu-toggle" type="checkbox">
                        <label class="menu-btn-container" for="menu-toggle">
                            <div class="menu-btn"></div>
                        </label>

                        <!-- Submenu -->
                        <ul class="drop-menu">
                            <li class="drop-submenu">
                                <ul class="submenu">
                                    <div class="sale">
                                        <a href="/viewSale" class="sale-icon">
                                            <div class="sale-icon-container">
                                                <!-- Sale img -->
                                                <!-- <img class="sale-icon-img"
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEs0lEQVR4nO2ZW4hWVRTHf9akVpZjjoxGU3lJM4XEL6kenAjyISp8yDGQyIpxUCkp8jZkURRhEJpmSZeJZhK8hBRj+GAUeYl6GBp7yCivkFCizqhleKsvVvwPLA7nzHc73/cd0j9sOOy9Lv+9zz5rr7UPXML/F48Dh4ADwMtAXYTMUI2Z3EFgNinD/cA/QNa1P4FVQANQD7wEnAjJmM50UoIG4JiIzQEmAB3AefWdVcuqr0Myzeo7JhtVRQ2wU4TWh8Zu0hv5SxOxCdwSkmmX7ndA/0qRngQ0AU8ALcASYIOI7AGujtEboRaFQdI1Gxtls0U+zNftSU/irdDe9u00MLEE2xNlI87+6qQmMVIGe4D3gJXAcqAVWAQ0JuCjUbZaZXulfPXI96gEfDBDxmw/Vxrt8m3brGS8KGNLqTyWyrdxKBnrZawa8X56TEQsCrtlbCyVx1j5Ng5Fw0Lmu8AFnQN2ZlQalwNnlAFsAm4sRHmA9uYprcZJ4BmqhwXiYFz+UGQbmEvpVmCvlP4G2oDhVB/1wPvilBVH4xqLLyS4C8iQPkx2KdG2vgT3SegG0osGcTSuOQ+guaQXc8XRktBYPCihL0kvvhJH4xoLS6V7FXLtA/O4TlmpZahPAsNibExVBlsbkela/7gYPatRWiLaLCdTL24nFF37xEea8TzXNxo4oix1j6q/Xn18Hv3cd/Z0RH2S1WJE4SmN9ypZDNoPTmZeIXnf2xL+0PWtFfkR7u1YCPw8pHuvDq+tQHeRE6nrg1ubZN7JNYk79OpO6y0EaFf/3a7vTtXqHh8rPE6Vw0zCExklbsZlSpxQjVbRjC0OjWVcbfAjsEJkPWpV1lrdfhlwWG+30InsBrpcs+/RY7GTi0ybAoHuGIFaGd3oLhvstA0wXznZzcAQ5Wm2368scCKrVFwFzbZrvgv+XwTo7eOVzdG289Fti4wF0a0rplR9NMGtFWCKuPaELy1q9ZEej8mtLFJ9Ewp5a5X7DNPFRFYXbkNc26u4n/REhmsSxvna8OCnMvRLxD3TwyL9kz78XZJ9U+OrlZleFdJrlbPRbiLhdihH+D0Ssmncfpbs5qhZDtKJntV1po9a6Mx4Q3XBGmCaG5sJPBRhs06H2nhNsimiPZDjQGwORa2DLvswzpGwrfOZBH8r8ZonaYwDfhW3rS6IxKK/XpkpbCc9+Nptp7xvJe+RUifpQac4NRZzl2UpQVrQJk4WePJGkJzZgZQWLC+mVgou5Z4jPVgoTi8UovS6lOwGIy1YIE7GLW80ScnSgG+1ChnVG5VCP/lcJg4XxGlGoUaWuYw3aL/rMCw31ugc876Ny/Ol3PRl9P+vy/0nTOJXQhwaHfn9yobvA65I0smzcvAJ5cMm+TBfZcM1ur48X6a7r+uBc0pAB1NmBDX9q6H+gSp/Z6pCjIONPQLcFZEvvZJvTZ4EbtO3clQ3JfaL7HutZLC3O6PqBPUFBVnwu7pblaaF16OybT4qgnURdYVthx0uQ7XafozTGaO+rGS2Sydsp4MKokbl72uqCicowqHSNyi8jqtumabn4IK83m0zW/3HZKu5Sv9hYmFp9gcRq70un38baUSLKroDer6Eiwb/Ag07k8Xqw+vtAAAAAElFTkSuQmCC"
                                                    alt="sale--v1"> -->

                                                <!-- Sale img.gif -->
                                                <img class="sale-icon-img" src="assets/images/icons8red-sale.gif"
                                                    alt="sale">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="">
                                        <li>
                                            <a class="drop-category-item" href="/allCategorys">Alla kategorier</a>
                                        </li>
                                    </div>
                                    <?php foreach ($dbContext->getAllCategories() as $catName) {
                                        ?>

                                        <li>
                                            <a class="drop-category-item"
                                                href="/category?catName=<?php echo $catName; ?>"><?php echo $catName; ?></a>
                                        </li>

                                        <?php
                                    }
                                    ?>
                                    <!-- Search -->
                                    <div class="search-container">
                                        <div class="search">
                                            <form id="search-form" action="/search" method="GET">
                                                <input type="text" name="q" id="search-input"
                                                    placeholder="Tjoho! Vad söker du idag?" />
                                                <button type="submit" id="search-btn">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </div>

            </div>
        </div>

        <!-- Logan -->
        <div class="logo-container">
            <div class="logo"><a href="/" class="coolGods">CoolGoods</a></div>
        </div>

        <!-- User/Cart Icon -->
        <div class="icon-container">
            <div class="user-icon">
                <a href="#!" class="viewUser"><i class="fa-solid fa-user-secret"></i></a>
            </div>
            <div class="cart-icon">
                <!-- <a href="#!"><i class="fa-solid fa-cart-shopping"></i></a> -->
                <a href="/viewCart" class="viewCart">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span id="cart-count" class="cart-count"><?php echo $cart->getItemsCount(); ?></span>
                </a>
            </div>
        </div>

    </nav>


    <?php
}

?>