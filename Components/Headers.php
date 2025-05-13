<?php
require_once("Classes/Database.php");

function Headers()
{
    ?>
    <header class="head">
        <div class="head-container">

            <!-- Search -->
            <div class="search-container">
                <div class="search">
                    <form id="search-form" action="/search" method="GET">
                        <input type="text" name="" id="search-input" placeholder="Tjoho! Vad söker du idag?" />
                        <button type="submit" id="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>


        </div>

    </header>

    <?php
}

?>