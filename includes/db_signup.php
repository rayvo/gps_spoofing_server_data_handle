<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-23
 * Time: 11:55
 */
if (isset($_POST['submit'])) {
    include_once 'dbhelper.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $conf_password = mysqli_real_escape_string($conn, $_POST['conf_password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    //Error handlers

    //Check for empty fields
    if (empty($name) || empty($password) || empty($conf_password) || empty($email)) {
        header("Location: ../signup.php?signup=empty&name=$name&password=$password&conf_password=$conf_password&email=$email&phone=$phone");
        exit();
    } else {
        //Check if input characters are valid
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?signup=email&name=$name&password=$password&conf_password=$conf_password&email=$email&phone=$phone");
            exit();
        } else {
            //Check if email has already been taken
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?signup=emailtaken&name=$name&password=$password&conf_password=$conf_password&email=$email&phone=$phone");
                exit();
            } else {
                //Check if confirm password is not the same
                if ($password !== $conf_password) {
                    header("Location: ../signup.php?signup=diff_pwd&name=$name&password=$password&conf_password=$conf_password&email=$email&phone=$phone");
                    exit();
                } else {
                    //Hashing the password
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    //Insert the user into the database;

                    $sql = "INSERT INTO users(name, password, phone, email, reg_date) " .
                        " VALUES ('$name', '$hashedPwd', '$phone', '$email', CURRENT_TIMESTAMP);";

                    //mysqli_query($conn, $sql);

                    if ($conn->query($sql) === true) {

                        header("Location: ../index.php?signup=success");
                        exit();
                    } else {
                        echo "INSERTED ERROR: " . $sql . "<br>" . $conn->error;
                        header("Location: ../signup.php?signup=empty&name=$name&password=$password&conf_password=$conf_password&email=$email&phone=$phone");
                        header("Location: ../signup.php?signup=database&customRadioInline1=$gender&firstname=$firstname&lastname=$lastname&username=$username&password=$password&conf_password=$conf_password&email=$email&cellphone=$cellphone&birthday=$birthday&address=$address");
                        exit();
                    }
                }
            }

        }
    }
} else {
    header("Location: ../signup.php");
    exit(); // stop everything after the exit() function
}
