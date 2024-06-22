<?php
session_start();
include './db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $searchQuery = "SELECT * FROM client WHERE client_username = '$username'";
    $searchResult = mysqli_query($link, $searchQuery);

    if($searchResult->num_rows > 0) {
        header('Location: ../pages/signup.php?error=Username already exists.');
    }

    $query = "INSERT INTO client (client_username, client_name, client_phone, client_password) VALUES ('$username', '$name', '$phone', '$password')";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Client successfully registered.']);
        header('Location: ../pages/login.php?success=Client successfully registered. Please login.');
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Client registration failed.']);
        header('Location: ../pages/signup.php?error=Client registration failed.');
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}