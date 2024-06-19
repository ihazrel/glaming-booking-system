<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM `client` WHERE `client_username` = '$username' AND `client_password` = '$password'";
    $result = mysqli_query($link, $query) or die("Query failed");
    $row = mysqli_fetch_array($result);

    if ($username == 'admin' && $password == 'admin') {
        $_SESSION['id'] = 'admin';
        header("location:./admin/admin_dashboard.php");
    }
    
    if ($row['client_username'] == $username && $row['client_password'] == $password) {
        $_SESSION['id'] = $row['client_id'];
        header("location:../index.php");
    } else {
        echo "<script>alert('Invalid username or password')</script>";
    }

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Login successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => 'error', 'message' => 'Client to update hotel.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}