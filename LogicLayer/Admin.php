<?php 
	class Admin {
		private $a_id;
		private $username;
		private $password;
		private $authorization;
		
		function __construct($a_id = NULL, $username = NULL, $password = NULL, $authorization = NULL) {
			$this->a_id = $a_id;
			$this->username = $username;
			$this->password = $password;
			$this->authorization = $authorization;
		}
		
		public function getA_id() {
			return $this->a_id;
		}
		
		public function getUsername() {
			return $this->username;
		}
		
		public function getPassword() {
			return $this->password;	
		}
		
		public function getAuthorization(){
			return $this->authorization;
		}
	}
?>