<?php
	/*DEBUG ON*/
	error_reporting(E_ALL); ini_set('display_errors', '1');
	/**/
	
	include_once("classes/Database.php");
	include_once("classes/Server.php");
	include_once("classes/Key.php");
	include_once("classes/User.php");
	
	$endPoints=array("server","key");
	$arrEndpoint=explode('/',$_SERVER['REQUEST_URI']);
	$endPoint=$arrEndpoint[2];
	$id=$arrEndpoint[3];
	
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
	if(!in_arr($endPoint,$endPoints){
		throw new Exception("Unavailable Endpoint");
	}
	switch($method) {
			case 'DELETE':
				if(strlen($id)>1){
					/* delete object from database $db->delete($endpoint,$id);*/
				} else {
					/* return error */
				}
				break;
			case 'POST':
				/* generate new ID and put object into database $db->put($endpoint,$id);*/
				break;
			case 'GET':
				if(strlen($id)>1){
					/* fetch object from database $db->fetch($endpoint,$id);*/
				} else {
					/* return error */
				}
				break;
			case 'PUT':
				if(strlen($id)>1){
					/*put object into database $db->put($endpoint,$id);*/
				} else {
					/* generate new ID and put object into database $db->put($endpoint,$id);*/
				}
				$file = file_get_contents("php://input");
				break;
			default:
				echo "fuckOff";
				break;
	}
	//print_r($request);
?>