<?php

class CartModel {
    
    public $cartId;
    public $fkUserId;
    public $createdOn;
    public $cartStatus;
    public $dbh;    


    public function __construct() {          
        $this->cartId;
        $this->fkUserId;
        $this->createdOn;
        $this->cartStatus;
        $this->dbh = new Dbh();        
    }

    public function getCartId(){
        return $this->cartId;
    }
    public function getCartUserId(){
        return $this->fkUserId;
    }
    public function getCartStatus(){
        return $this->cartStatus;
    }    
    public function getCreatedOn(){
        return $this->createdOn;
    }


    public function setCartId($cartId){
        $this->cartId = $cartId;
    }
    public function setCartUserId($fkUserId){
        $this->fkUserId = $fkUserId;
    }
    public function setCartStatusClosed(){
        $this->cartStatus = 'closed';
    }
    public function setCartStatus($status){
        $this->cartStatus = $status;
    }
    public function setCreatedOn($createdOn){
        $this->createdOn = $createdOn;
    }


    // public function selectOpenCartItemsByUserId() {
    //     $query =
    //     "SELECT cart.cart_id AS 'cartId', cart_item.fk_product_id AS 'ProductID', cart_item.quantity
    //         FROM cart
    //             INNER JOIN cart_item ON cart.cart_id = cart_item.fk_cart_id
    //             WHERE cart.fk_user_id = :userId
    //             AND cart.cart_status = 'open';";
    // }
    
    /**
     * returns an Array() of cartItems or empty Array()!
     */
    public function selectCartItemsByCartId(){
        $query =
        "SELECT * 
            FROM cart_item 
            WHERE fk_cart_id = :cartId;";

        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue("cartId", $this->cartId, PDO::PARAM_INT);
        $stmt->execute();
        
        $cartItems = [];
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            // Create a CartItem object and populate its properties
            $cartItem = new CartItemModel();
            $cartItem->setCartItemId($row->cart_item_id);
            $cartItem->setFkCartId($row->fk_cart_id);
            $cartItem->setFkProductId($row->fk_product_id);
            $cartItem->setQuantity($row->quantity);
            
            // Add the CartItem object to the array
            $cartItems[] = $cartItem;
        }
        
        return $cartItems;
    }

    public function selectOpenCartIdByUserId() {
        $query =
        "SELECT cart_id 
            FROM cart 
            WHERE fk_user_id = :userId 
                AND cart_status = 'open';";

        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue(":userId", $_SESSION["user"]["id"]);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * returns an open CartModel by UserId if found
     */
    public function selectOpenCartByUserId() {
        $query =
        "SELECT * 
            FROM cart 
            WHERE fk_user_id = :userId 
                AND cart_status = 'open';";

        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue(":userId", $_SESSION["user"]["id"]);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $cart = new CartModel();
            $cart->setCartId($result->cart_id);
            $cart->setCartUserId($result->fk_user_id);
            $cart->setCreatedOn($result->created_on);
            $cart->setCartStatus($result->cart_status);
            return $cart;
        }
        return $result;
    }

    /**
     * returns the new cart_id (LastInsertedID) if true, or false
     */
    public function insertNewCartByUserId() {
        $query =
        "INSERT INTO cart (fk_user_id) VALUES (:userId);";
        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue(":userId", $_SESSION["user"]["id"], PDO::PARAM_INT);
        
        $stmt->execute() ? $this->dbh->connect()->lastInsertId() : false;
    }


    


}