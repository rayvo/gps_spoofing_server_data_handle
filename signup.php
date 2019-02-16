<?php
    include_once 'header.php';
?>
<section class="main-container">
    <article class=""index-form">
        <div class="container" style="padding-top: 15px">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <form class="signup-form" action="includes/db_signup.php" method="POST">

                        <!-- <div class="form-group">
                            <label for="name">Gender  (*):</label>
                            <?php
                                if(isset($_GET['customRadioInline1'])) {
                                    $gender = $_GET['customRadioInline1'];
                                    if($gender =="M") {
                                        echo '<div class="custom-control custom-radio custom-control-inline">'.
                                            ' <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked="checked" value="M">'.
                                            ' <label class="custom-control-label" for="customRadioInline1">Male</label></div>'.
                                            '<div class="custom-control custom-radio custom-control-inline">'.
                                            '<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="F">'.
                                            '<label class="custom-control-label" for="customRadioInline2">Female</label></div>';
                                    } elseif($gender =="F") {
                                        echo '<div class="custom-control custom-radio custom-control-inline">'.
                                            ' <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="M">'.
                                            ' <label class="custom-control-label" for="customRadioInline1">Male</label></div>'.
                                            '<div class="custom-control custom-radio custom-control-inline">'.
                                            '<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" checked="checked" value="F">'.
                                            '<label class="custom-control-label" for="customRadioInline2">Female</label></div>';
                                    } else {
                                        echo '<div class="custom-control custom-radio custom-control-inline">'.
                                            ' <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="M">'.
                                            ' <label class="custom-control-label" for="customRadioInline1">Male</label></div>'.
                                            '<div class="custom-control custom-radio custom-control-inline">'.
                                            '<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="F">'.
                                            '<label class="custom-control-label" for="customRadioInline2">Female</label></div>';
                                    }
                                } else {
                                    echo '<div class="custom-control custom-radio custom-control-inline">'.
                                            ' <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="M">'.
                                            ' <label class="custom-control-label" for="customRadioInline1">Male</label></div>'.
                                        '<div class="custom-control custom-radio custom-control-inline">'.
                                            '<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="F">'.
                                            '<label class="custom-control-label" for="customRadioInline2">Female</label></div>';
                                }
                            ?>

                        </div> -->
                        <div class="form-group">
                            <label for="name">Name  (*):</label>
                            <?php
                                if(isset($_GET['name'])) {
                                    $firstname = $_GET['name'];
                                    echo '<input class="form-control" type="text" name="name" placeholder="예) 임태유" value="'.$name.'">';
                                } else {
                                    echo '<input class="form-control" type="text" name="name" placeholder="예) 임태유">';
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Password  (*):</label>
                            <input class="form-control" type="password" name="password" placeholder="[a-z][A-Z][0-9]">
                        </div>
                        <div class="form-group">
                            <label for="name">Confirm Password  (*):</label>
                            <input class="form-control" type="password" name="conf_password">
                        </div>
                        <div class="form-group">
                            <label for="name">Email  (*):</label>
                            <?php
                            if(isset($_GET['email'])) {
                                $email= $_GET['email'];
                                echo '<input class="form-control" type="text" name="email" placeholder="예) taeyu@naver.com" value="'.$email.'">';
                            } else {
                                echo '<input class="form-control" type="text" name="email" placeholder="예) taeyu@naver.com">';
                            }
                            ?>

                        </div>
                        <div class="form-group">
                            <label for="name">Cellphone:</label>
                            <?php
                            if(isset($_GET['phone'])) {
                                $cellphone= $_GET['cellphone'];
                                echo '<input class="form-control" type="text" name="phone" placeholder="예) 010-1234-5678" value="'.$phone.'">';
                            } else {
                                echo '<input class="form-control" type="text" name="phone" placeholder="예) 010-1234-5678">';
                            }
                            ?>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Sign up</button>
                        </div>
                    </form>
                    <?php
                      /* This approach show the error message at the bottom, not user-friendly
                      $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($fullUrl,"signup=sex") == true) {
                            echo "<p class='text-warning'> You did not select the gender!";
                            exit();
                        }
                      */

                      if(!isset($_GET['signup'])) {
                          exit();
                      } else {
                          $signupCheck = $_GET['signup'];
                          if ($signupCheck == "sex") {
                              echo "<p class='text-danger'> You did not select the gender!";
                              exit();
                          }
                          if ($signupCheck == "empty") {
                              echo "<p class='text-danger'> You did not fill in all required fields(*)!";
                              exit();
                          }
                          if ($signupCheck == "username") {
                              echo "<p class='text-danger'> Username must be in alphabet letters or numbers!";
                              exit();
                          }
                          if ($signupCheck == "usertaken") {
                              echo "<p class='text-danager'> Username has been already taken!";
                              exit();
                          }
                          if ($signupCheck == "email") {
                              echo "<p class='text-danger'> You did not fill a valid email!";
                              exit();
                          }
                          if ($signupCheck == "emailtaken") {
                              echo "<p class='text-danger'> Email has been already taken!";
                              exit();
                          }
                          if ($signupCheck == "diff_pwd") {
                              echo "<p class='text-danger'> Passwords are different!";
                              exit();
                          }
                          if ($signupCheck == "database") {
                              echo "<p class='text-danger'> Database is under upgrade at this moment. Please try again later!";
                              exit();
                          }
                          if ($signupCheck == "success") {
                              echo "<p class='text-success'> Successfully Signed Up!";
                              exit();
                          }
                      }
                    ?>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </article>
</section>

<?php
   include_once 'footer.php';
?>
