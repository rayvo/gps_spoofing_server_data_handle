<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-21
 * Time: 10:47
 */



/**
 * @param $curUserDeviceMAC
 * @param $curClubDeviceId
 * @param $curRssi
 */
function trackUser($curUserDeviceMAC, $curClubDeviceId, $curRssi) {
    //if it is a ble
    $userID = getUserIdByMAC($curUserDeviceMAC); //check if it belongs to our club?
    
    if ($userID != null) {
        //m_log("OUT:".$userID);
        //m_log("TAEYU userID=$userID"); 
        if($userID==-1) {
            //m_log("DEVICE BELONGS TO OUR CLUB, BUT NOT ASSIGNED YET");
            //exit(); // Do not need to catch the signal
        } elseif  ($userID >= 1) {
            //m_log("Te".PHP_EOL);
            $latestUserTracking = getLatestUserTracking($userID);
            if($latestUserTracking == null) { // the first detection ever
                insertUserTracking($userID, $curClubDeviceId, $curRssi, 1);
                //create an event to check if he is just passing the gate by chance (not login)
                //resetNoneCheckinUser($userID);
            } else { // status is always greater or equal 1
                $lastId = $latestUserTracking->getId();
                $lastStatus = $latestUserTracking->getStatus();
                $lastClubDeviceID = $latestUserTracking->getClubDeviceId();
                $lastRssi = $latestUserTracking->getRssi();
                $username = "$latestUserTracking->getRssi()";
                m_log("Username=$username");
                if ($lastClubDeviceID == $curClubDeviceId) { //The same gateways
                    if ($lastStatus  === 1) {
                        m_log("SAME GW + LastStatus = 1 --> INSERT USER_TRACKING with STATUS = 2: user_id=".$userID.", club_device_id=".$curClubDeviceId.", rssi=".$curRssi.", status= 2");
                        insertUserTracking($userID, $curClubDeviceId, $curRssi, 2);
                    } elseif ($lastStatus >=2) {
                        m_log("SAME GW + LastStatus = 2 UPDATE USER_TRACKING: user_id=".$userID.", club_device_id=".$curClubDeviceId.", rssi=".$curRssi.", status= ".$lastStatus);
                        updateUserTracking($lastId, $curClubDeviceId, $curRssi, $lastStatus);
                        //updateUserTracking(-1, $curClubDeviceId, $curRssi, $lastStatus);

                    }
                } else { // Different gateways
                    //Check if the new detection gateway captured higher rssi
                    if ($curRssi > $lastRssi) { //The ble is detected by multiple gw at the same time, but moving toward a new GW
                        m_log("DIFFERENT GW + NEW_RSSI>LAST_RSSI: INSERT USER_TRACKING - MULTIPLE GATEWAYS DETECTED, BUT IT IS MOVING TOWARD A NEW GW");
                        insertUserTracking($userID, $curClubDeviceId, $curRssi, $lastStatus + 1);
                    }
                }

            }
        }
    }
}