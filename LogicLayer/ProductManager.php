<?php 
	require_once("C:/wamp64/www/proje/DataLayer/DB.php");
	require_once("Product.php");
	
	class ProductManager {
		
		public static function getAllProducts () {
			$db = new DB();
			$result = $db->getDataTable("select * from products order by p_name");
			
			$allProducts = array();
			
			while($row = $result->fetch_assoc()) {
				$productObj = new Product($row["p_id"], $row["p_name"], $row["quantity"], $row["reg_date"]);
				array_push($allProducts, $productObj);
			}
			
			return $allProducts;
		}
		
		public static function insertNewProduct($p_id, $p_name, $quantity, $reg_date) {
			$db = new DB();
			$success = $db->executeQuery("INSERT INTO products(p_id, p_name, quantity, reg_date) VALUES ('$p_id', '$p_name', '$quantity', '$reg_date')");
			return $success;
		}
		
	}
?>