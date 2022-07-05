<?php

class DB
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=308_oop_pdo;charset=UTF8", "root", "");
        try{
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAll($query) {
        $stmt = $this->conn->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getOne($sql, $data = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($sql, $data=[]) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function update($sql, $data=[]) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($sql, $data=[]) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}