<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $clientID = $_POST['clientID'] ?? '';
    $clientUsername = $_POST['clientUsername'] ?? '';
    $clientEmail = $_POST['clientEmail'] ?? '';
    $clientPassword = $_POST['clientPassword'] ?? '';
    $clientName = $_POST['clientName'] ?? '';
    $clientPhone = $_POST['clientPhone'] ?? '';

    $query = "INSERT INTO client (client_username,client_email, client_password, client_name, client_phone) VALUES ('$clientUsername', '$clientEmail', '$clientPassword', '$clientName', '$clientPhone')";
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