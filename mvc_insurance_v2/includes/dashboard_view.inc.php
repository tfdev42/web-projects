<?php
declare(strict_types=1);


function display_orders_customer(array $customer_orders) {
    
}


function check_session_errors() {
    if (isset($_SESSION["errors"])){ 
        $errors = $_SESSION["errors"];
        foreach ($errors as $error){
            echo '<p class="session-message">';
            echo $error;
            echo '</p><br>';
        }
        
    }
    unset($_SESSION["errors"]);
}

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
            <?php if($_SESSION["user_role"] === "customer") { ?> 
                <td>
                    <form action="./includes/orders.inc.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo ($product["id"]); ?>">
                        <input type="text" name="boat_registration_number" placeholder="Boat Registration Number">
                        <button type="submit" name="bt_product_order">Order</button>
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