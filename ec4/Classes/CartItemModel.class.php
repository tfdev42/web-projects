<?php

class CartItemModel extends CartModel {

    private $product;

    private $quantity;

    private $unitPrice;

    private $totalPrice;


    public function __construct(){
        parent::__construct();        
        $this->product = new ProductModel();
        $this->quantity;
        $this->unitPrice;
        $this->totalPrice;
    }


}