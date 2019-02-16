<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

    include './includes/dbhelper.php';
    include './includes/utils.php';
    include './includes/constants.php';
    include './includes/controller.php';


 
    //m_log("TAEYU".PHP_EOL);
    //Make sure that it is a POST request.
    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
       // throw new Exception('Request method must be POST!');
        print("The server is running");
    }

    //Make sure that the content type of the POST request has been set to application/json
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if(strcasecmp($contentType, 'application/json') != 0){
        throw new Exception('Content type must be: application/json');
    }

    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));
    //m_log("RAW DATA = $content".PHP_EOL);

    //Attempt to decode the incoming RAW post data from JSON.
    $decoded = json_decode($content, true); //JSON object

    //If json_decode failed, the JSON is invalid.
    if(!is_array($decoded)){
        throw new Exception('Received content contained invalid JSON!');
    }
    //Process the JSON***********************
    $clubDevice = null;
    $clubDeviceId = null;
    foreach($decoded as $k=>$v) {
       //m_log("TY");
        $type = $v['type'];
        $lat = $v['lat'];
        $lng = $v['lng'];
        $acc = $v['acc'];
        $extra = $v['extra'];
        $status = $v['status'];
        $provider = $v['provider'];
        $last_updated = $v['last_updated'];
        $location_raw = $v['location_raw'];
	if($type == 1) {//Data from GPS
        	saveGPSBasedData($lat,$lng, $acc, $extra, $status, $provider, $last_updated, $location_raw);
	} else { //Data from GSM
        	saveGSMBasedData($lat,$lng, $acc, $extra, $status, $provider, $last_updated, $location_raw);
	}
    }
?>
        
        
