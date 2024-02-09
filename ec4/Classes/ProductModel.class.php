<?php

class ProductModel {
    protected $productId;
    protected $productArticleNr;
    protected $productName;
    protected $productDesc;
    protected $productPrice;
    protected $productAvailable;
    protected $productImgPath;
    protected $productAddedOnDate;
    private $dbh;

    public function __construct() {
        $this->productId;
        $this->productArticleNr;
        $this->productName;
        $this->productDesc;
        $this->productPrice;
        $this->productAvailable;
        $this->productImgPath;
        $this->productAddedOnDate;
        $this->dbh;
    }


    public function getProductId() {
        return $this->productId;
    }

    public function getProductArticleNr() {
        return $this->productArticleNr;
    }
    public function getProductName() {
        return $this->productName;
    }
    public function getProductDesc() {
        return $this->productDesc;
    }
    public function getProductPrice() {
        return $this->productPrice;
    }
    public function getProductAvailable() {
        return $this->productAvailable;
    }
    public function getProductImgPath() {
        return $this->productImgPath;
    }
    public function getProductAddedOnDate() {
        return $this->productAddedOnDate;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }
    public function setProductArticleNr($productArticleNr) {
        $this->productArticleNr = $productArticleNr;
    }
    public function setProductName($productName) {
        $this->productName = $productName;
    }
    public function setProductDesc($productDesc) {
        $this->productDesc = $productDesc;
    }
    public function setProductPrice($productPrice) {
        $this->productPrice = $productPrice;
    }
    public function setProductAvailable($productAvailable) {
        $this->productAvailable = $productAvailable;
    }
    public function setProductImgPath($productImgPath) {
        $this->productImgPath = $productImgPath;
    }

    public function insertProduct(){
        $query=
        "INSERT INTO product 
            (product_article_number, product_name, product_desc, product_available, product_price, product_img_path)
            VALUES 
            (:pan, :pn, :pd, :pa, :pp, :pip);";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(":pan", $this->getProductId(), PDO::PARAM_INT);
        $stmt->bindValue(":pn", $this->getProductName());
        $stmt->bindValue(":pd", $this->getProductDesc());
        $stmt->bindValue(":pa", $this->getProductAvailable());
        $stmt->bindValue(":pp", $this->getProductPrice());
        $stmt->bindValue(":pip", $this->getProductImgPath());

        return $stmt->execute();
    }

    
}