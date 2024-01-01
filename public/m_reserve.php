<?php

include('configs/database.php');
include('./functions.php');

//Backend 

if (isset($_POST['operation'])) {

    $currentOperaion = $_POST['operation'];
    $output = array(
        'success' => false,
        'error' => false,
        'success_msg' => '',
        'error_msg' => ''
    );


    if ($currentOperaion == 'FetchSingle') {

        $brandid = $_sPOST['brandId'];

        $query = $databaseConnexion->prepare('SELECT * FROM brands Where id = ?');
        $query->execute(array($brandid));

        foreach ($query->fetchAll() as $result) {
            $output = array(
                'id' => $result['id'],
                'name' => $result['name'],
            );
        }
    }

    if ($currentOperaion == 'Edit') {

        $query = $databaseConnexion->prepare('UPDATE brands SET name = ? WHERE id = ?');
        $query->execute(array($_POST['brandName'], $_POST['brand_id']));

        if ($query) {
            $output = array(
                'success' => true,
                'error' => false,
                'success_msg' => 'Brand Updated',
                'error_msg' => ''
            );
        }
    }

    if ($currentOperaion == 'DeleteSingle') {
        $query = $databaseConnexion->prepare('DELETE  FROM reservation WHERE reservation_no = ?');
        $query->execute(array($_POST['reservation_no']));

        $output = array(
            'success' => true
        );
    }

    echo json_encode($output);
}
