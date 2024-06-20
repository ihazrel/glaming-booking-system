<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $bookingNumber = $_POST['bookingNumber'];
    $bookingCheckinDate = $_POST['bookingCheckinDate'];
    $bookingCheckoutDate = $_POST['bookingCheckoutDate'];
    $bookingAmount = $_POST['bookingAmount'];
    $clientUsername = $_POST['clientUsername'];   

    $searchQuery = "SELECT * FROM client WHERE client_username LIKE '$clientUsername'";
    $searchResult = mysqli_query($link, $searchQuery) or die("Query failed");
    $row = mysqli_fetch_array($searchResult);

    $query = "INSERT INTO booking (booking_number, booking_checkin_date, booking_checkout_date, booking_amt, client_id) VALUES ('$bookingNumber', '$bookingCheckinDate', '$bookingCheckoutDate', '$bookingAmount', '$row[client_id]')";
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