<?php
require_once("Classes/Database.php");
require_once("Components/Headers.php");
require_once("Components/Navigation.php");
require_once("Components/HorizontalScroll.php");
require_once("Components/DocHeader.php");
require_once("Components/SingleProdDetail.php");
require_once("Components/SingleSearchDetail.php");

$dbContext = new Database();

$catName = $_GET['catName'] ?? "";
$q = $_GET['q'] ?? "";
$sortCol = $_GET['sortCol'] ?? "title";
$sortOrder = $_GET['sortOrder'] ?? "asc";
$pageNo = $_GET['pageNo'] ?? "1";
$pageSize = $_GET[''] ?? "10";

$searchEngine = new SearchEngine();

// $result = $searchEngine->search($q, $sortCol, $sortOrder, $pageNo, $pageSize);
$result = $dbContext->getCategoryProducts($catName, $sortCol, $sortOrder);

?>

<?php DocHeader() ?>

<body>

    <?php Navigation() ?>

    <?php Headers() ?>

    <?php CatScroll() ?>

    <?php foreach ($result as $prod) {
        SingleSearchDetail($prod);
    } ?>




</body>

</html>