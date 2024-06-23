<?php
include './db_connect.php';

$n=3;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $roomID = $_POST['roomID'];
    $bookingCheckinDate = $_POST['checkinDate'];
    $bookingCheckoutDate = $_POST['checkoutDate'];
    $total = $_POST['total'];
    $clientID = $_POST['clientID'];   

    $bookingNumber = getName($n).rand(101,999);

    $query = "INSERT INTO `booking` (`booking_number`, `booking_checkin_date`, `booking_checkout_date`, `booking_amt`, `client_id`) VALUES ('$bookingNumber', '$bookingCheckinDate', '$bookingCheckoutDate', '$total', '$clientID')";
    $result = mysqli_query($link, $query) or die("Query failed");

    if(!$result)
    {
        echo json_encode(['status' => false, 'message' => 'Failed to create booking.']);
        exit();
    }

    $query = "SELECT * FROM `booking` WHERE `booking_number` = '$bookingNumber'";
    $result = mysqli_query($link, $query) or die("Query failed");


    if(!$result)
    {
        echo json_encode(['status' => false, 'message' => 'Failed to fetch booking.']);
        exit();
    } else {
        $row = mysqli_fetch_array($result);
        $bookingID = $row['booking_id'];
    }

    $query = "UPDATE hotel_room SET booking_id = ".($bookingID !== NULL ? "'$bookingID'" : "NULL")." WHERE hotelroom_id = '$roomID'";
    $result = mysqli_query($link, $query) or die("Query failed");
    
    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Room succesfully booked.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to book room.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}


function getName($n) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
