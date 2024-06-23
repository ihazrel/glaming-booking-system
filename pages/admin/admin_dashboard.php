<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../style/nav.css">
    <link rel="stylesheet" href="../../style/sidebar.css">
    <link rel="stylesheet" href="../../style/admin_dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
	include '../../util/db_connect.php';
	$query="Select * from room";
	$result = mysqli_query( $link,$query) or die("Query failed");	// SQL statement for checking
	?>
<?php include('../../util/nav_admin.php');?>
<?php include('../../util/sidebar.php')?>
<div class="main">
    <div class="content">
        <div class="summary-header">

            <div class="card">
                <div class="card-header"><i class="ri-calendar-fill ri-3x"></i></div>
                <div class="card-content">
                    <h1><?php 
                            $query="Select * from booking";
                            $result = mysqli_query( $link,$query) or die("Query failed");
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Booking</h3>
                </div>
            </div>

            <!-- <div class="card">
                <div class="card-header"><i class="ri-wallet-fill ri-3x"></i></div>
                <div class="card-content">
                    <h1><?php
                            $query="Select * from booking";
                            $result = mysqli_query( $link,$query) or die("Query failed"); 
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Revenue</h3>
                </div>
            </div> -->

            <div class="card">
                <div class="card-header"><i class="ri-user-fill ri-3x"></i></i></div>
                <div class="card-content">
                    <h1><?php
                            $query="Select * from client";
                            $result = mysqli_query( $link,$query) or die("Query failed"); 
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Clients</h3>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><i class="ri-hotel-bed-fill ri-3x"></i></i></div>
                <div class="card-content">
                    <h1><?php 
                            $query="SELECT hr.hotelroom_number, h.hotel_id, h.hotel_name, r.room_id, r.room_type, COALESCE(b.booking_id, '') AS booking_id
                            FROM hotel_room hr JOIN hotel h ON hr.hotel_id = h.hotel_id JOIN room r ON hr.room_id = r.room_id LEFT JOIN booking b ON hr.booking_id = b.booking_id WHERE hr.booking_id IS NULL; ";
                            $result = mysqli_query( $link,$query) or die("Query failed");
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Rooms available</h3>
                </div>
            </div>
            
        </div>
        <div class="summary-body">
            <div class="card">
                <div class="card-header"><h2 style="font-weight: bold;">Total Revenue</h2></div>
                <div class="card-content">
                    <?php 
                        $query="SELECT SUM(booking_amt) AS total_revenue FROM booking";
                        $result = mysqli_query( $link,$query) or die("Query failed");
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <h1 style="font-size: 3rem;">RM<?php echo $row['total_revenue'];?></h1>
                    <!-- <h3>Booking ID</h3> -->
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h2 style="font-weight: bold;">Popular Room</h2></div>
                <div class="card-content">
                    <h1 style="font-size: 3rem;">Seaview Deluxe</h1>
                    <h3>20 rooms</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
</div>
</body>
</html>