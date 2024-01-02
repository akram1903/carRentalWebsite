<?php
session_start();
require_once('navBar.php');
if (empty($_SESSION["customer"])) {
    header("location:forbidden.php");
}

require_once('classesOop.php');
//To get the user object from session
// $customer = unserialize($_SESSION["customer"]);

$customer=unserialize($_SESSION["customer"]);
//  var_dump($car);
// var_dump($customer);
// var_dump($reserved_duration);
// var_dump($_POST["Car_plate_id"]);
$car=customer::getCar($_POST["Car_plate_id"]);
// var_dump($car);
if (!empty($car)) {
    //if customer found before redirecting to home put in sesseion
    //To put object in session you must use->serialize
    // $_SESSION["KeyName"]=serialize($ObjectName);
    $_SESSION["car"] = serialize($car);
    
}

// $reserved_duration= customer::getreservedDuration($car["0"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>

</head>

<body>

   
    <form action="invoice.php" method="post">
        <div class="flex items-center justify-center min-h-screen bg-indigo-100">
            <div class="w-3/4 bg-white shadow-lg rounded-xl overflow-hidden">

                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">Order Date : <span class="text-sm font-medium"> <?= date("d/m/Y"); ?></span></h6>

                        <div class="flex items-center justify-between">

                            <span class="mx-4 text-gray-500">from</span>

                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 start-date" placeholder="Select date start">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>

                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 end-date " placeholder="Select date end">
                            </div>


                        </div>
    </form>
    </div>
    <!-- <div class="w-40">
                    <address class="text-sm">
                        <span class="font-bold"> Billed To : </span>
                        <?= $customer->fName ?>
                        <?= $customer->lName ?>

                    </address>
                </div> -->

    </div>

    <div class="w-full h-0.5 bg-indigo-500"></div>

    <div class="p-4">
        <div class="flex items-center justify-evenly">

            <button type="submit" class=" mx-2 rounded-xl py-2 px-6 uppercase text-s cursor-pointer border-indigo-500 border-2 hover:text-white hover:bg-indigo-500 transition ease-out duration-500 text-indigo-500">
                invoice
            </button>

        </div>
        <div>

        </div>
    </div>

    </div>
    </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize flatpickr for the start date
            flatpickr(".start-date", {
                dateFormat: "Y-m-d",
                minDate: "2024-1-2", // Replace with your desired start date
                defaultDate: "Select Start date", // Replace with your desired start date
            });

            // Initialize flatpickr for the end date
            flatpickr(".end-date", {
                dateFormat: "Y-m-d",
                minDate: "2024-1-3", // Replace with your desired start date
            });
        });
    </script>
</body>

</html>