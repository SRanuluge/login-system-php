

<?php

if (isset($_POST["submit"])) {

    // Grabbing the data
    $user_name = $_POST["uid"];
    $user_pwd = $_POST["pwd"];

    //instantiate login Controller class
    // include_once './config.session.inc.php';
    include '../classes/dbh.classes.php';
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($user_name,  $user_pwd);

    //Running error handlers and user signup
    $login->loginUser();

    //Going to back to front page
    header('location: ../home.php');
}
