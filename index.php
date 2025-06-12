<?php
ob_start();
// session_start();
require_once("Classes/Router.php");
require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();

$router = new Router();
$router->addRoute('/', function () {
    require_once(__DIR__ . '/pages/home.php');
});
$router->addRoute('/category', function () {
    require_once(__DIR__ . '/pages/categorys/allcategorys.php');
});
$router->addRoute('/product', function () {
    require_once(__DIR__ . '/pages/productdetails.php');
});
$router->addRoute('/search', function () {
    require_once(__DIR__ . '/pages/viewsearch.php');
});
$router->addRoute('/addToCart', function () {
    require_once(__DIR__ . '/pages/cart/addToCart.php');
});
$router->addRoute('/viewCart', function () {
    require_once(__DIR__ . '/pages/cart/viewCart.php');
});
$router->addRoute('/checkout', function () {
    require_once(__DIR__ . '/pages/cart/checkout.php');
});
$router->addRoute('/api/addToCart', function () {
    require_once(__DIR__ . '/apicode/IncrestItem.php');
});
$router->addRoute('/api/removeFromCart', function () {
    require_once(__DIR__ . '/apicode/DecrestItems.php');
});
$router->addRoute('/api/removeCompletely', function () {
    require_once(__DIR__ . '/apiCode/removeitems.php');
});
$router->addRoute('/viewSuccess', function () {
    require_once(__DIR__ . '/pages/cart/viewSuccess.php');
});
// $router->addRoute('/', function () {
//     require_once(__DIR__ . '/');
// });





$router->dispatch();


?>