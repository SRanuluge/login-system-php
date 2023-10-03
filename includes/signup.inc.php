<?php

if (isset($_POST["submit"])) {

    // Grabbing the data
    $user_name = $_POST["uid"];
    $user_email = $_POST["email"];
    $user_pwd = $_POST["pwd"];
    $user_confirm_pwd = $_POST["c-pwd"];

    echo $user_name;

    //instantiate signup Controller class
    // include_once './config.session.inc.php';
    include '../classes/dbh.classes.php';
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($user_name, $user_email, $user_pwd, $user_confirm_pwd);

    //Running error handlers and user signup
    $signup->signupUser();

    //Going to back to front page
    header('location: ../index.php?error=none');
}
