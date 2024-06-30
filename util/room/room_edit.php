<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $roomID = isset($_POST['roomID']) ? $_POST['roomID'] : '';
    $roomType = isset($_POST['roomType']) ? $_POST['roomType'] : '';
    $roomDesc = isset($_POST['roomDesc']) ? $_POST['roomDesc'] : '';
    $roomPax = isset($_POST['roomPax']) ? $_POST['roomPax'] : '';
    $roomPrice = isset($_POST['roomPrice']) ? $_POST['roomPrice'] : '';

    $query = "UPDATE room SET room_type = '$roomType', room_desc = '$roomDesc', room_pax = '$roomPax', room_price = '$roomPrice' WHERE room_id = '$roomID'";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Room updated successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to update room.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}