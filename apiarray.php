<?php
header("Content-Type:application/json");
// require "data.php";

$params = array_merge($_GET, $_POST);

$token = $params['token'];
//unset($params['token']);
$users = $params['users'];

if (array_key_exists('token', $params)){
	if ($token == '98765') {
		response(200,"Found",$params);
	} else {
		response(401,"Not authorized",NULL);
	}
}
else {
	response(404,"Not Found token request",NULL);
}


function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status_message);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data['users'];
	
	$json_response = json_encode($response);
	echo $json_response;
}
