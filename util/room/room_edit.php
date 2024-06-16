<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $roomID = $_POST['roomID'] ?? '';
    $roomType = $_POST['roomType'] ?? '';
    $roomDesc = $_POST['roomDesc'] ?? '';
    $roomPax = $_POST['roomPax'] ?? '';
    $roomPrice = $_POST['roomPrice'] ?? '';

    $query = "UPDATE room SET room_type = '$roomType', room_desc = '$roomDesc', room_pax = '$roomPax', room_price = '$roomPrice' WHERE room_id = '$roomID'";
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