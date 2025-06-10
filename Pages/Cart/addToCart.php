<?php
require_once("Classes/Cart.php");
require_once("Classes/Database.php");

$dbContext = new Database();

$productId = $_GET['productId'] ?? "";
$fromPage = $_GET['fromPage'] ?? "";

$userId = null;
$session_id = null;

if ($dbContext->getUserDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUserDatabase()->getAuth()->getUserId();
}

$session_id = session_id();
$cart = new Cart($dbContext, $session_id, $userId);
$cart->addItem($productId, 1);

header("Location:$fromPage");


?>