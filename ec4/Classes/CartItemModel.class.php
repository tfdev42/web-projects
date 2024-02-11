<?php

class CartItemModel{

    public $cartItemId; // auto_increment
    public $fkCartId;
    public $fkProductId;
    public $quantity;

    public $unitPrice;
    public $totalPrice;
    public $dbh;


    public function __construct(){  
        $this->cartItemId;  
        $this->fkCartId;    
        $this->fkProductId;        
        $this->quantity;

        $this->unitPrice;
        $this->totalPrice;

        $this->dbh = new Dbh();
    }

    public function getCartItemId(){
        return $this->cartItemId;
    }
    public function getFkCartId(){
        return $this->fkCartId;
    }
    public function getFkProductId(){
        return $this->fkProductId;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getUnitPrice(){
        return $this->unitPrice;
    }
    public function getTotalPrice(){
        return $this->totalPrice;
    }


    public function setCartItemId($cartItemId){
        $this->cartItemId = $cartItemId;
    }
    public function setFkCartId($fkCartId){
        $this->fkCartId = $fkCartId;
    }
    public function setFkProductId($fkProductId){
        $this->fkProductId = $fkProductId;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
        $this->updateQuantityInDb();
    }
    public function setUnitPrice(){
        $product = new ProductModel();
        $product->setProductId($this->fkProductId);
        $unitPrice = $product->selectProductPriceByProdId();
        $this->unitPrice = $unitPrice;
    }
    public function setTotalPrice(){
        $this->totalPrice = $this->unitPrice * $this->quantity;
    }
    

    /**
     * return cart_item_id on successfull update, or FALSE
     */
    protected function updateQuantityInDb() {
        $query=
        "UPDATE cart_item
            SET quantity = :quantity
            WHERE cart_item_id = :cid;";

        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue(":quantity", $this->quantity, PDO::PARAM_INT);
        $stmt->bindValue(":cid", $this->cartItemId, PDO::PARAM_INT);
        
        $stmt->execute() ? $this->dbh->connect()->lastInsertId() : false;
    }

    /**
     * return TRUE if cartItem has been removed
     */
    public function deleteCartItemInDb(){
        $query=
        "DELETE FROM cart_item
            WHERE cart_item_id = :cid;";

        $stmt = $this->dbh->connect()->prepare($query);
        $stmt->bindValue(":cid", $this->cartItemId, PDO::PARAM_INT);
        return $stmt->execute();
    }


}