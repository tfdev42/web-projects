<?php


class UserContr {
    public $cartModel;
    public $userModel;
    
    
    public function __construct() {
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
    }


    public function setUserToSession() {
        $_SESSION["user"]["id"] = $this->userModel->getUserId();
        $_SESSION["user"]["name"] = $this->userModel->getUserName();
        $_SESSION["user"]["email"] = $this->userModel->getUserEmail();
        $_SESSION["user"]["role"] = $this->userModel->getUserRole();
    }



    public function initializeCart() {
        $this->cartModel->setUserId($this->userModel->getUserId());
        $hasOpenCart = $this->cartModel->selectOpenCartIdByUserId();
        if ($hasOpenCart) {
            $_SESSION["user"]["cart_id"] = $hasOpenCart->getCartId();
            $_SESSION["user"]["cart_status"] = $hasOpenCart->getCartStatus();
        }
    }
}