<?php
	class Server{
		private $name;
		private $ip;
		private $os;
		private $users=array();
		private $sudo;
		private $adminUser="root";
		
		public function __construct($name, $ip, $sudo, $adminUser){
			$this->name=$name;
			$this->ip=$ip;
			if($sudo){
				$this->adminUser=$adminUser;
			}
			
			$this->discover('');
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
		
		private function discover($password){
			$user=$this->adminUser;
			$connection=ssh2_connect($this->ip);
			ssh2_auth_password($connection, $user, $password);
			
			$rC=0;
			do{
				$stream = ssh2_exec($connection, 'cat /etc/passwd | grep "/home" |cut -d: -f1');
				sleep(1);
				$rc++;
			} while (!$stream&&$rC<3)
			$strUsers=stream_get_contents($stream);
			$users=preg_split('/$\R?^/m',$strUsers);
			if(count($users)>=1){
				$this->users=array_merge($this->users,$users);
			}
		}
	}
?>