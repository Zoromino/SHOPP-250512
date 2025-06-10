<?php
require_once("Classes/Database.php");
require_once("Classes/Product.php");
require_once("Classes/Category.php");
require_once("Controllers/SearchEngine.php");

function SingleSearchDetail($prod)
{
    // $dbContext = new Database();
    // $id = $_GET["id"];
    // $prod = $dbContext->getProducts($id);

    ?>
    <section class="single_prod-container">
        <div class="">
            <div class="">
                <div class="">
                    <div class="single_prod-card">
                        <!-- Top 10 badge -->
                        <?php if ($prod->popularityFactor > 0) { ?>
                            <div class="prod-card-badge">TOP
                                <?php echo $prod->popularityFactor; ?>
                            </div><?php } ?>
                        <!-- Prod image -->
                        <a href="product?id=<?php echo $prod->id; ?>">
                            <img class="prod-card-img" src="<?php echo $prod->imageUrl; ?>" alt="..." />
                        </a>
                        <!-- Prod details -->
                        <div class="prod-card-details">
                            <div class="text-details">
                                <!-- Prod name -->
                                <h5 class=""><?php echo $prod->title; ?></h5>
                                <hr>
                                <!-- Prod description -->
                                <h5 class=""><?php echo $prod->description; ?></h5>
                                <hr>
                                <!-- Prod price -->
                                <?php echo $prod->price; ?>.00 kr
                            </div>
                        </div>
                        <!-- Prod action -->
                        <div class="prod-card-addToCart">
                            <div class="text-addToCart">
                                <a class=""
                                    href="/addToCart?productId=<?php echo $prod->id; ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>">Lägg
                                    i kundvagn</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php
}

?>