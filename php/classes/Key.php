<?php
	class Key{
		private $name;
		private $pubKey;
		private $contact;
		
		public function __construct($name, $pubKey){
			$this->name=$name;
			$this->pubKey=$pubKey;
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