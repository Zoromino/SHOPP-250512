<?php
require_once("Classes/Database.php");
require_once("Classes/Product.php");
require_once("Classes/Cart.php");
require_once("Classes/CartItem.php");


function Checkout()
{
    $dbContext = new Database();
    $userId = null;
    $session_id = null;

    if ($dbContext->getUserDatabase()->getAuth()->isLoggedIn()) {
        $userId = $dbContext->getUserDatabase()->getAuth()->getUserId();
    }

    $session_id = session_id();
    $cart = new Cart($dbContext, $session_id, $userId);
    ?>

    <div class="cart-checkout">
        <div class="checkout-container">
            <div class="">
                <div class="">
                    <h4>Din kundvagn</h4>
                    <ul id="" class=""><?php foreach ($cart->getItems() as $cartItem) { ?>
                            <li class="">
                                <!-- Cart image -->
                                <div></div>

                                <!-- Cart name -->
                                <div class="cart-name">
                                    <span class="item-name"><?php echo $cartItem->productName; ?></span>
                                </div>

                                <!-- Cart price -->
                                <div class="cart-price">
                                    <span class="item-price"><?php echo $cartItem->productPrice; ?></span>
                                </div>

                                <!-- Cart btn -->
                                <div class="cart-btn">
                                    <button class="quantity-btn decrease" onclick="">-</button>
                                    <span class="item-quantity"></span>
                                    <button class="quantity-btn increase" onclick="">+</button>
                                </div>

                                <!-- Cart checkout -->
                                <div class="cart-checkout">
                                    <a href="/checkout" class="checkout-btn">Till kassan</a>
                                </div>

                            </li><?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <?php



}

?>