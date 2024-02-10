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

        $this->cartModel->setCartUserId($_SESSION["user"]["id"]);
        // select open cart from DB if any
        $hasOpenCart = $this->cartModel->selectOpenCartIdByUserId();

        // ONLY ID HERE ... TODO!
        
        if ($hasOpenCart) {
            // load open cart to Session
            $_SESSION["user"]["cart_id"] = $hasOpenCart->getCartId();
            $this->cartModel->setCartId($_SESSION["user"]["cart_id"]);

            $_SESSION["user"]["cart_status"] = $hasOpenCart->getCartStatus();
            $this->cartModel->setCartStatus($_SESSION["user"]["cart_status"]);

            $_SESSION["user"]["cart_items"] = $this->cartModel->selectCartItemsByCartId();
        }
        else {
            $newCart = 
        }
    }
}