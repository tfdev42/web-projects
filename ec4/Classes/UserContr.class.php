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
        $this->initializeCart();

    }



    public function initializeCart() {

        $this->cartModel->setCartUserId($_SESSION["user"]["id"]);
        // select open cart from DB if any        
        $hasOpenCart = $this->cartModel->selectOpenCartByUserId();        

        if ($hasOpenCart) {
            $this->loadOpenCartToSession($hasOpenCart);
        }
        else {
            $newCartId = $this->cartModel->insertNewCartByUserId();
            if ($newCartId) {
                $this->cartModel->setCartId($newCartId);
                $this->loadOpenCartToSession($this->cartModel);
            }
        }
    }

    /**
     * loads an open cart with an empty array or array of products to  user Session
     */
    public function loadOpenCartToSession(CartModel $cartModel) {
        // load open cart to Session            
        $_SESSION["user"]["cartObj"] = $cartModel;
        $cartItems = $cartModel->selectCartItemsByCartId();
        // is an empty Array() if no items in there
        $_SESSION["user"]["cartItems"] = $cartItems;
    }
}