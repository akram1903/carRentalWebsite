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
   
   $plate_id=$_POST["plate_id"];
    $rslt = admin::deletecar($plate_id);

    header("location:home2.php?msg=done");
// }
