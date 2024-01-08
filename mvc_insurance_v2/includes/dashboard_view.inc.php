<?php
declare(strict_types=1);

function display_products(array $products) {
    echo "<table>";
    ?>
    <tr>
        <th><strong>Name</strong></th>
        <th><strong>Description</strong></th>
        <th><strong>Price in EUR</strong></th>
    </tr>
    <?php
    foreach ($products as $product){ ?>
        <tr>            
            <td><?php echo htmlspecialchars($product["name"]); ?></td>
            <td><?php echo htmlspecialchars($product["description"]); ?></td>
            <td><?php echo htmlspecialchars($product["price_per_minute"]); ?></td>
            <?php if($_SESSION["user_role"] === "manager") { ?> 
                    <td>
                        <form action="./includes/product.inc.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo ($product["id"]); ?>">
                            <button type="submit" name="bt_product_remove">Remove</button>
                        </form>
                    </td>
                <?php } ?>
        </tr>
    <?php }
    echo "</table>";
}


function display_product_form() { ?>
    <form action="./includes/product.inc.php" method="post">
        <input type="text" name="name" placeholder="Product Name">
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="price_per_minute" placeholder="Price/Minute EUR">
        <br>
        <button type="submit" name="bt_product_confirm">Confirm</button>
    </form>
<?php }