<?php
require_once __DIR__ . '/../maininclude.inc.php';

// Lade Brands als Array
$products = $dba->getProducts();


class ProductDto{
    public array $products;
}

$dto = new ProductDto();
$dto->products = $products;


// Gebe es als JSON aus
echo json_encode($dto);


?>