<?php

require_once(PATH."DataLayer/DB.php");
require_once("Product.php");


class ProductManager {

    public static function getAllProducts() {
        $db = new DB();
        $result = $db->getDataTable("select * from products order by p_id");

        $allProducts = array();

        while ($row = $result->fetch_assoc()) {
            $productObj = new Product($row["p_id"], $row["p_name"], $row["quantity"]);
            array_push($allProducts, $productObj);
        }

        return $allProducts;
    }

    public static function getProduct($p_id = null) {
        $db = new DB();
        $result = $db->getDataTable("select * from products where p_id = $p_id");
        
        $row = $result->fetch_assoc();
        $productObj = new Product($row["p_id"], $row["p_name"], $row["quantity"]);
          
        return $productObj;
    }

    public static function updateProduct($p_id, $p_name, $quantity) {
        $db = new DB();
        $success = $db->executeQuery("UPDATE products SET p_name = '$p_name', quantity = '$quantity' WHERE p_id = $p_id");
        return $success;
    }

    public static function insertNewProduct($p_id, $p_name, $quantity) {
        $db = new DB();
        $success = $db->executeQuery("INSERT INTO products(p_id, p_name, quantity) VALUES ('$p_id', '$p_name', '$quantity')");
        return $success;
    }

    public static function deleteProduct($p_id) {
        $db = new DB();
        $success = $db->executeQuery("DELETE FROM products where p_id = $p_id ");
        return $success;
    }

}

?>