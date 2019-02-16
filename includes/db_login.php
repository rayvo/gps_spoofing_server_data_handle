<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-23
 * Time: 15:38
 */

session_start();

if(isset($_POST['submit'])) {

    include_once 'dbhelper.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //Error handlers
    //Check for empty fields
    if(empty($uid) || empty($password)) {
        header("Location: ../index.php?login=empty&uid=$uid");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$uid' OR email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1) {
            header("Location: ../index.php?login=uid_not_found&uid=$uid");
            exit();
        } else {
            if($row=mysqli_fetch_assoc($result)) {
                //De-hasing the password
                $pass = $row['password'];

                $hashedPwd = password_hash($row['password'], PASSWORD_DEFAULT);


                $hashedPwdCheck = password_verify($password, $pass);
                if ($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=error&pass=$pass&hashedPwd=$hashedPwd&check=$hashedPwdCheck");
                    //header("Location: ../index.php?login=error&pass=$pass&hashedPwd=$hashedPwd&check=$hashedPwdCheck");
                    exit();
                } elseif($hashedPwdCheck == true) { //We want to check for sure
                    //Log in the user here
                    $_SESSION['firstname']=$row['firstname'];
                    $_SESSION['lastname']=$row['lastname'];
                    $_SESSION['username']=$row['username'];
                    $_SESSION['email']=$row['email'];
                    header("Location: ../main.php?login=success");
                    exit();
                }
            }
        }
    }
}