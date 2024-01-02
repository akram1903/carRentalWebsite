<?php
// <!-- 1-validation
// 2-Filteration -->

//1-Validation of Email and password not empty
require_once('classesOop.php');
//open session so that the customer object returned form login function is seen by all pages 
session_start();
if (!empty($_POST['email']) && !empty($_POST['password'])) {


    // echo '10/10';
    // 2-Filteration
    $email = htmlspecialchars(trim($_POST['email']));
    //htmlspecialchars used in case if enterd data is in html syntax to recognize it as original text
    //trim used to remove spaces
    $password = md5(trim($_POST['password']));
    $role=$_POST['role'];
    var_Dump($role);
    //md5 used for encryption of password but password must be inserted in DB encrypted(MD5)
if ($role=='admin'){
     //call static function from class customer without creating Object
     $admin = admin::login($email, $password); //returns customer either found or null
     var_dump($admin);
     if (!empty($admin)) {
        //if customer found before redirecting to home put in sesseion
        //To put object in session you must use->serialize
        // $_SESSION["KeyName"]=serialize($ObjectName);
        $_SESSION["admin"] = serialize($admin);
        header("location:home2.php");
    } else {
        header("location:index.php?msg=Wrong_Credintials");
    }
}
else{
     //call static function from class customer without creating Object
     $customer = customer::login($email, $password); //returns customer either found or null
     var_dump( $customer );
     if (!empty($customer)) {
        //if customer found before redirecting to home put in sesseion
        //To put object in session you must use->serialize
        // $_SESSION["KeyName"]=serialize($ObjectName);
        $_SESSION["customer"] = serialize($customer);
        header("location:home.php");
    } else {
        header("location:index.php?msg=Wrong_Credintials");
    }

}

} else {
    //Return to the previous page with message in get
    header("location:index.php?msg=empty_field");
}
