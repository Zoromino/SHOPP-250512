<?php
require_once("Classes/Database.php");
require_once("Components/Headers.php");
require_once("Components/Navigation.php");
require_once("Components/HorizontalScroll.php");

$dbContext = new Database();

$q = $_GET['q'] ?? "";
$sortCol = $_GET['sortCol'] ?? "";
$sortOrder = $_GET['sortOrder'] ?? "";
$pageNo = $_GET['pageNo'] ?? "1";
$pageSize = $_GET[''] ?? "10";

// $searchEngine = new SearchEngine();

// $result = $searchEngine->search($q,$sortCol, $sortOrder, $pageNo, $pageSize); 
// $result = $dbContext->searchProducts($q,$sortCol, $sortOrder, $pageNo, $pageSize);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPP</title>

    <script src="https://kit.fontawesome.com/9cc6379812.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/styles/home.css" />
    <link rel="stylesheet" href="assets/styles/scroll.css" />
</head>

<body>

    <?php Navigation() ?>

    <?php Headers() ?>

    <?php CatScroll() ?>




</body>

</html>