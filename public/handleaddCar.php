<?php
session_start();
require('classesOop.php');
// var_dump($_POST); //content is sent in post super global array
// var_dump($_FILES); //image is sent in files super global array (Multi-dimention associative array)
//Post Validation
// if (empty($_POST["plate_id"]) && empty($_FILES["image"])) {
//     header("location:profile.php?msg=empty_field");
// }
// //Generate Imgae Name To avoid same names problem
// else {

    
    $plate_id = htmlspecialchars(trim($_POST["plate_id"]));
    //pathinfo Function to get the file extension
    $model = htmlspecialchars(trim($_POST["model"]));
    $make = htmlspecialchars(trim($_POST["make"]));
    $year = htmlspecialchars(trim($_POST["year"]));
    $price = htmlspecialchars(trim($_POST["price"]));
    $office_id= htmlspecialchars(trim($_POST["office_id"]));
   

    $rslt = admin::addcar($plate_id, $model, $make,$year,$price,$office_id);

    header("location:home2.php?msg=done");
// }
