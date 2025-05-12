<?php
require_once("Classes/Database.php");


function Navigation()
{
    $dbContext = new Database();
    $catName = "";

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
            <!-- <div class="logo-container">
                <div class="logo"><a href="#!">HELLO</a></div>
            </div>
            <div class="icon-container">
                <div class="user-icon">
                    <i class="fa-solid fa-user-secret"></i>
                </div>
                <div class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div> -->
        </div>

        <div class="logo-container">
            <div class="logo"><a href="#!">HELLO</a></div>
        </div>
        <div class="icon-container">
            <div class="user-icon">
                <i class="fa-solid fa-user-secret"></i>
            </div>
            <div class="cart-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

    </nav>


    <?php
}

?>