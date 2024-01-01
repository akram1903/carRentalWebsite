<?php
require_once 'configs/database.php';
$query = $databaseConnexion->prepare("SELECT * FROM reservation");
$query->execute();
$result = $query->fetchAll();
$totalrecords = $query->rowCount();

?>

<?php
// Assume you have a database connection
$databaseConnexion = new mysqli("localhost", "root", "123456", "carrentalsystem");

// Check connection
if ($databaseConnexion->connect_error) {
  die("Connection failed: " . $databaseConnexion->connect_error);
}

// Assume you have a specific customer SSN
$customerEmail = "ali@gmail.com"; // Change this to the email of the customer you want to retrieve

// Query to retrieve data from a specific customer using email
$query = $databaseConnexion->prepare("SELECT ssn, fName, lName, email, phone_no, password, wallet FROM customer WHERE email = ?");
$query->bind_param("s", $customerEmail);
$query->execute();

// Bind the result variables
$query->bind_result($ssn, $fName, $lName, $email, $phone_no, $password, $wallet, $Customercol);
// Fetch the result
$query->fetch();

// Close the query
$query->close();

// Display the retrieved data
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
  <link href="styles.css" rel="stylesheet" />

  <!--Regular Datatables CSS-->
  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  <!--Responsive Extension Datatables CSS-->
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

  <style>
    /*Overrides for Tailwind CSS */

    /*Form fields*/
    .dataTables_wrapper select,
    .dataTables_wrapper .dataTables_filter input {
      color: #4a5568;
      /*text-gray-700*/
      padding-left: 1rem;
      /*pl-4*/
      padding-right: 1rem;
      /*pl-4*/
      padding-top: .5rem;
      /*pl-2*/
      padding-bottom: .5rem;
      /*pl-2*/
      line-height: 1.25;
      /*leading-tight*/
      border-width: 2px;
      /*border-2*/
      border-radius: .25rem;
      border-color: #edf2f7;
      /*border-gray-200*/
      background-color: #edf2f7;
      /*bg-gray-200*/
    }

    /*Row Hover*/
    table.dataTable.hover tbody tr:hover,
    table.dataTable.display tbody tr:hover {
      background-color: #ebf4ff;
      /*bg-indigo-100*/
    }

    /*Pagination Buttons*/
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      font-weight: 700;
      /*font-bold*/
      border-radius: .25rem;
      /*rounded*/
      border: 1px solid transparent;
      /*border border-transparent*/
    }

    /*Pagination Buttons - Current selected */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      color: #fff !important;
      /*text-white*/
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
      /*shadow*/
      font-weight: 700;
      /*font-bold*/
      border-radius: .25rem;
      /*rounded*/
      background: #667eea !important;
      /*bg-indigo-500*/
      border: 1px solid transparent;
      /*border border-transparent*/
    }

    /*Pagination Buttons - Hover */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      color: #fff !important;
      /*text-white*/
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
      /*shadow*/
      font-weight: 700;
      /*font-bold*/
      border-radius: .25rem;
      /*rounded*/
      background: #667eea !important;
      /*bg-indigo-500*/
      border: 1px solid transparent;
      /*border border-transparent*/
    }

    /*Add padding to bottom border */
    table.dataTable.no-footer {
      border-bottom: 1px solid #e2e8f0;
      /*border-b-1 border-gray-300*/
      margin-top: 0.75em;
      margin-bottom: 0.75em;
    }

    /*Change colour of responsive icon*/
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
    table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
      background-color: #667eea !important;
      /*bg-indigo-500*/
    }

    .table-container {
      overflow: auto;
      max-height: 300px;
      /* Set a maximum height for the scrollable area */
    }
  </style>
</head>

<body>
  <style>
    :root {
      --main-color: #4a76a8;
    }

    .bg-main-color {
      background-color: var(--main-color);
    }

    .text-main-color {
      color: var(--main-color);
    }

    .border-main-color {
      border-color: var(--main-color);
    }
  </style>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



  <div class="container mx-auto my-5 p-5">
    <div class="md:flex no-wrap md:-mx-2">
      <!-- Left Side -->
      <div class="w-full md:w-3/12 md:mx-2">
        <!-- Friends card -->
        <div class="bg-white p-3 hover:shadow">
          <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
            <span class="text-blue-500">
              <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </span>
            <span>My Profile</span>
          </div>
          <div class="grid grid-cols-3">
            <div class="text-center my-2">

            </div>
            <div class="text-center my-2">
              <img class="h-16 w-16 rounded-full mx-auto" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Yy4D1cbGiTYvulB3hmRX9X1OVxecvyqbFw&usqp=CAU" alt="" />
              <a href="#" class="text-main-color"><?php echo $fName; ?></a>
            </div>


          </div>
        </div>
        <!-- End of friends card -->
        <div class="my-4"></div>

        <!-- Profile Card -->
        <div class="bg-white p-3 border-t-4 border-blue-400">
          <div class="image overflow-hidden">
            <img class="h-auto w-full mx-auto" src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg" alt="" />
          </div>
          <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
            <?php echo $fName; ?> <?php echo $lName; ?>
          </h1>
          <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
            <li class="flex items-center py-3">
              <span>Status</span>

            </li>
            <li class="flex items-center py-3">
              <span>Status</span>
              <span class="ml-auto">
                <?php
                if ($totalrecords > 0) {
                  echo '<span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span>';
                } else {
                  echo '<span class="bg-red-500 py-1 px-2 rounded text-white text-sm">Not Active</span>';
                }
                ?>
              </span>
            </li>
            <li class="flex items-center py-3">
              <span>No of reservations</span>
              <span class="ml-auto"><?php echo $totalrecords; ?></span>

            </li>
          </ul>
        </div>
        <!-- End of profile card -->

      </div>
      <!-- Right Side -->
      <div class="w-full md:w-9/12 mx-2 h-64">
        <!-- Profile tab -->
        <!-- About Section -->
        <div class="bg-white p-3 shadow-sm rounded-sm">
          <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
              <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </span>
            <span class="tracking-wide">About</span>
          </div>
          <div class="text-gray-700">
            <div class="grid md:grid-cols-2 text-sm">
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">First Name</div>
                <div class="px-4 py-2"><?php echo $fName; ?></div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Last Name</div>
                <div class="px-4 py-2"><?php echo $lName; ?></div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Password</div>
                <div class="px-4 py-2">
                  <div class="relative">
                    <input type="password" value="<?php echo $password; ?>" id="passwordField" readonly>
                    <input type="checkbox" id="toggleCheckbox" onclick="togglePasswordVisibility()">
                    <label for="toggleCheckbox"></label>
                  </div>
                </div>
              </div>

              <script>
                function togglePasswordVisibility() {
                  var passwordField = document.getElementById('passwordField');
                  var toggleCheckbox = document.getElementById('toggleCheckbox');

                  passwordField.type = toggleCheckbox.checked ? 'text' : 'password';
                }
              </script>

              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Contact No.</div>
                <div class="px-4 py-2"><?php echo $phone_no; ?></div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Customercol</div>
                <div class="px-4 py-2"><?php echo $Customercol; ?></div>
              </div>
              <!-- <div class="grid grid-cols-2">
                  <div class="px-4 py-2 font-semibold">Permanant Address</div>
                  <div class="px-4 py-2">Arlington Heights, IL, Illinois</div>
                </div> -->
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Email.</div>
                <div class="px-4 py-2">
                  <a class="text-blue-800" href="mailto:jane@example.com"><?php echo $email; ?></a>
                </div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Wallet</div>
                <div class="px-4 py-2"><?php echo $wallet; ?></div>
              </div>
            </div>
          </div>
          <button class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">
            Edit Information
          </button>
        </div>
        <!-- End of about section -->
        <div class="my-4"></div>
        <!-- Experience and education -->
        <div class="bg-white p-3 shadow-sm rounded-sm" style=" overflow-x: auto; overflow-y: auto;">
          <div>
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
              <span clas="text-green-500">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </span>
              <span class="tracking-wide">Reservations</span>
            </div>
            <!--Container-->
            <div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2" style=" width:100%; overflow-x: auto; overflow-y: auto; ">
              <!--Card-->
              <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white" style=" overflow-x: auto; overflow-y: auto; width:100%;">
                <table id="example" class="stripe hover" style="width:100%; overflow-x: auto; overflow-y: auto;padding-top: 1em;  padding-bottom: 1em;">
                  <thead>
                    <tr>
                      <th data-priority="1">reservation_no</th>
                      <th data-priority="2">reserve_date</th>
                      <th data-priority="3">pickup_date</th>
                      <th data-priority="4">return_date</th>
                      <th data-priority="5">damage_compensation</th>
                      <th data-priority="6">pickup_location</th>
                      <th data-priority="7">Car_plate_id</th>
                      <th data-priority="8">Customer_ssn</th>
                      <th data-priority="9">payment_date</th>
                      <th data-priority="10">payment_Method</th>
                      <th data-priority="11">Delete</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!--/Card-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
      footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;

        padding: 1rem;
        text-align: center;
      }
    </style>


    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</body>

</html>
<script>
  //initialize jquery
  $(document).ready(function() {

    //Get All datas in dataTables
    var brandDataTable = $('#example').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        url: "fetch_reserve.php",
        type: "POST",
      },
      "columnDefs": [{
        "targets": []
      }]

    })


    $(document).on('click', '.delete', function() {

      var button = $(this)[0];
      var reservation_no = $(button).attr('id')
      $.ajax({
        url: 'm_reserve.php',
        method: 'POST',
        data: {
          operation: 'DeleteSingle',
          reservation_no: reservation_no
        },
        dataType: 'json',
        success: (data) => {
          // showAlert('Card Deleted', 'Card deleted successfully', 'success', 'Close')
          brandDataTable.ajax.reload()
        }
      })

    })


  });
</script>