<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  require_once('navBar.php');
  if (empty($_SESSION["customer"])) {
    header("location:forbidden.php");
  }
  require_once('classesOop.php');
  //To get the user object from session
  $customer = unserialize($_SESSION["customer"]);
//   $Advanced_search_result = $customer->Advanced_search();
// var_dump($cars);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
</head>
<body>
<form method="post" class="container mx-auto my-8">
    <div name ="data 1"> 
    <div class="flex items-center p-3">  
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            </div>
            <input name="start_date" type="text" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start Date" required>
        </div>

        <!-- Add some spacing between the two input fields -->
        <div class="ms-4"></div>

        <input name="end_date" type="text" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End Date" required>

    <button name="submit" type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>Search
    </button>
    </div>
    <div class="container mx-auto my-8 text-center ">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">All reservations including car and customer information.</h2>

        <table class="min-w-full bg-white border border-gray-300">

        <?php
        if(isset($_POST['submit']))
            {
                require_once('config.php');
                $start_date =$_POST['start_date'];
                $end_date =$_POST['end_date'];
                $qry = 
                "SELECT *
                FROM reservation join Car on Car_plate_id=plate_id join Customer on ssn = Customer_ssn
                where '$start_date' < reserve_date And '$end_date' > reserve_date;";
                $connection_to_db = mysqli_connect(DB_host,DB_user_name,DB_user_password,DB_name); 
                $result = mysqli_query($connection_to_db,$qry); 
                $data = mysqli_fetch_all($result);
                $cars = $data;
                //mysqli_close($connection_to_db);
                if(mysqli_num_rows($result)>0){
                    echo ' <thead>
                    <tr>
                        <th class="py-2 px-4 border-b ">reservation number</th>
                        <th class="py-2 px-4 border-b">reservation date</th>
                        <th class="py-2 px-4 border-b">pickup date</th>
                        <th class="py-2 px-4 border-b">return date</th>
                        <th class="py-2 px-4 border-b">Car plate id</th>
                        <th class="py-2 px-4 border-b">Customer_ssn</th>
                        <th class="py-2 px-4 border-b">payment amount</th>
                        <th class="py-2 px-4 border-b">model</th>
                        <th class="py-2 px-4 border-b">Make</th>
                        <th class="py-2 px-4 border-b">year</th>
                        <th class="py-2 px-4 border-b">price</th>
                        <th class="py-2 px-4 border-b">registration date</th>
                        <th class="py-2 px-4 border-b">Office id</th>
                        <th class="py-2 px-4 border-b">reserved</th>
                        <th class="py-2 px-4 border-b">first name</th>
                        <th class="py-2 px-4 border-b">last name</th>
                        <th class="py-2 px-4 border-b">email</th>
                        <th class="py-2 px-4 border-b">phone number</th>


                    </tr>
                </thead>';
                ?>
<!--                  	
reservation_no	
reserve_date	
pickup_date	
return_date	
damage_compensation	4
pickup_location	
Car_plate_id	
Customer_ssn	
payment_date	
payment_Method	
plate_id	10
model	
make	
year	
price	
registration_date	
office_office_id	
reserved	
ssn	16
fName	
lName	
email	
phone_no	
password	
wallet	 -->
                <tbody>

                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $car["0"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["1"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["2"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["3"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["4"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["5"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["6"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["7"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["8"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["9"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["11"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["12"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["13"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["14"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["16"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["17"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["18"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["19"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["20"]; ?></td>

                <?php endforeach; ?>
            </tbody>
            <?php
                }else{
                    ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">No such data!</span> Change a few things up and try searching again.
        </div>
                    <?php    
                    }
            } 
                    ?>
 
        </table>
        </div>

        <!-- table one end  -->

        <!-- table two start  -->

        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            </div>
            <input name="start_date1" type="text" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start Date" required>
        </div>

        <!-- Add some spacing between the two input fields -->
        <div class="ms-4"></div>

        <input name="end_date1" type="text" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End Date" required>

    <button name="submit1" type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>Search
    </button>
    <div class="container mx-auto my-8 text-center ">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">All reservations including car information.</h2>

        <table class="min-w-full bg-white border border-gray-300">

        <?php
        if(isset($_POST['submit1']))
            {
                require_once('config.php');
                $start_date =$_POST['start_date1'];
                $end_date =$_POST['end_date1'];
                $qry1 = 
                "SELECT *
                FROM reservation join Car on Car_plate_id=plate_id 
                where '$start_date' < reserve_date And '$end_date' > reserve_date;";
                $connection_to_db = mysqli_connect(DB_host,DB_user_name,DB_user_password,DB_name); 
                $result = mysqli_query($connection_to_db,$qry1); 
                $data = mysqli_fetch_all($result);
                $cars = $data;
                //mysqli_close($connection_to_db);
                if(mysqli_num_rows($result)>0){
                    echo ' <thead>
                    <tr>
                        <th class="py-2 px-4 border-b ">reservation number</th>
                        <th class="py-2 px-4 border-b">reservation date</th>
                        <th class="py-2 px-4 border-b">pickup date</th>
                        <th class="py-2 px-4 border-b">return date</th>
                        <th class="py-2 px-4 border-b">Car plate id</th>
                        <th class="py-2 px-4 border-b">Customer_ssn</th>
                        <th class="py-2 px-4 border-b">payment date</th>
                        <th class="py-2 px-4 border-b">payment Method</th>
                        <th class="py-2 px-4 border-b">model</th>
                        <th class="py-2 px-4 border-b">Make</th>
                        <th class="py-2 px-4 border-b">year</th>
                        <th class="py-2 px-4 border-b">price</th>
                        <th class="py-2 px-4 border-b">registration date</th>
                        <th class="py-2 px-4 border-b">Office id</th>
                        <th class="py-2 px-4 border-b">reserved</th>
                    </tr>
                </thead>';
                ?>

                <tbody>

                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $car["0"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["1"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["2"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["3"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["4"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["5"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["6"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["7"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["8"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["9"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["11"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["12"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["13"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["14"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["15"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["17"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["18"]; ?></td>
        

                <?php endforeach; ?>
            </tbody>
            <?php
                }else{
                    ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">No such data!</span> Change a few things up and try searching again.
        </div>
                    <?php    
                    }
            } 
                    ?>
 
        </table>
    </div>
        <!-- table two end  --> 

        <!-- table three start  -->

        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            </div>
            <input name="day" type="text" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start Date" required>
        </div>

        <!-- Add some spacing between the two input fields -->
        <div class="ms-4"></div>

    <button name="submit2" type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>Search
    </button>
    <div class="container mx-auto my-8 text-center ">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">The status of all cars on a specific day..</h2>

        <table class="min-w-full bg-white border border-gray-300">

        <?php
        if(isset($_POST['submit2']))
            {
                require_once('config.php');
                $start_date =$_POST['day'];
                $qry1 = 
                "SELECT *
                FROM reservation join Car on Car_plate_id=plate_id 
                where '$start_date' < reserve_date And '$end_date' > reserve_date;";
                $connection_to_db = mysqli_connect(DB_host,DB_user_name,DB_user_password,DB_name); 
                $result = mysqli_query($connection_to_db,$qry1); 
                $data = mysqli_fetch_all($result);
                $cars = $data;
                //mysqli_close($connection_to_db);
                if(mysqli_num_rows($result)>0){
                    echo ' <thead>
                    <tr>
                        <th class="py-2 px-4 border-b ">reservation number</th>
                        <th class="py-2 px-4 border-b">reservation date</th>
                        <th class="py-2 px-4 border-b">pickup date</th>
                        <th class="py-2 px-4 border-b">return date</th>
                        <th class="py-2 px-4 border-b">pickup location</th>
                        <th class="py-2 px-4 border-b">Car plate id</th>
                        <th class="py-2 px-4 border-b">Customer_ssn</th>
                        <th class="py-2 px-4 border-b">payment date</th>
                        <th class="py-2 px-4 border-b">payment Method</th>
                        <th class="py-2 px-4 border-b">model</th>
                        <th class="py-2 px-4 border-b">Make</th>
                        <th class="py-2 px-4 border-b">year</th>
                        <th class="py-2 px-4 border-b">price</th>
                        <th class="py-2 px-4 border-b">registration date</th>
                        <th class="py-2 px-4 border-b">Office id</th>
                        <th class="py-2 px-4 border-b">reserved</th>
                    </tr>
                </thead>';
                ?>

                <tbody>

                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $car["0"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["1"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["2"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["3"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["5"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["6"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["7"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["8"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["9"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["11"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["12"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["13"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["14"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["15"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["17"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["18"]; ?></td>
        

                <?php endforeach; ?>
            </tbody>
            <?php
                }else{
                    ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">No such data!</span> Change a few things up and try searching again.
        </div>
                    <?php    
                    }
            } 
                    ?>
 
        </table>
    </div>
        <!-- table three end  -->
        <!-- table fout start  -->

        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            </div>
            <input name="customer_id" type="text" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start Date" required>
        </div>

        <!-- Add some spacing between the two input fields -->
        <div class="ms-4"></div>

    <button name="submit3" type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>Search
    </button>
    <div class="container mx-auto my-8 text-center ">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">All reservations of specific customer including customer information, car
model and plate id.</h2>

        <table class="min-w-full bg-white border border-gray-300">

        <?php
        if(isset($_POST['submit3']))
            {
                require_once('config.php');
                $customer_id =$_POST['customer_id'];
                $qry2 = 
                "SELECT
                r.reservation_no,
                r.reserve_date,
                r.pickup_date,
                r.return_date,
                r.damage_compensation,
                r.pickup_location,
                r.payment_date,
                r.payment_Method,
                c.model AS car_model,
                c.plate_id AS car_plate_id,
                cu.ssn AS customer_ssn,
                cu.fName AS customer_first_name,
                cu.lName AS customer_last_name,
                cu.email AS customer_email,
                cu.phone_no AS customer_phone_number
            FROM
                CarRentalSystem.reservation r
            JOIN
                CarRentalSystem.Car c ON r.Car_plate_id = c.plate_id
            JOIN
                CarRentalSystem.Customer cu ON r.Customer_ssn = cu.ssn
            WHERE
                cu.ssn = '$customer_id';";
                $connection_to_db = mysqli_connect(DB_host,DB_user_name,DB_user_password,DB_name); 
                $result = mysqli_query($connection_to_db,$qry2); 
                $data = mysqli_fetch_all($result);
                $cars = $data;
                //mysqli_close($connection_to_db);
                if(mysqli_num_rows($result)>0){
                    echo ' <thead>
                    <tr>
                        <th class="py-2 px-4 border-b ">reservation number</th>
                        <th class="py-2 px-4 border-b">reservation date</th>
                        <th class="py-2 px-4 border-b">pickup date</th>
                        <th class="py-2 px-4 border-b">return date</th>
                        <th class="py-2 px-4 border-b">pickup location</th>
                        <th class="py-2 px-4 border-b">payment date</th>
                        <th class="py-2 px-4 border-b">payment Method</th>
                        <th class="py-2 px-4 border-b">Car model</th>
                        <th class="py-2 px-4 border-b">Car plate id</th>
                        <th class="py-2 px-4 border-b">Customer Ssn</th>
                        <th class="py-2 px-4 border-b">First name</th>
                        <th class="py-2 px-4 border-b">Last namer</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">phone number</th>

                    </tr>
                </thead>';
                ?>

                <tbody>

                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $car["0"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["1"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["2"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["3"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["5"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["6"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["7"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["8"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["9"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["10"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["11"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["12"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["13"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["14"]; ?></td>
        
                <?php endforeach; ?>
            </tbody>
            <?php
                }else{
                    ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">No such data!</span> Change a few things up and try searching again.
        </div>
                    <?php    
                    }
            } 
                    ?>
 
        </table>
    </div>

</form>



</body>
</html>