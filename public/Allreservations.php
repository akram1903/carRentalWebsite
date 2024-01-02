<?php
session_start();
require_once('adminnavbar.php');
// require_once('filterOfiice.php');
if (empty($_SESSION["admin"])) {
  header("location:forbidden.php");
}
require_once('classesOop.php');
//To get the user object from session
$admin = unserialize($_SESSION["admin"]);
$reservations = admin::getreservations();
// var_dump($reservations);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>
<body>

   
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   Reservation  Number
                </th>
                <th scope="col" class="px-6 py-3">
                 Reservation Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Return Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Car plate id
                </th>
                <th scope="col" class="px-6 py-3">
                    Customer SSN
                </th>
                <th scope="col" class="px-6 py-3">
                   Delete
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
        foreach ($reservations as $reservation) {
            ?>
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <?=$reservation["0"]?>
                </th>
                <td class="px-6 py-4">
                    <?=$reservation["1"]?>
                </td>
                <td class="px-6 py-4">
                    <?=$reservation["2"]?>
                </td>
                <td class="px-6 py-4">
                    <?=$reservation["3"]?>
                </td>
                <td class="px-6 py-4">
                    <?=$reservation["4"]?>
                </td>
                <td class="px-6 py-4">
                <form action="handleDeleteTransaction.php" method="post">
            <input type="hidden" id="reservation_no" name="reservation_no" value="<?=$reservation["0"]?>">
            <button  class="block w-full select-none rounded-lg bg-red-900 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
                     Delete
                   </button>
            </form>
                    
                </td>
            </tr>
            <?php
        }?>

        </tbody>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>