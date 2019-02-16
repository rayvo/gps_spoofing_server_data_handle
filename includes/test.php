<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-23
 * Time: 16:27
 */
include_once 'dbhelper.php';

$pass = "cf123";

$hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

echo $hashedPwd;

echo "<br>";

echo password_verify($pass, '$2y$10$C7Mf2lR.UZBXcttp5e1MveQmqTkQJmYdO.mwBe.HUUMtkulREAeTG');

echo "<br>";

$sql = "SELECT CURRENT_TIMESTAMP;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($row=mysqli_fetch_assoc($result)) {
    //De-hasing the password
    echo $row['CURRENT_TIMESTAMP'];
} else {

}

//SHOW COLUMNS FROM users
