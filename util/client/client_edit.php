<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $clientID = $_POST['clientID'] ?? '';
    $clientUsername = $_POST['clientUsername'] ?? 'NULL';
    $clientPassword = $_POST['clientPassword'] ?? 'NULL';
    $clientName = $_POST['clientName'] ?? 'NULL';
    $clientPhone = $_POST['clientPhone'] ?? 'NULL';


    $query = "UPDATE client 
              SET client_username = '$clientUsername',
                  client_password = '$clientPassword',
                  client_name = '$clientName',
                  client_phone = '$clientPhone'
                  WHERE client_id = '$clientID'";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Hotel updated successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => 'error', 'message' => 'Failed to update hotel.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}