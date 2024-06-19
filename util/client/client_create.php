<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $clientUsername = $_POST['clientUsername'] ?? '';
    $clientPassword = $_POST['clientPassword'] ?? '';
    $clientName = $_POST['clientName'] ?? '';
    $clientPhone = $_POST['clientPhone'] ?? '';

    $clientUsername = ($clientUsername === '') ? NULL : $clientUsername;
    $clientEmail = ($clientEmail === '') ? NULL : $clientEmail;

    $query = "INSERT INTO `client` (`client_username`, `client_password`, `client_name`, `client_phone`) VALUES ('$clientUsername', '$clientPassword', '$clientName', '$clientPhone') ";
    $result = mysqli_query($link, $query) or die("Query failed");
    
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Client updated successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => 'error', 'message' => $query]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}