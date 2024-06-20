<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $clientUsername = $_POST['clientUsername'] ?? '';
    $clientPassword = $_POST['clientPassword'] ?? '';
    $clientName = $_POST['clientName'] ?? '';
    $clientPhone = $_POST['clientPhone'] ?? '';

    $search = "SELECT client_username FROM client";
    $result = mysqli_query($link, $search) or die("Query failed");
    while($row = mysqli_fetch_array($result)) {
        if ($clientUsername == $row['client_username']) {
            echo json_encode(['status' => false, 'message' => 'Failed to create client! Username already exists.']);
            exit;
        }
    }

    $query = "INSERT INTO `client` (`client_username`, `client_password`, `client_name`, `client_phone`) VALUES ('$clientUsername', '$clientPassword', '$clientName', '$clientPhone') ";
    $result = mysqli_query($link, $query) or die("Query failed");
    
    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Client created successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to create client.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}