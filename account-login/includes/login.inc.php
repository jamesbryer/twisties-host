<?php

if (isset($_POST["submit"])) {

    //getting data from the form
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    // instantiate class
    include "../classes/dbh.class.php";
    include "../classes/login.class.php";
    include "../classes/login-controller.class.php";


    $login = new LoginController($uid, $pwd);


    // error handlers and user signup
    $login->loginUser();


    // going back to front page
    header("location: ../../");
} else {
    //header("location: ../account-login/index.php?error=nodata");
}
