<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelID = $_POST['hotelID'] ?? '';
    $roomNumber = $_POST['roomNumber'] ?? '';
    $roomType = $_POST['roomType'] ?? '';
    $hotelLocation = $_POST['hotelLocation'] ?? '';
    $bookingNumber = $_POST['bookingNumber'] ?? '';

    $searchQuery = "SELECT r.room_id AS room_id, h.hotel_id AS hotel_id, b.booking_id AS booking_id FROM hotel h, room r, booking b WHERE h.hotel_id = '$hotelID' AND r.room_id = '$roomType' AND b.booking_id = '$bookingNumber'";
    $searchResult = mysqli_query($link, $searchQuery) or die("Query failed");
    $row = mysqli_fetch_array($searchResult);

    $query = "INSERT INTO hotel_room (hotelroom_number, hotel_id, room_id, booking_id) VALUES ('$roomNumber', '$row[hotel_id]', '$row[room_id]', '$row[booking_id])";
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