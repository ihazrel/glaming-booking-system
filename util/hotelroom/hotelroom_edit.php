<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelroomID = $_POST['hotelroomID'] ?? '';
    $bookingNumber = $_POST['bookingNumber'] ?? '';

    if ($bookingNumber !== NULL && $bookingNumber !== '') {
        $searchQuery = "SELECT * FROM booking WHERE booking_number LIKE '$bookingNumber'";
        $searchResult = mysqli_query($link, $searchQuery) or die("Query failed");
        $row = mysqli_fetch_array($searchResult);

        // Check if bookingNumber exists
        if ($row) {
            $bookingID = $row['booking_id'];
        } else {
            // Handle case where bookingNumber is provided but not found
            echo json_encode(['status' => 'error', 'message' => 'Booking number not found.']);
            exit;
        }
    } else {
        // If bookingNumber is NULL or empty, prepare to set booking_id to NULL
        $bookingID = NULL;
    }

    // Update query adjusted to conditionally set booking_id
    $query = "UPDATE hotel_room SET booking_id = ".($bookingID !== NULL ? "'$bookingID'" : "NULL")." WHERE hotelroom_id = '$hotelroomID'";
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