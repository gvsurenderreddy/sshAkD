<?php
	class Key{
		/* Var declarations */
		private $id;
		private $name;
		private $pubKey;
		private $contact;
		
		/* ##START with the magic shit */
		public function __construct($id, $name, $pubKey){
			$this->id=id;
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
		/* #END with the magic shit */
	}
?>