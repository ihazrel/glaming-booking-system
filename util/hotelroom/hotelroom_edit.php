<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelroomID = $_POST['hotelroomID'] ?? '';
    $bookingNumber = $_POST['bookingNumber'] ?? '';

    $searchQuery = "SELECT * FROM booking WHERE booking_number LIKE '$bookingNumber'";
    $searchResult = mysqli_query($link, $searchQuery) or die("Query failed");
    $row = mysqli_fetch_array($searchResult);

    $query = "UPDATE hotel_room SET booking_id = '$row[booking_id]' WHERE hotelroom_id = '$hotelroomID'";
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