<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $bookingID = $_POST['bookingID'];
    $bookingNumber = $_POST['bookingNumber'];
    $bookingCheckinDate = $_POST['bookingCheckinDate'];
    $bookingCheckoutDate = $_POST['bookingCheckoutDate']; 
    $bookingAmount = $_POST['bookingAmount']; 

    $query = "UPDATE booking 
                    SET booking_number = '$bookingNumber',
                    booking_checkin_date = '$bookingCheckinDate', 
                    booking_checkout_date = '$bookingCheckoutDate',
                    booking_amt = '$bookingAmount'
                    WHERE booking_id = '$bookingID'";
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