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
    //GET MAC ADDRESS OF GATEWAY --> CLUB_DEVICE
    $clubDevice = null;
    foreach($decoded as $k=>$v) {
        $type = $v['type'];
        $mac = $v['mac'];
        $curRssi = $v['rssi'];
        if (strcmp($type, $CONST_GATEWAY)==0) { // if it is a gateway, look for club_device
            $clubDevice = getClubDevice($mac);
            //m_log($clubDevice->__toString());
        } else { //if it is a ble
                       
            $user = getUserID($mac,"user_devices"); //check if it belongs to our members?
            $clubDevice = getClubDevice($mac);
            if ($userID == null) {
                continue;
            } else {
                //m_log("DECTECTED: userID=".$userID.",mac=".$mac);
                $latestUserTracking = getLatestUserTracking($userID);
                if($latestUserTracking == null) { // the first detection ever
                    insertUserTracking($userID, $clubDevice->getId(), $curRssi, 1);
                    //create an event to check if he is just passing the gate by chance (not login)
                    //TODO CREATE EVENT HERE, Check AFTER 5 MINUTES.

                } else {
                    $status = $latestUserTracking->getStatus();
                    $lastClubDeviceID = $latestUserTracking->getClubDeviceId();
                    $curClubDeviceID = $clubDevice->getID();

                    if ($status < 0) { //today he/she has not logged in yet
                        //Insert the first detection after the last check out or a new day
                        insertUserTracking($userID, $curClubDeviceID, $curRssi, 1);
                        //create an event to check if he is just passing the gate by chance (not login)
                        //TODO CREATE EVENT HERE, Check AFTER 5 MINUTES.
                    } elseif ($status == 1) {// today he/she has been detected at the gate.
                        if ($lastClubDeviceID == $curClubDeviceID) {
                            //DO NOTHING
                            //m_log("DOING NOTHING");
                        } else {
                            insertUserTracking($userID, $curClubDeviceID, $curRssi, 2);
                        }
                    } else {// ($status >= 2)  // today he/she has been logged in
                        //update new location, new rssi, and status.
                        $newStatus = $status + 1;
                        if ($lastClubDeviceID == $curClubDeviceID) {
                            //DO NOTHING
                            //m_log("THE SAME GATEWAY HAS DETECTED");
                            updateUserTracking($latestUserTracking->getId(), $curClubDeviceID, $curRssi, $status);
                        } else {
                            //Check if the new detection gateway captured higher rssi
                            if ($curRssi > $latestUserTracking->getRssi()) { //The ble is detected by multiple gw at the same time, but moving toward a new GW
                               // m_log("MULTIPLE GATEWAYS DETECTED, BUT IT IS MOVING TOWARD A NEW GW");
                                insertUserTracking($userID, $curClubDeviceID, $curRssi, $newStatus);
                            } else {
                                //m_log("MULTIPLE GATEWAYS DETECTED, BUT IT IS STILL CLOSEST TO THE PREVIOUS GW"); //The ble is detected by multiple gw at the same time, but still closest to the previous one
                                updateUserTracking($latestUserTracking->getId(), $curClubDeviceID, $curRssi, $status);
                            }

                        }
                    }
                }

            }
        }
    }
?>
        
        
