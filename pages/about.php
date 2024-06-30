<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Hotel</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/about.css">
    <link rel="stylesheet" href="../style/ft.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
    if (isset($_SESSION["username"])) {
        if ($_SESSION["role"] == "user") {
            include('../util/nav_login_user.php');
        } else {
            include('../util/nav_login_admin.php');
        }
    } else {
        include('../util/nav.php');
    }
?>

    <div class="heading">
        <h1>About Our Hotel</h1>
        <p> This is our hotel</p>
    </div>
    <div class="container">
        <section class="about">
            <div class="about-image">
                <img src="../pic/AbouutHotel.jpg">
            </div>
            <div class="about-content">
                <h2> Our hotel was build in 2010</h2>
                <p>we have 4 type of hotel in Malaysia.</p>
            </div>
        </section>
    </div>
<?php include('../util/ft.php');?>
</body>
</html>