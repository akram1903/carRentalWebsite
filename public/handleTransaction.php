
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $cardType = isset($_POST['type1']) ? $_POST['type1'] : 'not selected';
    $nameOnCard = isset($_POST['name_on_card']) ? $_POST['name_on_card'] : '';
    $cardNumber = isset($_POST['card_number']) ? $_POST['card_number'] : '';
    $expirationMonth = isset($_POST['expiration_month']) ? $_POST['expiration_month'] : '';
    $expirationYear = isset($_POST['expiration_year']) ? $_POST['expiration_year'] : '';
    $securityCode = isset($_POST['security_code']) ? $_POST['security_code'] : '';

    echo("<h1> in handle transaction</h1>");
    // You can perform further processing/validation of data here

    
} else {
    echo "<p>No data received.</p>";
}
?>