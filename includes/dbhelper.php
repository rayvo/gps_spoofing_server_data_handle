<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-19
 * Time: 21:03
 */
include 'log.php';
require "ClubDevice.php";
require "UserTracking.php";

//Database Connection Information
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "c210120f";

//$dbUsername = "clubadmin";
//$dbPassword = "c123456f";

$dbName = "clubfit";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Change character set to utf8
mysqli_set_charset($conn,"utf8");


function getUserByMAC($mac)
{
    $sql = "SELECT * FROM ".User::TABLE_NAME." WHERE ".ClubDevice::COL_MAC_ADDRESS."='".$mac."';";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $resultCheck = mysqli_num_rows($result); //Check if we have the result
    $clubDevice = null;
    if ($resultCheck > 0) {
        $clubDevice = new ClubDevice;
        while ($row = mysqli_fetch_assoc($result)) {
            $clubDevice = ClubDevice::withRow($row);
        }
    }
    return $clubDevice;
}

function getUserIdByMAC($mac) {
    $sql = "SELECT user_id FROM user_devices WHERE mac_address = '".$mac."' AND status = 1;";
    //m_log($sql);
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $resultCheck = mysqli_num_rows($result); //Check if we have the result
    $userID = null;
    //m_log("TY");
    if($resultCheck > 0) {
        //m_log("TY2");
        while($row = mysqli_fetch_assoc($result)){
            //m_log("TY1");
            $userID = $row['user_id'];
            //m_log("mac=".$mac.", userID=".$userID);
        }
        //m_log("RETURN userID1=".$userID);
    }
    //m_log("RETURN userID2=".$userID);
    return $userID;
}

/*
 * Get user's latest status (1-N)
 * -: past day
 * i: ith detection
 * N: last detection of the day
 */
function getLatestUserTracking($userID) {
    $sql = "SELECT id, user_id, club_device_id, rssi, detected_time, status FROM user_trackings WHERE user_id = ".$userID." AND status > 0"
        ." ORDER BY status DESC LIMIT 1;";
    //m_log($sql);
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $resultCheck = mysqli_num_rows($result); //Check if we have the result
    $userTracking = null;
    if ($resultCheck > 0) {
        $userTracking = new UserTracking();
        while ($row = mysqli_fetch_assoc($result)) {
            $userTracking = UserTracking::withRow($row);
            //m_log("TY");
        }
    }
    //m_log("Detected UserID = ".$userTracking->getId());
    return $userTracking;
}

/*
 * insert user_trackings
 */
function insertUserTracking($userID, $clubDeviceID, $rssi, $status) {
    $sql = "INSERT INTO user_trackings(user_id, club_device_id, rssi, detected_time, status) VALUES ("
        .$userID.",".$clubDeviceID.",".$rssi.",CURRENT_TIMESTAMP, ".$status.");";
    m_log("SQL:".$sql.PHP_EOL);
    mysqli_query($GLOBALS['conn'], $sql);
}

/*
 * insert user_trackings
 */
function updateUserTracking($id, $clubDeviceID, $rssi, $status) {
    $sql = "UPDATE user_trackings SET club_device_id = ".$clubDeviceID.", rssi = ".$rssi
        .", detected_time = CURRENT_TIMESTAMP, status =".$status
        ." WHERE id = ".$id.";";
    //m_log("SQL:".$sql.PHP_EOL);
    mysqli_query($GLOBALS['conn'], $sql);
}

/*
 *
 */

function resetNoneCheckinUser($userId){
    $sql = "CREATE EVENT reset_none_checking_userid".$userId." ON SCHEDULE"
            ." AT (CURRENT_TIMESTAMP + INTERVAL 120 MINUTE_SECOND) ON COMPLETION PRESERVE ENABLE DO"
    	    ." UPDATE user_trackings SET status = status * (-1) WHERE status = 1 AND user_id = ".$userId.";";
    m_log("SQL:".$sql.PHP_EOL);
    mysqli_query($GLOBALS['conn'], $sql);
}

function getClubDevice($mac)
{
    $sql = "SELECT * FROM ".ClubDevice::TABLE_NAME." WHERE ".ClubDevice::COL_MAC_ADDRESS."='".$mac."';";
    //m_log("SQL=".$sql.PHP_EOL);
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $resultCheck = mysqli_num_rows($result); //Check if we have the result
    $clubDevice = null;
    if ($resultCheck > 0) {
        $clubDevice = new ClubDevice;
        while ($row = mysqli_fetch_assoc($result)) {
            $clubDevice = ClubDevice::withRow($row);
        }
    }
    return $clubDevice;
}

//TESTING

//$userID = getUserID("663700100017", "user_devices");
//echo $userID."<br>";

//$status = getLatestUserTracking(1);

