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

    <section class="body">
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
                    <h2> Our Mission </h2>
                    <p>To provide exceptional hospitality and unforgettable experiences for our guests by offering superior service, 
                        luxurious accommodations, and a welcoming atmosphere that ensures comfort, satisfaction, and lasting memories..</p>
                </div>
            </section>
        </div>
        
        <div class="timeline-image">
            <img src="../pic/about.jpg">
        </div>
    </section>
<?php include('../util/ft.php');?>
</body>
</html>