<?php

class CartContr {

    public $cartModel;
    public $cartItemModel;

    public function __construct(CartModel $cartModel) {
        $this->cartModel = $cartModel;
        $this->cartItemModel = $cartItemModel;
    }
}