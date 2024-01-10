<?php
declare(strict_types=1);


function switch_display() {
    switch($_SESSION["display"]){
        case "home": ?>
            <div>
                <h3>Welcome to the <?php echo htmlspecialchars($_SESSION["user_role"]); ?> Dashboard</h3>
                
                <section><?php if ($_SESSION["user_role"] === "manager") { ?>
                    <form action="./dashboard.php" method="post">
                        <button type="submit" name="bt_product_add">Add Product</button>
                    </form>
                    <?php } ?></section>
                <section><?php isset($_POST["bt_product_add"]) ? display_product_form() : ""; ?></section>
            
            </div>
            <div>
                <?php display_products($_SESSION["products"]); ?>
            </div><?php
            break;
        case "orders":
            display_orders();
            break;
        
        default:
            echo "View error";
            var_dump(($_SESSION["display"]));
            break;

    }
    
}

function display_orders(){
    if ($_SESSION["user_role"] === "customer"){
        display_orders_customer($_SESSION["customer_orders"]);
    }
    if ($_SESSION["user_role"] === "agent"){
        display_orders_agent($_SESSION["agent_orders"]);
    }
}


function display_orders_agent(array $all_orders){
    echo "<table>";
    ?>
    <tr>
        <th><strong>OrderID</strong></th>
        <th><strong>CustomerID</strong></th>
        <th><strong>Product</strong></th>
        <th><strong>Registration</strong></th>
        <th><strong>Status</strong></th>
        <th><strong>Comment</strong></th>
    </tr>
    <?php
    foreach ($all_orders as $order){ ?>
        <tr>            
            <td><?php echo ($order["OrderID"]); ?></td>
            <td><?php echo ($order["CustomerID"]); ?></td>
            <td><?php echo htmlspecialchars($order["Product"]); ?></td>
            <td><?php echo htmlspecialchars($order["Registration"]); ?></td>
            <td><?php echo htmlspecialchars($order["Status"]); ?></td>
            <td><?php if($order["Comment"]){
                echo htmlspecialchars($order["Comment"]);
            }else echo ""; ?></td>
        </tr>
    <?php }
    echo "</table>";
}


function display_orders_customer(array $customer_orders) {
    echo "<table>";
    ?>
    <tr>
        <th><strong>OrderID</strong></th>
        <th><strong>Product</strong></th>
        <th><strong>Registration</strong></th>
        <th><strong>Status</strong></th>
    </tr>
    <?php
    foreach ($customer_orders as $order){ ?>
        <tr>            
            <td><?php echo ($order["OrderID"]); ?></td>
            <td><?php echo htmlspecialchars($order["Product"]); ?></td>
            <td><?php echo htmlspecialchars($order["Registration"]); ?></td>
            <td><?php echo htmlspecialchars($order["Status"]); ?></td>            
        </tr>
    <?php }
    echo "</table>";
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