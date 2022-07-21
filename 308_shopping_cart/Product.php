<?php

// title, id, price, qty

class Product {

    private $id;
    private $title;
    private $price;
    private $qty;

    public function __construct($id, $title, $price, $qty)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->price    = $price;
        $this->qty      = $qty;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQty() {
        return $this->qty;
    }
}