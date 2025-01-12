<?php
session_start();
include './db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $tier = $_POST['tier'];
    $tierPrice = $_POST['tierPrice'];
    $clientID = $_SESSION['id'];

    $query = "UPDATE client 
              SET membership_tier = '$tier'
                  WHERE client_id = '$clientID'";
    $result = mysqli_query($link, $query) or die("Query failed");

    if(!$result)
    {
        echo json_encode(['status' => false, 'message' => 'Membership registration Failed. Please try again.']);
        exit();
    } else {
        echo json_encode(['status' => true, 'message' => 'Successfully registered as ' . $tier . ' member.']); 
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}