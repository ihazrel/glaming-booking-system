<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $roomNumber = $_POST['roomNumber'] ?? '';
    $roomType = $_POST['roomType'] ?? '';
    $hotelLocation = $_POST['hotelLocation'] ?? '';
    $bookingNumber = $_POST['bookingNumber'] ?? NULL;

    
    $searchQuery = "SELECT * FROM room WHERE room_type LIKE '$roomType'";
    $searchResult = mysqli_query($link, $searchQuery) or die("Query failed");
    $room = mysqli_fetch_array($searchResult);

    if(!$room) {
        echo json_encode(['status' => false, 'message' => 'Room type not found.']);
        exit;
    }

    $searchQuery = "SELECT * FROM hotel WHERE hotel_location LIKE '$hotelLocation'";
    $searchResult = mysqli_query($link, $searchQuery) or die("Query failed");
    $hotel = mysqli_fetch_array($searchResult);

    if(!$hotel) {
        echo json_encode(['status' => false, 'message' => 'Hotel location not found.']);
        exit;
    }

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

    // Adjust the insert query to handle NULL bookingNumber
    $query = "INSERT INTO hotel_room (hotelroom_number, hotel_id, room_id, booking_id) VALUES ('$roomNumber', '$hotel[hotel_id]', '$room[room_id]', ".($bookingID !== NULL ? "'$bookingID'" : "NULL").")";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Hotel room created successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to create hotel room.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}