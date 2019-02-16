<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <!--Latest compiled and minified CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!--Latest compiled and minified JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!--Latest compiled and minified JavaScript-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <link rel="stylesheet"type="text/css" href="./style.css">

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php
                                        if(isset($_SESSION['username'])) {
                                            echo 'main.php';
                                        } else {
                                            echo 'index.php';
                                        }
                                      ?>">HOME</a>
        <h1 class="text-info">DATA TESTING SYSTEM</h1>
        <div>
            <?php
                if(isset($_SESSION['username'])) {
                    $fullname = $_SESSION['lastname'].$_SESSION['firstname'];
                    echo '<form class="navbar-form" action="includes/db_logout.php" method="POST">
                                <h6 class="text-white bg-dark" style="padding-top: 5px">Hi '.$fullname.', Welcome to our system!</h6>
                                <button class="btn btn-primary" type="submit" name="submit">Logout</button></form>';
                } else {
                    echo ' <form class="navbar-form" action="includes/db_login.php" method="POST">
                                <input  type="text" name="uid" placeholder="Username or Email"/>
                                <input  type="password" name="password" placeholder="Password"/>
                                <button class="btn btn-primary" type="submit" name="submit" >Login</button></form>
                              <h6 class="text-white bg-dark" style="padding-top: 5px">Already a member? <a class="text-warning" href="signup.php">Sign Up Now</a> </h6>';
                }
            ?>
        </div>
    </nav>
</head>