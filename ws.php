<?php
include "array_to_xml.php";

header("Content-Type:application/json");
// require "data.php";

$params = array_merge($_GET, $_POST);

$token = $params['token'];
//unset($params['token']);
$users = $params['users'];

// guardar en archivo los parametros en JSON
$myfile = fopen("json_users.json", "w") or die("Unable to open file!");
$json_params = json_encode($users);
fwrite($myfile, $json_params);
fclose($myfile);

// guardar en archivo los parámetros en XML
	//creating object of SimpleXMLElement
$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><users></users>");

//function call to convert array to xml
array_to_xml($params,$xml_user_info);

//saving generated xml file
$xml_file = $xml_user_info->asXML('xml_parameters.xml');

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
