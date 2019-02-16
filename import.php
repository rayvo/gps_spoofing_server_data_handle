<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-22
 * Time: 18:13
 */
include_once 'header.php';
require 'vendor/autoload.php';
require 'includes/dbhelper.php';
use PhpOffice\PhpSpreadsheet\IOFactory;


$inputFileType = 'Xlsx';
$inputFileName = './sampledata/user_data.xlsx';

$reader = IOFactory::createReader($inputFileType);
$reader->setReadDataOnly(true);

$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

echo "<div class='container'>";

echo "<h2 class='text-primary' style='padding-top: 20px'>Import Result</h2>";
//Insert new row with place data;
$sql = '';
for ($row = 2; $row <= count($sheetData); $row++) {
    $username = $sheetData[$row]['C'];
    $password = $sheetData[$row]['D'];

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $sheetData[$row]['D'] = $hashedPwd;

    $xx = "'".implode("','", $sheetData[$row])."'";

    $sql = "INSERT INTO users (firstname, lastname, username, password, birthday, cellphone, email, address, gender, reg_date) VALUES($xx);";
    //echo($sql)."<br>";
    if($conn->query($sql) === TRUE) {
        echo "<h6 class='text-success'>INSERTED SUCCESSFULLY username '$username'</h6><br>";
    } else {
        $error = $conn->error;
        echo "<h6 class='text-danger'>";
        if(strpos($error, "username") !== false) {
            echo "ERROR: Username ".$username." has been taken!";
        } else {
            echo "ERROR: ".$conn->error;
        }
        echo "</h6>";
    }
}

echo "<h2 class='text-primary' style='padding-top: 20px'><a href='main.php'>Go Back</a></h2>";
echo "</div>";
include_once 'footer.php';





//var_dump($sheetData);
