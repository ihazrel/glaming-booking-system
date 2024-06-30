<?php
session_start();
include '../util/db_connect.php';

$username = $_SESSION['username'];
$name = $_SESSION['name'];
$phone = $_SESSION['phone'];
$password = $_SESSION['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/profile.css">
</head>
<body>
<?php include('../util/nav_login_user.php'); ?>
    
<div class="container">
    <div id="profile">
        <h1>Your Profile Details</h1>
        <table>
            <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        </table>
        <a href="edit_profile.php">Edit Profile</a>
    </div>
</div>

</body>
</html>
