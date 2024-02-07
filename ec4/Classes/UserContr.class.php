<?php


class UserContr extends UserModel {
    private $cartModel;
    
    
    public function __construct() {
        parent::__construct();
        $this->cartModel = new CartModel();
    }


    public function setUserToSession() {
        $_SESSION["user"]["id"] = $this->getUserId();
        $_SESSION["user"]["name"] = $this->getUserName();
        $_SESSION["user"]["email"] = $this->getUserEmail();
        $_SESSION["user"]["role"] = $this->getUserRole();
    }



    public function initializeCart() {
        $this->cartModel->setUserId($this->getUserId());
        $hasOpenCart = $this->cartModel->selectOpenCartIdByUserId();
        if ($hasOpenCart) {
            $_SESSION["user"]["cart_id"] = $hasOpenCart->getCartId();
            $_SESSION["user"]["cart_status"] = $hasOpenCart->getCartStatus();
        }
    }
}