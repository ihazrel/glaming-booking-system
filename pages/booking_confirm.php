<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="../style/booking_confirm.css">
</head>
<body>
<?php include('nav.php');?>
    
    <div class="background">
        <div class="booking-form">
            <h2>Booking Form</h2>
            <form action="">
                <label for="name">Name: </label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required>

                <label for="destination">Destination: </label>
                <input type="text" name="destination" id="destination" required>

                <label for="departure-date">Departure Date: </label>
                <input type="date" name="departure-date" id="departure-date" required>

                <label for="return-date">Departure Date: </label>
                <input type="date" name="return-date" id="return-date" required>

                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>
    
</body>
</html>