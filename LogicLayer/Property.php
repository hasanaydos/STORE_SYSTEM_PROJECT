<?php

class Property {

    private $pr_id;
    private $pr_name;
    private $pr_value;

    function __construct($pr_id = NULL, $pr_name = NULL, $pr_value = NULL) {
        $this->pr_id = $pr_id;
        $this->pr_name = $pr_name;
        $this->pr_value = $pr_value;
    }

    public function getPr_id() {
        return $this->pr_id;
    }

    public function getPr_name() {
        return $this->pr_name;
    }

    public function getPr_value() {
        return $this->pr_value;
    }

}

?>