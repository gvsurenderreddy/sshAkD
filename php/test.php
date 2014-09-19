<?php
	include_once("classes/Server.php");
	include_once("classes/Key.php");
	include_once("classes/User.php");
	
	$key1=new Key("testKey","a1b2c3d4");
	$server2=new Server("servername","ip",false,"");

	var_dump($key1);
	var_dump($server2);
	
	
?>