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
    <link rel="stylesheet" href="styles.css">

    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
</head>
<body>
    <div>

<form method = "post">
    
    <!-- <input type="text" placeholder="search data" name = "search">
    <button name = "submit">search</button> -->

    <label for="voice-search" class="sr-only">Search</label>
    <div class="flex items-center p-3">  
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                </svg>
            </div>
            <input name="search" type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos, Design Templates..." required>

    </div>
    <button name="submit" type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>Search
    </button> 
</div>
    <div class="container mx-auto my-8 text-center ">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">Car Data Table</h2>

        <table class="min-w-full bg-white border border-gray-300">

        <?php
        if(isset($_POST['submit']))
            {
                require_once('config.php');
                $search =$_POST['search'];
                $qry = "SELECT * FROM CAR WHERE make  = '$search' ";
                // ------------------------------------------------//
                $qry1 = "SELECT
                            c.*,
                            cp.photo,
                            cu.*,
                            r.*
                        FROM
                            CarRentalSystem.Car c
                        LEFT JOIN
                            CarRentalSystem.Car_Photos cp ON c.plate_id = cp.Car_plate_id
                        LEFT JOIN
                            CarRentalSystem.reservation r ON c.plate_id = r.Car_plate_id
                        LEFT JOIN
                            CarRentalSystem.Customer cu ON r.Customer_ssn = cu.ssn
                        WHERE
                        c.plate_id LIKE '$search'
                        OR c.model LIKE '$search' 
                        OR c.make LIKE '$search' 
                        OR c.year LIKE'$search' 
                        OR c.price LIKE '$search' 
                        OR c.registration_date LIKE '$search'
                        OR c.office_office_id LIKE '$search' 
                        OR cu.fName LIKE '$search' 
                        OR cu.lName LIKE '$search' 
                        OR cu.email LIKE '$search' 
                        OR cu.phone_no LIKE '$search' 
                        OR r.reservation_no = '$search' 
                        OR r.reserve_date = '$search'
                        OR r.pickup_date = '$search'
                        OR r.return_date = '$search'
                        OR r.pickup_location = '$search'";
                // ------------------------------------------------//
                // $qry = "SELECT * FROM posts where users_id= $user_id";
                $connection_to_db = mysqli_connect(DB_host,DB_user_name,DB_user_password,DB_name); 
                $result = mysqli_query($connection_to_db,$qry1); 
                $data = mysqli_fetch_all($result);
                $cars = $data;
                //mysqli_close($connection_to_db);
                if(mysqli_num_rows($result)>0){
// --------------------------------------------------------------------------------//
                    echo ' <thead>
                    <tr>
                        <th class="py-2 px-4 border-b ">Plate ID</th>
                        <th class="py-2 px-4 border-b">Model</th>
                        <th class="py-2 px-4 border-b">Make</th>
                        <th class="py-2 px-4 border-b">Year</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Registration Date</th>
                        <th class="py-2 px-4 border-b">Office ID</th>
                        <th class="py-2 px-4 border-b">Car Photos</th>
                        <th class="py-2 px-4 border-b">Customer SSn</th>
                        <th class="py-2 px-4 border-b">First Name</th>
                        <th class="py-2 px-4 border-b">Last Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Phone number</th>
                        <th class="py-2 px-4 border-b">reservation number</th>
                        <th class="py-2 px-4 border-b">reservation date</th>
                        <th class="py-2 px-4 border-b">pickup date</th>
                        <th class="py-2 px-4 border-b">return date</th>
                        <th class="py-2 px-4 border-b">pickup location</th>
                        <th class="py-2 px-4 border-b">payment date</th>
                        <th class="py-2 px-4 border-b">payment Method</th>

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
                        <td class="py-2 px-4 border-b"><?php
                        $image_path = "../img/" . $car["7"];
                        ?>
                        <div class="swiper-slide">
                        <img src="<?=$image_path?>" alt="Car Photo">
                         </div>
                         <?php
                          ?></td>
                        
                        <td class="py-2 px-4 border-b"><?php echo $car["8"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["9"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["10"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["11"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["12"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["15"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["16"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["17"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["18"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["20"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["23"]; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $car["24"]; ?></td>
                        <!-- 

photo7
password13
wallet14
reservation_no15
damage_compensation19
Car_plate_id21
Customer_ssn22
payment_date
payment_Method -->


                <?php endforeach; ?>
            </tbody>
            <?php
                }
            }
                    ?>
 
        </table>
    </div>

</form>

    </div>
</body>
</html>