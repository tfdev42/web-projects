<?php

class ProductModel extends Dbh{

    public function listAllProducts(){
        $query = 
        "SELECT * FROM product;";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();        
    }
}