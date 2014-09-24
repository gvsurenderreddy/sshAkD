<?php
	interface Database{
		public function connect();
		
		public function fetch($endpoint, $id);
		
		public function put($endpoint, $id);
		
		public function delete($endpoint, $id);
	}
?>