<?php

require_once(PATH."DataLayer/DB.php");
require_once("Property.php");

class PropertyManager {

    public static function getAllPropertiesForProduct($product_id = null) {
        $db = new DB();
        $result = $db->getDataTable("select * from product_property as pp, properties as pr where pp.p_id = $product_id and pr.pr_id = pp.pr_id order by pr.pr_id");

        $allProperties = array();
          
        if ($result != NULL) {
            
            while ($row = $result->fetch_assoc()) {
                $propertyObj = new Property($row["pr_id"], $row["pr_name"], $row["pr_value"]);
                array_push($allProperties, $propertyObj);
            }
            
        } else if ($result == NULL)
            $allProperties = NULL;
        

          return $allProperties; 
    }

    public static function getAllProperties() {
        $db = new DB();
        $result = $db->getDataTable("select * from properties order by pr_id");

        $allProperties = array();

        while ($row = $result->fetch_assoc()) {
            $propertyObj = new Property($row["pr_id"], $row["pr_name"], $row["pr_value"]);
            array_push($allProperties, $propertyObj);
        }

        return $allProperties;
    }

    public static function insertNewProperty($pr_name, $pr_value) {
        $db = new DB();
        $success = $db->executeQuery("INSERT INTO properties(pr_name, pr_value) VALUES ('$pr_name', '$pr_value')");

        return $success;
    }

    /// düzenlenecek yer

    public static function insertToProductProperties($p_id, $pr_id) {
        $db = new DB();
        $success = $db->executeQuery("INSERT INTO product_property(p_id, pr_id) VALUES ('$p_id', '$pr_id')");
        return $success;
    }

    public static function findExistingProperty($pr_name, $pr_value) {
        $db = new DB();
        $result = $db->getDataTable("select * from properties pr where pr.pr_name = '$pr_name' and pr.pr_value = '$pr_value'");


        
        if($row = $result->fetch_assoc()){
            return new Property($row["pr_id"], $row["pr_name"], $row["pr_value"]);
        }
        else{

        return null;
        
        }
    }

}

?>