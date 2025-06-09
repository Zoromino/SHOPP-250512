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

}

?>