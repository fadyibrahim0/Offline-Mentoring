<?php

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function index() {
        $data = $this->db->getAll("SELECT * FROM products");
        include 'views/index.php';
    }

    public function create(){
        include 'views/create.php';
    }

    public function store(){
        $name   = $_POST['name'];
        $price  = $_POST['price'];

        $sql = "INSERT INTO products(`name`, `price`) VALUES(?,?)";
        $this->db->insert($sql, [$name, $price]);

        header("Location:" . URL . "index");
        exit;
    }

    public function edit($id) {
        $sql = "SELECT * FROM `products` WHERE `id`=? ";
        $row = $this->db->getOne($sql, [$id]);
        if(empty($row)) {
            echo "ya3m el array bta3tk fadyaa";
        } else {
            include 'views/edit.php';
        }
        
    }

    public function update($id) {
        $name   = $_POST['name'];
        $price  = $_POST['price'];

        $sql = "UPDATE `products` SET `name`=?, `price`=? WHERE `id`=? ";
        $this->db->update($sql, [$name, $price, $id]);
        header("Location:" . URL . "index");
        exit;
    }

    public function delete($id) {
        $sql = "DELETE FROM `products` WHERE `id`=? ";
        $this->db->delete($sql, [$id]);
        header("Location:" . URL . "index");
        exit;
    }
}