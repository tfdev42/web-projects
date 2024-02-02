<?php
session_start();
include_once "../Classes/Dbh.class.php";
include_once "../Classes/ProductModel.class.php";

$productModel = new ProductModel();

$_SESSION["products_list"] = $productModel->listAllProducts();