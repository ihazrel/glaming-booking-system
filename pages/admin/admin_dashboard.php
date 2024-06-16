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

            <div class="card">
                <div class="card-header"><i class="ri-wallet-fill ri-3x"></i></div>
                <div class="card-content">
                    <h1><?php
                            $query="Select * from booking";
                            $result = mysqli_query( $link,$query) or die("Query failed"); 
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Revenue</h3>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><i class="ri-user-fill ri-3x"></i></i></div>
                <div class="card-content">
                    <h1><?php
                            $query="Select * from client";
                            $result = mysqli_query( $link,$query) or die("Query failed"); 
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Users</h3>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><i class="ri-hotel-bed-fill ri-3x"></i></i></div>
                <div class="card-content">
                    <h1><?php 
                            $query="Select * from room";
                            $result = mysqli_query( $link,$query) or die("Query failed");
                            echo mysqli_num_rows($result)?></h1>
                    <h3>Rooms available</h3>
                </div>
            </div>
            
        </div>
        <div class="summary-body">
            <div class="card">
                <div class="card-header"><h2 style="font-weight: bold;">Highest Revenue</h2></div>
                <div class="card-content">
                    <h1 style="font-size: 3rem;">RM 1420</h1>
                    <h3>Booking ID</h3>
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