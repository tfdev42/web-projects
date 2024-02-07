<?php


class UserContr extends UserModel {
    private $cartModel;
    
    
    public function __construct() {
        parent::__construct();
        $this->cartModel = new CartModel();
    }


    public function setUserToSession() {
        
    }



    public function initializeCart() {
        
    }
}