<?php
	class Mock implements Database{
		public function connect(){
		
		}
		
		public function fetch($endpoint, $id){
			switch($endpoint){
				case 'server':
					$return = '{"id": "'.$id.'", "name": "server.domain.tld", "ip": "127.0.0.1", "sudo": "false", "adminUser": "root", "users": [{"id": "54712", "name": "root", "home": "/root/"},{"id": "54762", "name": "test", "home": "/home/test"}]}';
					break;
				case 'key':
					$return = '{"id": "'.$id.'", "name": "Admin1", "pubKey": "AAAAB3NzaC1yc2EAAAABIwAAAIEA1on8gxCGJJWSRT4uOrR13mUaUk0hRf4RzxSZ1zRbYYFw8pfGesIFoEuVth4HKyF8k1y4mRUnYHP1XNMNMJl1JcEArC2asV8sHf6zSPVffozZ5TT4SfsUu/iKy9lUcCfXzwre4WWZSXXcPff+EHtWshahu3WzBdnGxm5Xoi89zcE="}';
					break;
				default:
					$return = '';
					break;
			}
			return $return;
		}
		
		public function put($endpoint, $id){
		
		}
		
		public function delete($endpoint, $id){
		
		}
	}
?>