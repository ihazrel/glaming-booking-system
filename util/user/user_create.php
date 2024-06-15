<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userID = $_POST['userID'] ?? '';
    $userUsername = $_POST['userUsername'] ?? '';
    $userPassword = $_POST['userPassword'] ?? '';
    $userAdmin = $_POST['userIsAdmin'] ?? '';

    $query = "INSERT INTO user (user_id, user_username, user_password, user_isAdmin) VALUES ('$userID', '$userUsername', '$userPassword', '$userAdmin')";
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