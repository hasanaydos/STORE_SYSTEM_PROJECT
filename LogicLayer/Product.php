<?php 
	class Product {
		private $p_id;
		private $p_name;
		private $quantity;
		private $reg_date;
		
		function __construct($p_id = NULL, $p_name = NULL, $quantity = NULL, $reg_date = NULL) {
			$this->p_id = $p_id;
			$this->p_name = $p_name;
			$this->quantity = $quantity;
			$this->reg_date = $reg_date;
		}
		
		public function getP_id() {
			return $this->p_id;
		}
		
		public function getP_name() {
			return $this->p_name;
		}
		
		public function getQuantity() {
			return $this->quantity;	
		}
		
		public function getReg_date(){
			return $this->reg_date;
		}
	}
?>