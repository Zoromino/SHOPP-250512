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

$productId = $_POST['productId'] ?? null;

if ($productId !== null) {
    $cart->removeCompletely($productId);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "No productId"]);
}
