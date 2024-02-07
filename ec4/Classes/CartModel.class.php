<?php

class CartModel extends UserModel {
    
    private $cartId;
    private $cartStatus;


    public function __construct() {  
        parent::__construct(); 
        $this->cartId;
        $this->cartStatus;
    }

    public function getCartStatus(){
        return $this->cartStatus;
    }

    public function getCartId(){
        return $this->cartId;
    }


    public function setCartId($cartId){
        $this->cartId = $cartId;
    }

    public function setCartStatusOpen(){
        $this->cartStatus = 'open';
    }

    public function setCartStatusClosed(){
        $this->cartStatus = 'closed';
    }


    // public function getOpenCartByUserId($userId) {
    //     $query =
    //     "SELECT cart.cart_id, cart.created_on, cart.cart_status, cart_item.fk_product_id, cart_item.quantity
    //     FROM cart
    //     INNER JOIN cart_item ON cart.cart_id = cart_item.fk_cart_id
    //     WHERE cart.fk_user_id = :userId
    //       AND cart.cart_status = 'open';
    //     ";
    // }

    public function selectOpenCartIdByUserId() {
        $query =
        "SELECT cart_id FROM cart WHERE fk_user_id = :userId AND cart_status = 'open';";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":userId", $this->getUserId());
        $stmt->execute();

        return $stmt->fetch();
    }


    


}