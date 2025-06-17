<?php
require_once("Components/DocHeader.php");
require_once("Components/Headers.php");
require_once("Components/Navigation.php");
require_once("Components/HorizontalScroll.php");
require_once("Components/CheckoutView.php");
require_once("Components/Footer.php");

?>

<?php DocHeader() ?>

<body>

    <?php Navigation() ?>

    <?php Headers() ?>

    <?php CatScroll() ?>

    <?php Checkout() ?>

    <?php Footer() ?>

    <script src="/assets/js/script.js"></script>

</body>