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
// $router->addRoute('/', function () {
//     require_once(__DIR__ . '/');
// });
// $router->addRoute('/', function () {
//     require_once(__DIR__ . '/');
// });
// $router->addRoute('/', function () {
//     require_once(__DIR__ . '/');
// });




$router->dispatch();


?>