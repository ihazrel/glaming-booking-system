<?php
session_start();
include '../util/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $client_id = $_GET['id'];
    $password = $_SESSION['password'];

    // Query for user details
    $sql = "SELECT * FROM client WHERE client_id = '$client_id'";
    $result = $link->query($sql);

    if ($result === false) {
        die("Query failed: " . $link->error);
    }

    $row = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $username = $_POST['client_username'];
    $password = $_POST['client_password']; // Getting the updated password
    $name = $_POST['client_name'];
    $phone = $_POST['client_phone'];

    $stmt = $link->prepare("UPDATE client SET client_username=?, client_password=?, client_name=?, client_phone=? WHERE client_id=?");
    $stmt->bind_param("ssssi", $username, $password, $name, $phone, $client_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully');</script>";
        echo "<script>window.location.assign('cust_profile.php');</script>";
    } else {
        $message = "ERROR: " . $stmt->error;
        echo "<script>alert('$message');</script>";
    }
    $stmt->close();
    $link->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Customer</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="../style/cust_booking.css" />
</head>
<body>
        <div class="rightbox">
            <div class="profile">
                <?php if (isset($message)): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <input type="hidden" name="client_id" value="<?php echo htmlspecialchars($row['client_id']); ?>" readonly />
                    <h1>Personal Info</h1>
                    <div class="mb-3">
                        <label for="client_username" class="form-label">Username:</label>
                        <input type="text" id="client_username" name="client_username" class="form-control" value="<?php echo htmlspecialchars($row['client_username']); ?>" style="width: 300px;" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_password" class="form-label">Password:</label>
                        <input type="text" id="client_password" name="client_password" class="form-control" value="<?php echo htmlspecialchars($row['client_password']); ?>" style="width: 300px;" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Name:</label>
                        <input type="text" id="client_name" name="client_name" class="form-control" value="<?php echo htmlspecialchars($row['client_name']); ?>" style="width: 300px;" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_phone" class="form-label">Phone Number:</label>
                        <input type="text" id="client_phone" name="client_phone" class="form-control" value="<?php echo htmlspecialchars($row['client_phone']); ?>" style="width: 300px;" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>