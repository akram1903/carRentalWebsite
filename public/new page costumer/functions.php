<?php

function checkExist($databaseConnexion, $table, $key, $field)
{

    $query = $databaseConnexion->prepare('SELECT * from ' . $table . ' where ' . $field . ' = ?');

    $query->execute(array($key));


    return $query->rowCount();
}
function checkExistCard($databaseConnexion, $table, $key, $field, $customer)
{

    $query = $databaseConnexion->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = ? AND customer_id = ?');

    // Bind the parameters
    $query->execute(array($key, $customer));


    return $query->rowCount();
}


function get_total_all_records($databaseConnexion, $table)
{

    $query = $databaseConnexion->prepare('SELECT * FROM ' . $table);
    $query->execute();
    $result = $query->fetchAll();
    return $query->rowCount();
}

function get_total_all_cards($databaseConnexion, $table, $id)
{

    $query = $databaseConnexion->prepare("SELECT * FROM reservation WHERE reservation_no = '$id' ");
    $query->execute();
    $result = $query->fetchAll();
    return $query->rowCount();
}
