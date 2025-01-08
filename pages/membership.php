<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glaming</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/membership.css">
    <link rel="stylesheet" href="../style/ft.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
    $navFile = '../util/nav.php';

    if (isset($_SESSION["username"])) {
        $navFile = ($_SESSION["role"] == "user") 
        ? '../util/nav_login_user.php' 
        : '../util/nav_login_admin.php';
    }

    include($navFile);
?>

<div class="tier-card-container" id="silver">
    <div class="tier-card">
        <h1>Silver</h1>

        <div class="features">
            <ul>
                <li>Access to all articles</li>
                <li>Access to all videos</li>
                <li>Access to all photos</li>
            </ul>
            <ul>
                <li>Access to all articles</li>
                <li>Access to all videos</li>
                <li>Access to all photos</li>
            </ul>
        </div>
    </div>

    <div class="tier-card" id="gold">
        <h1>Gold</h1>

        <div class="features">
            <ul>
                <li>Access to all articles</li>
                <li>Access to all videos</li>
                <li>Access to all photos</li>
            </ul>
            <ul>
                <li>Access to all articles</li>
                <li>Access to all videos</li>
                <li>Access to all photos</li>
            </ul>
        </div>
    </div>

    <div class="tier-card" id="platinum">
        <h1>Platinum</h1>

        <div class="features">
            <ul>
                <li>Access to all articles</li>
                <li>Access to all videos</li>
                <li>Access to all photos</li>
            </ul>
            <ul>
                <li>Access to all articles</li>
                <li>Access to all videos</li>
                <li>Access to all photos</li>
            </ul>
        </div>
    </div>
</div>
    
<?php include('../util/ft.php');?>
</body>
</html>