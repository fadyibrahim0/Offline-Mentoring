<?php

class CartItem
{
    private Product $product;
    private int $qty;

    public function __construct(Product $product, int $qty=1)
    {
        $this->product  = $product;
        $this->qty      = $qty;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getQty() {
        return $this->qty;
    }
}