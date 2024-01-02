<!DOCTYPE html>
<html lang="en">
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
$duration=3;
$Tax_Rate=0.14;


  ?>
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
                <!-- <div class="flex justify-between p-4">
                    <div>
                        <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">Larainfo</h1>
                        <p class="text-base">If account is not paid within 7 days the credits details supplied as
                            confirmation.</p>
                    </div>
                    <div class="p-2">
                        <ul class="flex">
                            <li class="flex flex-col items-center p-2 border-l-2 border-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <span class="text-sm">
                                    www.larainfo.com
                                </span>
                                <span class="text-sm">
                                    www.lorememhh.com
                                </span>
                            </li>
                            <li class="flex flex-col p-2 border-l-2 border-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">
                                    2821 Kensington Road,Avondale Estates, GA 30002 USA
                                </span>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <!-- <div class="w-full h-0.5 bg-indigo-500 my-5"></div> -->
                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">Order Date : <span class="text-sm font-medium"> 12/12/2022</span></h6>
                        <h6 class="font-bold">rent Date: <span class="text-sm font-medium"> 12/12/2022</span></h6>
                        <h6 class="font-bold">return date: <span class="text-sm font-medium"> 12/12/2022</span></h6>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold"> Billed To : </span>
                            Ahmed Zaher

                            
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
                                        Brand Name
                                    </th>
                                    <th class="px-4 py-2 text-xs ">
                                        model
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
                                    <?=$car["0"]?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?=$car["2"]?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"> <?=$car["1"]?></div>
                                    </td>
                                   
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <?=$duration?>
                                    </td>
                                    <td class="px-6 py-4">
                                    <?=$car["4"]?>
                                    </td>
                                    <td class="px-6 py-4">
                                    <?=$duration * $car["4"]?>
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
                                    <td class="text-sm font-bold tracking-wider"><b><?=$duration * $car["4"]?></b></td>
                                </tr>
                                <!--end tr-->
                                <tr>
                                    <th colspan="3"></th>
                                    <td class="text-sm font-bold"><b>Tax Rate</b></td>
                                    <td class="text-sm font-bold"><b>$<?=$Tax_Rate*100?>%</b></td>
                                </tr>
                                <!--end tr-->
                                <tr class="text-white bg-gray-800">
                                    <th colspan="3"></th>
                                    <td class="text-sm font-bold"><b>Total</b></td>
                                    <td class="text-sm font-bold"><b><?=($Tax_Rate*$duration * $car["4"])+$duration * $car["4"]?></b></td>
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
        
    </body>

</html>