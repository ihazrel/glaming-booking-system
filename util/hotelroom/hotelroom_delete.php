<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelroomID = $_POST['hotelroomID'] ?? '';

    $query = "DELETE FROM hotel_room WHERE hotel_room.hotelroom_id = '$hotelroomID'";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Hotel room deleted successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to delete hotel room.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}