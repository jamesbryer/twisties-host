<?php

if (isset($_POST["submit"])) {

    //getting data from the form
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    // instantiate class
    include "../classes/dbh.class.php";
    include "../classes/signup.class.php";
    include "../classes/signup-controller.class.php";


    $signup = new SignupController($uid, $pwd, $pwd_repeat, $email);


    // error handlers and user signup
    $signup->signupUser();


    // going back to front page
    header("location: ../index.php?signup=success");
} else {
    header("location: ../account-login/index.php?error=nodata");
}