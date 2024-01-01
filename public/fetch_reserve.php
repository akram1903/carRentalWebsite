<?php

include('configs/database.php');
include('functions.php');
$output = array();
$customerEmail = 'ali@gmail.com';

$query = $databaseConnexion->prepare("
    SELECT reservation.*
    FROM reservation
    JOIN customer ON reservation.Customer_ssn = customer.ssn
    WHERE customer.email = :email
");

$query->bindParam(':email', $customerEmail);
$query->execute();
$result = $query->fetchAll();
$data = array();
$filtered_rows = $query->rowCount();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row["reservation_no"];
    $sub_array[] = $row["reserve_date"];
    $sub_array[] = $row["pickup_date"];
    $sub_array[] = $row["return_date"];
    $sub_array[] = $row["damage_compensation"];
    $sub_array[] = $row["pickup_location"];
    $sub_array[] = $row["Car_plate_id"];
    $sub_array[] = $row["Customer_ssn"];
    $sub_array[] = $row["payment_date"];
    $sub_array[] = $row["payment_Method"];
    $sub_array[] = '<button type="button" name="delete" id="' . $row["reservation_no"] . '" class="btn btn-danger btn-xs delete" style="background-color: #d9534f; color: #fff; border: 1px solid #d9534f; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records($databaseConnexion, 'reservation'),
    "data"    => $data
);

echo json_encode($output);
