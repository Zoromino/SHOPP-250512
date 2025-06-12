<?php
require_once("Classes/Database.php");
require_once("Classes/Product.php");


function ProdScroll()
{
    $dbContext = new Database();
    $q = $_GET['q'] ?? "";
    $sortCol = $_GET['sortCol'] ?? "title";
    $sortOrder = $_GET['sortOrder'] ?? "asc";
    $catName = $_GET['catName'] ?? "";

    ?>
    <!-- Product Scroll -->
    <div class="prod-scrollWrapper" id="prod-scrollWrapper">
        <?php foreach ($dbContext->getAllProducts($sortCol, $sortOrder) as $prod) {
            ?>

            <div class="prod-item">
                <a href="product?id=<?php echo $prod->id; ?>" class="prod-item-list">
                    <img class="prod-img-card" src="<?php echo $prod->imageUrl; ?>" alt="..." />
                </a>
            </div>

            <?php
        }
        ?>
    </div>

    <?php
}

function CatScroll()
{
    $dbContext = new Database();
    $catName = $_GET['catName'] ?? "";
    // $catIcons = $_GET['catIcons'] ?? "";

    $icons = $dbContext->getAllCategoryIcons();

    ?>

    <!-- Category Scroll -->
    <div class="cat-scrollWrapper" id="cat-scrollWrapper">
        <!-- Sale icon -->
        <div class="cat-item">
            <a href="/viewSale" class="cat-icon-list">
                <div class="cat-icon">
                    <img src="assets/images/icons8red-sale.gif" alt="sale">
                </div>
            </a>
        </div>
        <!-- All Category icons -->
        <div class="cat-item">
            <a href="/allCategorys" class="cat-icon-list">
                <div class="cat-icon">
                    <i class="fa-solid fa-icons"></i>
                </div>
                <span class="cat-name">Alla kategorier</span>
            </a>
        </div>
        <!-- View All icons -->
        <?php foreach ($dbContext->getAllCategories() as $prod) {
            $iconClass = $icons[$prod] ?? $icons['default'];
            ?>
            <div class="cat-item">
                <a href="/category?catName=<?php echo $prod; ?>" class="cat-icon-list">
                    <div class="cat-icon">
                        <i class="fa <?php echo $iconClass; ?>"></i>
                    </div>
                    <span class="cat-name"><?php echo $prod; ?></span>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}

?>