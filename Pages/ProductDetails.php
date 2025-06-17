<?php
require_once("Classes/Database.php");
require_once("Components/Headers.php");
require_once("Components/Navigation.php");
require_once("Components/HorizontalScroll.php");
require_once("Components/DocHeader.php");
require_once("Components/SingleProdDetail.php");
require_once("Components/Footer.php");



$dbContext = new Database();


?>

<?php DocHeader() ?>

<body>

    <?php Navigation() ?>

    <?php Headers() ?>

    <?php CatScroll() ?>

    <?php SingleProdDetail() ?>

    <?php Footer() ?>


    <script src="/assets/js/script.js"></script>

</body>