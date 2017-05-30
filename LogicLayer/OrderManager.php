<?php

require_once(PATH."DataLayer/DB.php");
require_once("Order.php");


class OrderManager {

    public static function getAllOrders() {
        $db = new DB();
        $result = $db->getDataTable("select * from orders order by o_id");

        $allOrders = array();

        while ($row = $result->fetch_assoc()) {
            $orderObj = new Order($row["o_id"], $row["name"], $row["surname"], $row["cargo_status"], $row["tracking_no"]);
            array_push($allOrders, $orderObj);
        }

        return $allOrders;
    }

    public static function getOrder($o_id = null) {
        $db = new DB();
        $result = $db->getDataTable("select * from orders where p_id = $o_id");
        
        $row = $result->fetch_assoc();
        $orderObj = new Order($row["o_id"], $row["name"], $row["surname"], $row["cargo_status"], $row["tracking_no"]);
          
        return $orderObj;
    }
    
    public static function insertNewOrder($o_id = NULL, $name = NULL, $surname = NULL, $cargo_status = NULL, $tracking_no = NULL) {
        $db = new DB();
        $success = $db->executeQuery("INSERT INTO orders(o_id, name , surname, cargo_status, tracking_no) VALUES ('$o_id', '$name', '$surname', '$cargo_status', '$tracking_no')");
        return $success;
    }
    
    public static function updateTrackingNo($o_id, $tracking_no) {
        $db = new DB();
        $success = $db->executeQuery("UPDATE orders SET tracking_no = '$tracking_no' WHERE o_id = $o_id");
        return $success;
    }
    public static function updateCargoStatus($o_id, $cargo_status) {
        $db = new DB();
        $success = $db->executeQuery("UPDATE orders SET cargo_status = '$cargo_status' WHERE o_id = $o_id");
        return $success;
    }
    
    public static function deleteOrder($o_id) {
        $db = new DB();
        $success = $db->executeQuery("DELETE FROM orders where o_id = $o_id ");
        return $success;
    }

}

?>