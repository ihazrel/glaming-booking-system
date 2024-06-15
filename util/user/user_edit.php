<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userID = $_POST['userID'] ?? '';
    $userUsername = $_POST['userUsername'] ?? '';
    $userPassword = $_POST['userPassword'] ?? '';
    $userAdmin = $_POST['userIsAdmin'] ?? '';

    $query = "UPDATE user SET user_username = '$userUsername', user_password = '$userPassword', user_isAdmin = '$userAdmin' WHERE user_id = '$userID'";
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