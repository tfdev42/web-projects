<?php

class CartModel {
    
    protected $cartId;
    protected $userId;
    protected $createdOn;
    protected $cartStatus;
    protected $dbh;
    protected $userModel;


    public function __construct() {          
        $this->cartId;
        $this->userId;
        $this->createdOn;
        $this->cartStatus;
        $this->dbh = new Dbh();
        // $this->userModel = new UserModel();
    }

    public function getCartStatus(){
        return $this->cartStatus;
    }
    public function getCartId(){
        return $this->cartId;
    }
    public function getCartUserId(){
        return $this->userId;
    }
    public function getCreatedOn(){
        return $this->createdOn;
    }


    public function setCartId($cartId){
        $this->cartId = $cartId;
    }
    public function setCartUserId($cartId){
        $this->cartId = $cartId;
    }

    public function setCartStatusOpen(){
        $this->cartStatus = 'open';
    }

    public function setCartStatusClosed(){
        $this->cartStatus = 'closed';
    }

    public function setCartStatus(string $status){
        $this->cartStatus = $status;
    }


    public function selectOpenCartItemsByUserId() {
        $query =
        "SELECT cart.cart_id AS 'cartId', cart_item.fk_product_id AS 'ProductID', cart_item.quantity
            FROM cart
                INNER JOIN cart_item ON cart.cart_id = cart_item.fk_cart_id
                WHERE cart.fk_user_id = :userId
                AND cart.cart_status = 'open';";
    }

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
            $cartItem->setCartId($row->fk_cart_id);
            $cartItem->setProductId($row->fk_product_id);
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


    public function insertNewCartByUserId() {
        $query =
        "INSERT INTO cart (fk_user_id) VALUES (:userId);";
        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue(":userId", $_SESSION["user"]["id"], PDO::PARAM_INT);
        return $stmt->execute();
    }


    


}