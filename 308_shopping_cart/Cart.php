<?php

// add, get, find, update, availability, remove, totalPrice, all items

class Cart {

    private Product $product;
    private $items = [];


    public function addToCart(Product $product, $qty=1) {
        if($product->getQty() >= $qty) {
            $this->items[$product->getId()] = new CartItem($product, $qty);
        } else {
            throw new Exception("Please insert available quantity !");
        }
    }

    public function getItem($id) {
        if(array_key_exists($id, $this->items)) {
            return $this->items[$id];
        }
        return null;
    }

    public function findItem($id) {
        if(array_key_exists($id, $this->items)) {
            return true;
        }
        return false;
    }

    public function updateItem(Product $product, int $qty=1) {
        $this->addToCart($product, $qty);
    }

    public function checkAvailability(Product $product, int $qty) {
        if($product->getQty() >=  $qty) {
            return true;
        }
        throw new Exception("Not Available !");
    }

    public function removeItem($id) {
        if($this->findItem($id)) {
            unset($this->items[$id]);
        }
    }

    public function totalPrice() {
        $price = 0;
        foreach($this->items as $item) {
            $price += $item->getProduct()->getPrice() * $item->getQty();
        }
        return $price;
    }

    public function getAllItems() {
        return $this->items;
    }

}

function dd($data) {
    echo "<pre>";
        print_r($data);
    echo "</pre>";
    exit;
}