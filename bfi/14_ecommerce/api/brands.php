<?php
require_once __DIR__ . '/../maininclude.inc.php';

// Lade Brands als Array
$brands = $dba->getBrands();


class BrandsDto{
    public array $brands;
}

$dto = new BrandsDto();
$dto->brands = $brands;


// Gebe es als JSON aus
echo json_encode($dto);


?>