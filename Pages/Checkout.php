<?php
require_once("vendor/autoload.php");
require_once("Classes/Database.php");
require_once("Classes/Cart.php");
require_once("Classes/Product.php");
require_once("");

$dbContext = new Database();
$userId = null;
$session_id = null;

// $line_items = [];
// foreach($cart->getItems() as $cartItem){
//     array_push($line_items, [
//         "quantity" => $cartItem->quantity,
//         "price_data" => [
//             "currencey" => "sek",
//             "unit_amount" => $cartitem->
//         ] 
//     ])
// }


// $checkout_session = \Strile\Checkout\Session::create([
//     "mode" => "payment",
//     "success_url" => "http://localhost:8000/checkoutsucess",
//     "cancel_url" => "http://localhost:8000",
//     "locale" => "auto",
//     "line_items" => "$lineitems",
// ]);

// http_response_code(303);
// header("Location: " . $checkout_session->url);


?>