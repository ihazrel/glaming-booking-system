<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelName = $_POST['hotelName'] ??'';
    $hotelLocation = $_POST['hotelLocation'] ?? '';
    $hotelDesc = $_POST['hotelDesc'] ?? '';

    $query = "INSERT INTO hotel (hotel_name, hotel_location, hotel_desc) VALUES ('$hotelName', '$hotelLocation', '$hotelDesc')";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Hotel created successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to create hotel.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}