<?php

class Database
{
    public $pdo;

    function __construct()
    {
        $host = $_ENV['host'];
        $db = $_ENV['db'];
        $user = $_ENV['user'];
        $pass = $_ENV['password'];
        $port = $_ENV['port'];

        $dsn = "mysql:host=$host:$port;dbname=$db";
        $this->pdo = new PDO($dsn, $user, $pass);
        // $this->initDatabase();
        // $this->initData();
    }

    function initDatabase()
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS Products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100),
        price INT,
        stock INT,
        categoryName VARCHAR(200),
        description VARCHAR(200),
        imageUrl VARCHAR(1000),
        popularityFactor INT DEFAULT 0
        )');
    }

    function initData()
    {
    }

    function addProductsIfNotExists()
    {
    }

    function getCategoryProducts($catName)
    {
        if ($catName == "") {
            $query = $this->pdo->query("SELECT * FROM Products");
            return $query->fetchAll(PDO::FETCH_CLASS, "Products");
        }

        $query = $this->pdo->prepare("SELECT * FROM Products WHERE categoryName = :categoryName");
        $query->execute(["categoryName" => $catName]);
        return $query->fetchAll(PDO::FETCH_CLASS, "Products");
    }
}

?>