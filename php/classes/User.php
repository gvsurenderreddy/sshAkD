<?php
	class User{
		/* Var declarations */
		private $name;
		private $home;
		private $server;
		
		/* ##START with the magic shit */
		public function __construct($name, $home, $server){
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
		/* #END with the magic shit */
		
		private function addKey($key){
			$connection=ssh2_connect($this->server->ip);
			$rC=0;
			do{
				$stream = ssh2_exec($connection, "echo #$this->name@$this->server >> $this->home/.ssh/authorized_keys");
				$stream = ssh2_exec($connection, "echo $key >> this->home/.ssh/authorized_keys");
				sleep(1);
				$rC++;
			} while (!$stream&&$rC<3);
		}
	}
?>