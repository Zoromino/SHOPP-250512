<?php

class Cart
{
    private $dbContext;
    public $session_id;
    public $userId;
    public $cartItems = [];

    public function __construct($dbContext, $session_id, $userId = null)
    {
        $this->dbContext = $dbContext;
        $this->session_id = $session_id;
        $this->userId = $userId;
        $this->cartItems = $this->dbContext->getCartItems($userId, $session_id);
    }

    public function convertSessionToUser($userId, $newSessionId)
    {
        $this->dbContext->convertSessionToUser($this->session_id, $userId, $newSessionId);

        $this->userId = $userId;
        $this->session_id = $newSessionId;
    }

    public function addItem($productId, $quantity)
    {
        $item = $this->getCartItem($productId);
        if (!$item) {
            $item = new CartItem();
            $item->productId = $productId;
            $item->quantity = $quantity;
            array_push($this->cartItems, $item);
        } else {
            $item->quantity += $quantity;
        }
        $this->dbContext->updateCartItem($this->userId, $this->session_id, $productId, $item->quantity);
    }

    public function getCartItem($productId)
    {
        foreach ($this->cartItems as $item) {
            if ($item->productId == $productId) {
                return $item;
            }
        }
        return null;
    }

    public function removeItem($productId, $quantity)
    {
        $item = $this->getCartItem($productId);
        if (!$item) {
            return;
        }
        $item->quantity -= $quantity;
        $this->dbContext->updateCartItem($this->userId, $this->session_id, $productId, $item->quantity);
        if ($item->quantity <= 0) {
            array_splice($this->cartItems, array_search($item, $this->cartItems), 1);
        }
    }

    public function getItems()
    {
        return $this->cartItems;
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->cartItems as $item) {
            $totalPrice += $item->rowPrice;
        }

        return $totalPrice;
    }

    public function getItemsCount()
    {
        $totalQuantity = 0;
        foreach ($this->cartItems as $item) {
            $totalQuantity += $item->quantity;
        }

        return $totalQuantity;
    }

    public function clearCart()
    {
        $this->cartItems = [];
    }

    public function removeCompletely($productId)
    {
        $item = $this->getCartItem($productId);
        if (!$item) {
            return;
        }
        $item->quantity = 0;
        $this->dbContext->updateCartItem($this->userId, $this->session_id, $productId, $item->quantity);
        if ($item->quantity <= 0) {
            array_splice($this->cartItems, array_search($item, $this->cartItems), 1);
        }
    }


}

?>