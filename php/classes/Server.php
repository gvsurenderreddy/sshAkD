<?php
	class Server{
		/* Var declarations */
		private $name;
		private $ip;
		private $os;
		private $users=array();
		private $sudo;
		private $adminUser="root";
		
		/* ##START with the magic shit */
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
		/* #END with the magic shit */
		
		private function discover($password){
			$user=$this->adminUser;
			$connection=ssh2_connect($this->ip);
			ssh2_auth_password($connection, $user, $password);
			
			$this->getUsers($connection);
			foreach($this->users as $u){
				if($u->name==$adminUser){
					$u->addKey("");
				}
			}
		}
		
		private function getUsers($connection){
		
			/* get users with dir in /home/. try three times (with 1sec pause) --> planned to make an extra method somewhere else for this */
			$rC=0;
			do{
				$stream = ssh2_exec($connection, 'cat /etc/passwd | grep "/home" |cut -d: -f1,6');
				sleep(1);
				$rC++;
			} while (!$stream&&$rC<3);
			
			/* split the output by newline */
			$usersHomes=preg_split('/$\R?^/m',stream_get_contents($stream));
			
			/* make a new user for every line and add it to the $users-array */
			foreach($usersHomes as $uH){
				$userAttrs=array(explode(':',$uH);
				push($this->users,new User($userAttrs[0],$userAttrs[1],$this->name));
			}
			
			/* if adminUser is root add it to the array too ('cause he'd not be catched by the "grep /home" below */
			if($this->adminUser->name=="root"){
				push($this->users,new User("root","/root/",$this->name);
			}
		}
	}
?>