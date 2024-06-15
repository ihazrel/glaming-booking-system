<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelID = $_POST['hotelID'] ?? '';
    $hotelLocation = $_POST['hotelLocation'] ?? '';
    $hotelDesc = $_POST['hotelDesc'] ?? '';

    $query = "INSERT INTO hotel (hotel_id, hotel_location, hotel_desc) VALUES ('$hotelID', '$hotelLocation', '$hotelDesc')";
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