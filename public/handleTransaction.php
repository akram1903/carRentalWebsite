<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieving form data
//     $cardType = isset($_POST['type1']) ? $_POST['type1'] : 'not selected';
//     $nameOnCard = isset($_POST['name_on_card']) ? $_POST['name_on_card'] : '';
//     $cardNumber = isset($_POST['card_number']) ? $_POST['card_number'] : '';
//     $expirationMonth = isset($_POST['expiration_month']) ? $_POST['expiration_month'] : '';
//     $expirationYear = isset($_POST['expiration_year']) ? $_POST['expiration_year'] : '';
//     $securityCode = isset($_POST['security_code']) ? $_POST['security_code'] : '';

//     echo("<h1> in handle transaction</h1>");
//     // You can perform further processing/validation of data here


// } else {
//     echo "<p>No data received.</p>";
// }

session_start();
require('classesOop.php');
if (empty($_SESSION["customer"])) {
    header("location:forbidden.php");
}
if (empty($_SESSION["car"])) {
    header("location:forbidden.php");
}

$customer = unserialize($_SESSION["customer"]);
$car = unserialize($_SESSION["car"]);
$carPlate = $car["0"]["0"];
$ssn = $customer->ssn;
$start = $_SESSION["start"];
$end = $_SESSION["end"];
$amount = $_SESSION["amount"];
// teeer 3ala database
require_once('connection.php');
$conn = Connect();
// not done yet
$reserveDate = date("Y-m-d");

$sql = "INSERT INTO reservation (Car_plate_id, Customer_ssn, pickup_date, return_date, reserve_date, amount) VALUES ('$carPlate','$ssn','$start','$end','$reserveDate',$amount);";
$sql .= "UPDATE CarRentalSystem.Car SET reserved = TRUE WHERE plate_id ='$carPlate';";

if($conn->multi_query($sql)===FALSE){
    echo "Error: " . $conn->error;
    die();
   
}
else{
    header("location:home.php?msg=Successful_Transaction");
}
// we need also to ulter car to change reserved to true
// $sql = "UPDATE CarRentalSystem.Car SET reserve = TRUE WHERE plate_id ='{$car['0']}';";

?>