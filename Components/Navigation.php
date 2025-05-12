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
        </div>
    </nav>


    <?php
}

?>