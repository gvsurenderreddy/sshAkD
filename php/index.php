<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
	include_once("classes/Server.php");
	include_once("classes/Key.php");
	include_once("classes/User.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
		if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
			$method = 'DELETE';
		} else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
			$method = 'PUT';
		} else {
			throw new Exception("Unexpected Header");
		}
	}
	
	switch($method) {
			case 'DELETE':
			case 'POST':
				$request = $_POST;
				break;
			case 'GET':
				$request = $_GET;
				echo '{"title": "test"}';
				break;
			case 'PUT':
				$request = $_GET;
				$file = file_get_contents("php://input");
				break;
			default:
				echo "fuckOff";
				break;
	}
?>