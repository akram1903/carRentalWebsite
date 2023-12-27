<!-- 1-validation
2-Filteration -->

<?php
//1-Validation of Email and password not empty
require_once('classesOop.php');
//open session so that the user object returned form login function is seen by all pages 
session_start();
if (!empty($_POST['email']) && !empty($_POST['password'])) {


    // echo '10/10';
    // 2-Filteration
    $email = htmlspecialchars(trim($_POST['email']));
    //htmlspecialchars used in case if enterd data is in html syntax to recognize it as original text
    //trim used to remove spaces
    $password = md5(trim($_POST['password']));
    //md5 used for encryption of password but password must be inserted in DB encrypted(MD5)

    //call static function from class user without creating Object
    $user = customer::login($email, $password); //returns user either found or null
    if (!empty($user)) {
        //if user found before redirecting to home put in sesseion
        //To put object in session you must use->serialize
        // $_SESSION["KeyName"]=serialize($ObjectName);
        $_SESSION["user"] = serialize($user);
        header("location:home.php");
    } else {
        header("location:index.php?msg=Wrong_Credintials");
    }
} else {
    //Return to the previous page with message in get
    header("location:index.php?msg=empty_field");
}
