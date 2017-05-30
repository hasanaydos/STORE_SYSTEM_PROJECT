<?php

require_once(PATH."DataLayer/DB.php");
require_once(PATH."LogicLayer/Admin.php");

class AdminManager {

    public static function getAdmin($username, $password) {
        $db = new DB();
        $result = $db->getDataTable("select * from admins where username = '$username' AND password = '$password'");

       
       $row = $result->fetch_assoc();
       if ($row != NULL)
           return new Admin($row["a_id"], $row["username"], $row["password"], $row["authorization"]);
        else
           return NULL;
    }
   
    public static function getWaitingAdmins() {
        $db = new DB();
        $result = $db->getDataTable("select * from admins where authorization = 0");
        
       $waitingAdmins = array();
       
       while($row = $result->fetch_assoc()){
           $adminObj = new Admin($row["a_id"], $row["username"], $row["password"], $row["authorization"]);
           array_push($waitingAdmins, $adminObj);
       }
       return $waitingAdmins;
    }
    public static function getAdmins() {
        $db = new DB();
        $result = $db->getDataTable("select * from admins where authorization != 0");
        
       $waitingAdmins = array();
       
       while($row = $result->fetch_assoc()){
           $adminObj = new Admin($row["a_id"], $row["username"], $row["password"], $row["authorization"]);
           array_push($waitingAdmins, $adminObj);
       }
       return $waitingAdmins;
    }
    public static function getAdminsWithoutActiveOne($active_id) {
        $db = new DB();
        $result = $db->getDataTable("select * from admins where authorization != 0 AND a_id != $active_id");
        
       $waitingAdmins = array();
       
       while($row = $result->fetch_assoc()){
           $adminObj = new Admin($row["a_id"], $row["username"], $row["password"], $row["authorization"]);
           array_push($waitingAdmins, $adminObj);
       }
       return $waitingAdmins;
    }
    public static function getUsername($username) {
        $db = new DB();
        $result = $db->getDataTable("select * from admins where username = '$username'");
        
       $row = $result->fetch_assoc();
       if ($row != NULL)
           return new Admin($row["a_id"], $row["username"], $row["password"], $row["authorization"]);
        else
           return NULL; 
    }
    
    public static function getUsernameWithoutID($username, $id) {
        $db = new DB();
        $result = $db->getDataTable("select * from admins where username = '$username' AND a_id != $id");
        
       $row = $result->fetch_assoc();
       if ($row != NULL)
           return new Admin($row["a_id"], $row["username"], $row["password"], $row["authorization"]);
        else
           return NULL; 
    }

    public static function updateAdmin($a_id, $username, $password, $authorization) {
        $db = new DB();
        $success = $db->executeQuery("UPDATE admins SET username = '$username', password = '$password', authorization = '$authorization' WHERE a_id = $a_id");
        return $success;
    }
    public static function updateAdminAuth($a_id, $auth) {
        $db = new DB();
        $success = $db->executeQuery("UPDATE admins SET authorization = $auth WHERE a_id = $a_id");
        return $success;
    }

    public static function insertNewAdmin($username, $password) {
        $db = new DB(); // burada new admin eklerken bizim admins tablosu auuto increment oldğu için id sütununu boş bırakıyoruz, yani böyle olması lazım.
        // bizim yetkilendirme nasıl olacaktı ? 
        $success = $db->executeQuery("INSERT INTO admins(username, password, authorization) VALUES ('$username', '$password', 0)");
        return $success;
    }

    public static function deleteAdmin($a_id) {
        $db = new DB();
        $success = $db->executeQuery("DELETE FROM admins where a_id = $a_id ");
        return $success;
    }

}

?>