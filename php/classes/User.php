<?php
	class User{
		private $name;
		private $server;
		
		public function __construct($name, $server){
			$this->name=$name;
			$this->server=$server;
		}
		
		public function __get($property){
			if (property_exists($this, $property)){
				return $this->$property;
			}
		}

		public function __set($property, $value){
			if (property_exists($this, $property)){
				$this->$property = $value;
			}
		}
	}
?>