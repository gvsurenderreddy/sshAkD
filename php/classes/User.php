<?php
	class User{
		/* Var declarations */
		private $id;
		private $name;
		private $home;
		private $server;
		private $keys=array();
		
		/* ##START with the magic shit */
		public function __construct($id, $name, $home, $server){
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
			push($this->keys,$key);
			$connection=ssh2_connect($this->server->ip);
			$rC=0;
			do{
				//ssh2_exec($connection, "echo #$key->contact@$this->server >> $this->home/.ssh/authorized_keys");
				//ssh2_exec($connection, "echo $key->pubKey >> $this->home/.ssh/authorized_keys");
				sleep(1);
				$rC++;
			} while (!$stream&&$rC<3);
		}
		
		private function removeKey($key){
			$connection=ssh2_connect($this->server->ip);
			$rC=0;
			do{
				ssh2_exec($connection, "grep -v #$key->contact@$this->server $this->home/.ssh/authorized_keys > akTmp && mv akTmp $this->home/.ssh/authorized_keys");
				ssh2_exec($connection, "grep -v $key->pubKey $this->home/.ssh/authorized_keys > akTmp && mv akTmp $this->home/.ssh/authorized_keys");
				sleep(1);
				$rC++;
			} while (!$stream&&$rC<3);
		}
	}
?>