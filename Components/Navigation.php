<?php
require_once("Classes/Database.php");


function Navigation()
{

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
                                    <li><a href="#!"></a></li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </div>

            </div>
        </div>

        <!-- Logan -->
        <div class="logo-container">
            <div class="logo"><a href="#!"></a>CoolGoods</div>
        </div>

        <!-- User/Cart Icon -->
        <div class="icon-container">
            <div class="user-icon">
                <a href="#!"><i class="fa-solid fa-user-secret"></i></a>
            </div>
            <div class="cart-icon">
                <!-- <a href="#!"><i class="fa-solid fa-cart-shopping"></i></a> -->
                <a href="#!"><i class="fa-solid fa-basket-shopping"></i></a>
            </div>
        </div>

    </nav>


    <?php
}

?>