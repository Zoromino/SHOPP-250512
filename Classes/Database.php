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

    function insertProduct($title, $price, $stock, $categoryName, $description, $imageUrl, $popularityFactor)
    {
        $sql = "INSERT INTO Products (title, price, stock, categoryName, description, imageUrl, popularityFactor) VALUES (:title, :price, :stock, :categoryName, :description, :imageUrl, :popularityFactor) ";
        $query = $this->pdo->prepare($sql);
        $query->execute(["title" => $title, "price" => $price, "stock" => $stock, "categoryName" => $categoryName, "description" => $description, "imageUrl" => $imageUrl, "popularityFactor" => $popularityFactor]);
    }

    function initData()
    {
        $sql = "SELECT COUNT(*) FROM Products";
        $res = $this->pdo->query($sql);
        $count = $res->fetchColumn();

        $this->addProductIfNotExists("", 0, 0, "", "", "", 0);
    }

    function addProductsIfNotExists($title, $price, $stock, $categoryName, $description, $imageUrl, $popularityFactor)
    {
        $query = $this->pdo->prepare("SELECT * FROM Products WHERE title = :title");
        $query->execute(['title' => $title]);
        if ($query->rowCount() == 0) {
            $this->insertProduct($title, $price, $stock, $categoryName, $description, $imageUrl, $popularityFactor);
        }
    }

    function getAllProducts($sortCol, $sortOrder)
    {
        if (!in_array($sortCol, ["title", "price"])) {
            $sortCol = "title";
        }
        if (!in_array($sortOrder, ["asc", "desc"])) {
            $sortOrder = "asc";
        }

        $query = $this->pdo->query("SELECT * FROM Products ORDER BY $sortCol $sortOrder");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Products');
    }

    function getProducts($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Products WHERE id = :id");
        $query->execute(["id" => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Products');
        return $query->fetch();
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

    function getPopularProducts()
    {
        $query = $this->pdo->query("SELECT * FROM Products WHERE popularityFactor BETWEEN 1 AND 10 ORDER BY popularityFactor ASC LIMIT 10");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Products');
    }
}

?>