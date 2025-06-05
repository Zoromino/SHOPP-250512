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
        $this->initDatabase();
        $this->initData();
        // $this->usersDatabase = new UserDatabase($this->pdo);
        // $this->usersDatabase->setupUsers();
        // $this->usersDatabase->seedUsers();
    }

    function initDatabase()
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS Products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100),
        price INT,
        stock INT,
        categoryName VARCHAR(200),
        description VARCHAR(1000),
        imageUrl VARCHAR(1000),
        popularityFactor INT DEFAULT 0,
        pimId VARCHAR(30)
        )');

        $this->pdo->query('CREATE TABLE IF NOT EXISTS Category(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50),
        description VARCHAR(300),
        pimId VARCHAR(30)
        )');

        $this->pdo->query('CREATE TABLE IF NOT EXISTS CategoryIcons (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        pimId VARCHAR(30)        
        )');

        $this->pdo->query('CREATE TABLE IF NOT EXISTS CartItem (
        id INT AUTO_INCREMENT PRIMARY KEY,
        productId INT,
        quantity INT,
        addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        sessionId VARCHAR(50),
        userId INT NULL,
        FOREIGN KEY (productId) REFERENCES Products(id) ON DELETE CASCADE
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

        #region CATEGORYS
        $this->addCategoryIfNotExists("Books", "More books");
        $this->addCategoryIfNotExists("", "");
        $this->addCategoryIfNotExists("", "");
        $this->addCategoryIfNotExists("", "");
        $this->addCategoryIfNotExists("", "");
        $this->addCategoryIfNotExists("", "");
        #endregion CATEGORYS

        #region BOOKS
        $this->addProductsIfNotExists("Harry Potter och hemligheternas kammare", 329, 100, 'Books', "Sommarlovet är äntligen över! Harry Potter har längtat tillbaka till sitt andra år på Hogwarts skola för häxkonster och trolldom. Men hur ska han stå ut med den omåttligt stroppige professor Lockman? Vad döljer Hagrids förflutna? Och vem är egentligen Missnöjda Myrtle? De verkliga problemen börjar när någon, eller något, förstenar den ena Hogwartseleven efter den andra. Är det Harrys fiende, Draco Malfoy, som ligger bakom? Eller är det den som alla på Hogwarts misstänker, Harry Potter själv?", "/assets/images/books/harry-potter-och-hemligheternas-kammare.jpg", 1);
        $this->addProductsIfNotExists('Harry Potter och den flammande bägaren', 329, 50, 'Books', "En natt vaknar Harry Potter av att ärret i pannan brinner som eld, ett säkert tecken på att Lord Voldemort befinner sig i närheten. Harry får snart annat att tänka på när världsmästerskapen i quidditch går av stapeln. Och när sommarlovet är slut väntar en överraskning, tillsammans med två andra trollkarlsskolor, Durmstrang och Beauxbatons, ska Hogwarts tävla i en mytomspunnen trekamp. Bara en från varje skola får delta. Alla är lika spända på vems namn som kommer att dras ur den flammande bägaren.", "/assets/images/books/harry-potter-och-den-flammande-bagaren.jpg", 2);
        $this->addProductsIfNotExists('Burn', 69, 30, 'Books', "Part of a small demon lair in North Las Vegas, tattooist Harper Wallis lives a pretty simple life. That changes overnight when she discovers that her psychic mate, or ‘anchor’, is a guy who’s rumored to be the most powerful demon in existence. Compelling, full of secrets and armed with raw sexuality, Knox Thorne is determined to claim her as his anchor, creating a psychic bond that will prevent their inner demons from ever turning rogue. The billionaire also wants Harper in his bed. She’s not so sure she wants either of those things. No one seems to know what breed of demon Knox is, only that he’s more dangerous than anything she’s ever before encountered. But he refuses to walk away. And when an unknown danger starts closing in on Harper, it seems that Knox is the only one who can keep her safe.", "/assets/images/books/Burn.jpg", 3);
        $this->addProductsIfNotExists('Blaze', 69, 39, 'Books', "Defeat the enemy. Win the boy. Live happily ever after. But life \"ever after\" isn't as easy as it used to be. Harper's gone from being a member of a small demon lair to co-Prime of one of the most powerful lairs in the US with a mate who, though hot as hell, is just a mite overprotective - I mean, you get kidnapped by dark practitioners just once", "assets/images/books/Blaze.jpg", 4);
        #endregion BOOKS

        #region PUZZLES
        $this->addProductsIfNotExists('Pussel 1000 bitar Cups', 249, 5, 'Puzzles', "Kärnan Pappussel Gustavbergs Kaffekoppar 1000 Bitar. Ljuvliga kaffekoppar ur Gustavsbergs sortiment, med namn och årtal, 1000 bitar.", "assets/images/puzzles/6b9632ef-6209-4db8-93c3-b542c9ce5112.jpg", 0);
        $this->addProductsIfNotExists('Minipussel 150 bitar Thailand', 79, 20, 'Puzzles', "Lägg ett minipussel på 150 bitar med ett fint motiv från Thailand. När det är färdiglagt har det storleken av ett vykort. Bild på motivet ligger i tuben.", "assets/images/puzzles/Minipussel 150 bitar Thailand.png", 0);
        #endregion PUZZLES

        #region HOME & GARDEN
        $this->addProductsIfNotExists("Känslomuggar i Presentförpackning", 349, 49, "Home & Garden", "Glatt busig eller blängande tjurig? Oavsett hur stämningen är vid frukostbordet är de här stilrena muggarna i presentförpackning perfekta att ge bort till någon med ett växlande morgonhumör!", "assets/images/home&garden/Känslomuggar.png", 0);
        $this->addProductsIfNotExists("Känslomuggar i Presentförpackning", 349, 39, "Home & Garden", "Glatt busig eller blängande tjurig? Oavsett hur stämningen är vid frukostbordet är de här stilrena muggarna i presentförpackning perfekta att ge bort till någon med ett växlande morgonhumör!", "assets/images/home&garden/Grinig&Busig.png", 0);
        $this->addProductsIfNotExists("Känslomuggar i Presentförpackning", 349, 100, "Home & Garden", "Glatt busig eller blängande tjurig? Oavsett hur stämningen är vid frukostbordet är de här stilrena muggarna i presentförpackning perfekta att ge bort till någon med ett växlande morgonhumör!", "assets/images/home&garden/KänslomuggarStack.png", 0);
        $this->addProductsIfNotExists("Känslomuggar i Presentförpackning", 349, 120, "Home & Garden", "Glatt busig eller blängande tjurig? Oavsett hur stämningen är vid frukostbordet är de här stilrena muggarna i presentförpackning perfekta att ge bort till någon med ett växlande morgonhumör!", "assets/images/home&garden/KänslomuggarGrupp.png", 0);
        $this->addProductsIfNotExists("Känslomuggar i Presentförpackning", 349, 10, "Home & Garden", "Glatt busig eller blängande tjurig? Oavsett hur stämningen är vid frukostbordet är de här stilrena muggarna i presentförpackning perfekta att ge bort till någon med ett växlande morgonhumör!", "assets/images/home&garden/Munter&Snopen.png", 0);
        $this->addProductsIfNotExists("Känslomuggar i Presentförpackning", 349, 10, "Home & Garden", "Glatt busig eller blängande tjurig? Oavsett hur stämningen är vid frukostbordet är de här stilrena muggarna i presentförpackning perfekta att ge bort till någon med ett växlande morgonhumör!", "assets/images/home&garden/Skojig&Tokig.png", 0);
        #endregion HOME & GARDEN

        #region ELECTRONICS
        // MOBILES
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - MultiColor", 7990, 0, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Group.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Black", 7990, 5, "Mobiles", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Black.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Black", 7990, 5, "Mobiles", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Back_Black.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Black", 7990, 5, "Mobiles", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Front_Black.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Blue", 7990, 10, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Blue.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Blue", 7990, 10, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Back_Blue.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Blue", 7990, 10, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Front_Blue.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Green", 7990, 15, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Green.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Green", 7990, 15, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Fron_Green.png", 0);
        $this->addProductsIfNotExists("iPhone 15 - 128 GB - Green", 7990, 15, "Electronics", "iPhone 15 128 GB är ett utmärkt val för användare som söker en kraftfull smartphone med avancerad kamerateknik och lång batteritid, utan att behöva den allra senaste tekniken som finns i iPhone 16-serien. Den erbjuder ett bra balans mellan pris och prestanda.", "assets/images/electronics/mobile/apple/iPhone15_128GB_Back_Green.png", 0);
        #endregion ELECTRONICS

        #region SOUNDS
        $this->addProductsIfNotExists("Sony WF-C510 trådlösa hörlurar med högkvalitativt ljud", 490, 5, "Ljud", "Sony WF-C510 är trådlösa in-ear-hörlurar som erbjuder högkvalitativt ljud i en kompakt och lätt design. Med en vikt på endast 4,6 gram per öronsnäcka är de bland de lättaste Sony någonsin har tillverkat", "assets/images/electronics/sound/headphones/sony_trådlösa_hörlurar.png", 0);
        // $this->addProductsIfNotExists("", 0, 0, "", "", "", 0);
        #endregion SOUNDS

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
    function getAllCategories()
    {
        $data = $this->pdo->query('SELECT DISTINCT categoryName FROM Products')->fetchAll(PDO::FETCH_COLUMN);
        return $data;

        // $query = $this->pdo->query("SELECT * FROM Category");
        // return $query->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    function getCategory($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Category WHERE id = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Category');
        return $query->fetch();
    }

    function addCategoryIfNotExists($categoryName, $description)
    {
        $query = $this->pdo->prepare("SELECT * FROM Category WHERE name = :name");
        $query->execute(['name' => $categoryName]);
        if ($query->rowCount() == 0) {
            $this->insertCategory($categoryName, $description);
        }
    }
    function insertCategory($categoryName, $description)
    {
        $sql = "INSERT INTO Category (name, description) VALUES (:name, :description)";
        $query = $this->pdo->prepare($sql);
        $query->execute(['name' => $categoryName, 'description' => $description]);
    }

    function getPopularProducts()
    {
        $query = $this->pdo->query("SELECT * FROM Products WHERE popularityFactor BETWEEN 1 AND 10 ORDER BY popularityFactor ASC LIMIT 10");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Products');
    }

    function getAllCategoryIcons()
    {
        return [
            'Books' => 'fa-solid fa-book',
            'Electronics' => 'fa-solid fa-tv',
            'Puzzles' => 'fa-solid fa-puzzle-piece',
            'Home & Garden' => 'fa-solid fa-kitchen-set',
            'Mobiles' => 'fa-solid fa-mobile-screen',
            'Ljud' => 'fa-solid fa-headphones-simple',

            'default' => 'fa-tag'
        ];
    }

    function getUniqueCategoryIcons()
    {
    }
}

?>