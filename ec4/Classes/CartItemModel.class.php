<?php

class CartItemModel{

    protected $productId;

    protected $quantity;

    protected $unitPrice;

    protected $totalPrice;


    public function __construct(){        
        $this->product = new ProductModel();
        $this->quantity;
        $this->unitPrice;
        $this->totalPrice;
    }


}