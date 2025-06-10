<?php
require_once("vendor/autoload.php");
require_once("Classes/Database.php");
require_once("Classes/Cart.php");
require_once("Classes/Product.php");
require_once("Models/UserDatabase.php");
require_once("Classes/CartItem.php");

use Stripe\LineItem;

$dbContext = new Database();
$userId = null;
$session_id = null;

if ($dbContext->getUserDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUserDatabase()->getAuth()->getUserId();
}
//$cart = $dbContext->getCartByUser($userId);
$session_id = session_id();
$cart = new Cart($dbContext, $session_id, $userId);

\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

$lineitems = [];
foreach ($cart->getItems() as $cartItem) {
    array_push($lineitems, [
        "quantity" => $cartItem->quantity,
        "price_data" => [
            "currency" => "sek",
            "unit_amount" => $cartItem->productPrice * 100,
            "product_data" => [
                "name" => $cartItem->productName
            ]
        ]
    ]);
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => $_ENV['SUCCESS_URL'],
    "cancel_url" => $_ENV['CANCEL_URL'],
    "locale" => "auto",
    "line_items" => $lineitems,
]);

http_response_code(303);
header("Location: " . $checkout_session->url);


?>