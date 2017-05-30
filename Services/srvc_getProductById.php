<?php
require_once("../Path.php");
require_once(PATH . "LogicLayer/ProductManager.php");
require_once(PATH . "LogicLayer/PropertyManager.php");

if (isset($_POST['p_id'])) {
    $p_id = $_POST['p_id'];
    
    $product = ProductManager::getProduct($p_id);
    $properties = PropertyManager::getAllPropertiesForProduct($p_id);
    
    $propertList = array();   
	
    for ($i = 0; $i < count($properties); $i++) {
        array_push($propertList, array($properties[$i]->getPr_name(), $properties[$i]->getPr_value()));
    }
	
    $productJSON = array("product" => array(
                                                "id" => $product->getP_id(),
                                                "name" => $product->getP_name(),
                                                "quantity" => $product->getQuantity(),
                                                "properties" => $propertList
                                        )
    );

    // JSON output
    header('Content-type: application/json');
    echo json_encode($productJSON);
   
}
?>		