<?php
require_once("Classes/Database.php");
require_once("Components/Headers.php");
require_once("Components/Navigation.php");
require_once("Components/HorizontalScroll.php");
require_once("Components/DocHeader.php");

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

<?php DocHeader() ?>

<body>

    <?php Navigation() ?>

    <?php Headers() ?>

    <?php CatScroll() ?>




</body>

</html>