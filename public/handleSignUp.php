<!-- 1-validation
2-Filteration -->

<?php
//1-Validation of Email and password not empty
require_once('classesOop.php');

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['fName']) && !empty($_POST['lName']) &&!empty('phone_no')) {


    // echo '10/10';
    // 2-Filteration
    $email = htmlspecialchars(trim($_POST['email']));
    //htmlspecialchars used in case if enterd data is in html syntax to recognize it as original text
    //trim used to remove spaces
    $password = md5(trim($_POST['password']));
    //md5 used for encryption of password but password must be inserted in DB encrypted(MD5)
    $fName = trim($_POST['fName']);
    $lName = trim($_POST['lName']);
    $phone_no=trim($_POST['phone_no']);

    $result = customer::signUp($email, $password, $fName,$lName,$phone_no); //returns customer either found or null
    //after SignUp redirect to LogIn page
    if (!empty($result)) {
        header("location:index.php");
    }
   //    else{
    //     header("location:SignUp.php?msg=empty_field");
    //    }

} else {
    //Return to the previous page with message in get
    header("location:SignUp.php?msg=empty_field");
}

