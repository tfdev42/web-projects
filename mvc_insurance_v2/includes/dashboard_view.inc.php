<?php


function display_product_form() { ?>
    <form action="./includes/product.inc.php" method="post">
        <input type="text" name="name" placeholder="Product Name">
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="price_per_minute" placeholder="Price/Minute EUR">
        <br>
        <button type="submit" name="bt_product_confirm">Confirm</button>
    </form>
<?php }