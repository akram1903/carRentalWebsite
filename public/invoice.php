<?php
session_start();
require_once('navBar.php');
if (empty($_SESSION["customer"])) {
    header("location:forbidden.php");
}
if (empty($_SESSION["car"])) {
    header("location:forbidden.php");
}
require_once('classesOop.php');
//To get the user object from session
$customer = unserialize($_SESSION["customer"]);
$car = unserialize($_SESSION["car"]);

$startDate= $_POST["start"];
$endDate = $_POST["end"];

// echo("$startDate<br>");
// echo("$endDate<br>");
// var_dump($car);
// var_dump($customer);
// Create DateTime objects from the date strings
$startDateTime = new DateTime($startDate);
$endDateTime = new DateTime($endDate);

// Calculate the difference between two dates
$interval = $startDateTime->diff($endDateTime);

$duration=$interval->days;
// Create DateTime objects from the string dates
// $startDateTime = DateTime::createFromFormat('m/d/Y', "$startDate");
// $endDateTime = DateTime::createFromFormat('m/d/Y', "$endDate");

//   $_SESSION["start"] = $startDateTime->format('Y-m-d');
//    $_SESSION["end"] = $endDateTime->format('Y-m-d');


 $_SESSION["start"] = $startDate;
 $_SESSION["end"] = $endDate;
//  var_dump($startDate);
    // var_dump($endDate);
// if($startDateTime!==null && $endDateTime!==FALSE){
    // Calculate the difference between dates
// $interval = $startDateTime->diff($endDateTime);
// var_dump($interval)

// Get the difference in days
// $daysDifference = $interval->format('%a');
// var_dump(daysDifference)
// }
// else{
    // var_dump($startDateTime);
    // var_dump($endDateTime);
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-indigo-100">
        <div class="w-3/4 bg-white shadow-lg rounded-xl overflow-hidden">
            
            <!-- <div class="w-full h-0.5 bg-indigo-500 my-5"></div> -->
            <div class="flex justify-between p-4">
                <div>
                    <h6 class="font-bold">Order Date : <span class="text-sm font-medium"> <?= date("d/m/Y"); ?></span></h6>
                    <!-- <h6 class="font-bold">rent Date: </h6>
                    <h6 class="font-bold">return date: <span class="text-sm font-medium"> 12/12/2022</span></h6> -->

                    <div date-rangepicker class="flex items-center">
                    <span class="mx-4 text-gray-500">from</span>
                        <div class="relative">
                            <?=$startDate?>
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <?=$endDate?>
                        </div>
                    </div>

                </div>
                <div class="w-40">
                    <address class="text-sm">
                        <span class="font-bold"> Billed To : </span>
                        <?= $customer->fName ?>
                        <?= $customer->lName ?>

                    </address>
                </div>
                <!-- <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold">Ship To :</span>
                            Joe doe
                            800 Folsom Ave
                            San Francisco, CA 94107
                            P: + 111-456-7890
                        </address>
                    </div> -->
                <!-- <div></div> -->
            </div>
            <div class="flex justify-center p-4">
                <div class="border-b border-gray-200 shadow">
                    <table class="">
                        <thead class="bg-indigo-500 text-black">
                            <tr>
                                <th class="px-4 py-2 text-xs">
                                    #
                                </th>
                                <th class="px-4 py-2 text-xs">
                                    Plate no
                                </th>
                                <th class="px-4 py-2 text-xs">
                                    Brand Name
                                </th>
                                <th class="px-4 py-2 text-xs ">
                                    model
                                </th>
                                <th class="px-4 py-2 text-xs ">
                                    year
                                </th>
                                <th class="px-4 py-2 text-xs ">
                                    duration
                                </th>
                                <th class="px-4 py-2 text-xs ">
                                    cost per day
                                </th>
                                <th class="px-4 py-2 text-xs ">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="whitespace-nowrap">
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    1
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?= $car["0"]["0"] ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?= $car["0"]["2"] ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900"> <?= $car["0"]["1"] ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900"> <?= $car["0"]["3"] ?></div>
                                </td>
                                
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <?= $duration ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $car["0"]["4"] ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <?= $duration*$car["0"]["4"] ?>
                                </td>
                            </tr>

                            <!-- <tr class="border-b-2 whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        3
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            Amazon Brand - Symactive Men's Regular Fit T-Shirt
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">1</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        $10
                                    </td>
                                    <td class="px-6 py-4">
                                        $13
                                    </td>
                                </tr> -->
                            <tr class="">
                                <td colspan="3"></td>
                                <td class="text-sm font-bold">Sub Total</td>
                                <td class="text-sm font-bold tracking-wider"><b>$<?= $duration*$car["0"]["4"] ?></b></td>
                            </tr>
                            <!--end tr-->
                            <tr>
                                <th colspan="3"></th>
                                <td class="text-sm font-bold"><b>Tax Rate</b></td>
                                <td class="text-sm font-bold"><b>14%</b></td>
                            </tr>
                            <!--end tr-->
                            <tr class="text-white bg-gray-800">
                                <th colspan="3"></th>
                                <td class="text-sm font-bold"><b>Total</b></td>
                                <td class="text-sm font-bold"><b>$<?= $duration*$car["0"]["4"]*1.14 ?></b></td>
                            </tr>
                            <!--end tr-->

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="flex justify-between p-4">
                    <div>
                        <h3 class="text-xl">Terms And Condition :</h3>
                        <ul class="text-xs list-disc list-inside">
                            <li>All accounts are to be paid within 7 days from receipt of invoice.</li>
                            <li>To be paid by cheque or credit card or direct payment online.</li>
                            <li>If account is not paid within 7 days the credits details supplied.</li>
                        </ul>
                    </div>
                    <div class="p-4">
                        <h3>Signature</h3>
                        <div class="text-4xl italic text-indigo-500">AAA</div>
                    </div>
                </div> -->
            <div class="w-full h-0.5 bg-indigo-500"></div>

            <div class="p-4">
                <div class="flex items-center justify-evenly">
                    <div class="m-2">
                        Thank you very much for doing business with us.
                    </div>
                    <a href="./transaction.php" class=" mx-2 rounded-xl py-2 px-6 uppercase text-s cursor-pointer border-indigo-500 border-2 hover:text-white hover:bg-indigo-500 transition ease-out duration-500">
                        pay
                    </a>

                </div>
                <div>

                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
</body>

</html>