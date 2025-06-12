<?php
require_once("Classes/Database.php");
require_once("Classes/CartItem.php");
require_once("Classes/Cart.php");

session_start();
$dbContext = new Database();

$userId = null;
if ($dbContext->getUserDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUserDatabase()->getAuth()->getUserId();
}
$session_id = session_id();
$cart = new Cart($dbContext, $session_id, $userId);

$productId = $_GET['productId'] ?? null;

if ($productId !== null) {
    $cart->removeCompletely($productId);

    $jsonData = json_encode([
        "status" => "success",
        "message" => "Product added to cart",
        "cart" => $cart->getItems(),
        "cartCount" => $cart->getItemsCount(),
        "totalPrice" => $cart->getTotalPrice(),
    ]);

    echo $jsonData;

    // echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "No productId"]);
}
