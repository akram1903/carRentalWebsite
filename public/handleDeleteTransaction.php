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
   
   $reservation_no=$_POST["reservation_no"];
    $rslt = admin::deleteReservation($reservation_no);

    header("location:Allreservations.php?msg=done");
// }
