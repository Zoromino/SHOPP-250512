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

    <section class="cart-checkout-container">
        <div class="checkout-box">
            <div class="">
                <div class="cart-list">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Row Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart->getItems() as $item) {
                                ?>
                                <tr>
                                    <td>
                                        <img class="cart-img" src="<?php echo $item->imageUrl; ?>" alt="..." />
                                    </td>
                                    <td>
                                        <span class="cart-name"> <?php echo $item->productName; ?></span>
                                    </td>
                                    <td>
                                        <div class="checkout-btn">
                                            <button class="quantity-btn decrease"
                                                onclick="removeFromCart(<?php echo $item->productId; ?>)"
                                                data-product-id="<?php echo $item->productId; ?>">-</button>

                                            <span class="item-quantity"
                                                id="quantityDecreShow<?php echo $item->productId; ?>"><?php echo $item->quantity; ?></span>

                                            <button onclick="addToCart(<?php echo $item->productId; ?>)"
                                                class="quantity-btn increase"
                                                data-product-id="<?php echo $item->productId; ?>">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $item->productPrice; ?>
                                    </td>
                                    <td>
                                        <span><?php echo $item->rowPrice; ?></span>
                                    </td>
                                    <td>
                                        <button class="trash-icon-btn"
                                            onclick="removeCompletely(<?php echo $item->productId; ?>)">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            } ?>

                        </tbody>
                    </table>
                    <div class="cart-total">
                        Totalt: <span id="cart-total-price"><?php echo $cart->getTotalPrice(); ?>kr</span>
                    </div>
                    <div class="cart-checkout">
                        <a href="/checkout" class="checkout-btn">Till kassan</a>
                    </div>
                </div>
            </div>

        </div>
    </section>



    <?php



}

?>