<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-23
 * Time: 17:05
 */

if(isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}