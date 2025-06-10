<?php
require_once("Classes/Database.php");
require_once("Classes/Cart.php");

$dbContext = new Database();

$productId = $_GET['productId'] ?? "";
$fromPage = $_GET['fromPage'] ?? "";
// $removCount = $_GET['remonCount'] ?? "";

$userId = null;
$session_id = null;

if ($dbContext->getUserDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUserDatabase()->getAuth()->getUserId();
}
$session_id = session_id();

$cart = new Cart($dbContext, $session_id, $userId);
$cart->removeItem($productId, 1);
$cart = new Cart($dbContext, $session_id, $userId);


$jsonData = json_encode([
    "status" => "success",
    "message" => "Product added to cart",
    "cart" => $cart->getItems(),
    "cartCount" => $cart->getItemsCount(),
    "totalPrice" => $cart->getTotalPrice(),
]);


echo $jsonData

    ?>