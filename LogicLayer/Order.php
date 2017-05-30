<?php

class Order {

    private $o_id;    
    private $name;
    private $surname; 
    private $cargo_status;
    private $tracking_no;

    function __construct($o_id = NULL, $name = NULL, $surname = NULL, $cargo_status = NULL, $tracking_no = NULL) {
        $this->o_id = $o_id;
        $this->name = $name;
        $this->surname = $surname;      
        $this->cargo_status = $cargo_status;
        $this->tracking_no = $tracking_no;
    }

    public function getO_id() {
        return $this->o_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getCargoStatus() {
        return $this->cargo_status;
    }

    public function getTrackingNo() {
        return $this->tracking_no;
    }

}

?>