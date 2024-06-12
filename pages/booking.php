<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking form</title>
    <link rel="stylesheet" href="../style/booking.css">
</head>
<body>
<?php include('nav.php');?>

    <div class="info-container">
        <form action="" method="post">
            <div class="info-bar">
                <div class="info-field" id="date">
                    <fieldset id="date">
                        <legend>Select dates</legend>
                        <input type="date" class="date">
                        <input type="date" class="date">
                    </fieldset>
                </div>

                <div class="info-field">
                    <fieldset>
                        <legend>Number of people</legend>
                        <input type="number" class="people" min="1" max="10">
                    </fieldset>
                </div>

                <div class="info-field">
                    <fieldset>
                        <legend>Have a promocode?</legend>
                        <input type="text">
                    </fieldset>
                </div>

                <input type="submit">
            </div>
        </form>
    </div>

    <div class="book-container">
        <div class="book-room"></div>
        <div class="book-summary">
            <div class="summary-info">
                <div class="si-price">MYR 91.44 total</div>
                <div class="si-date">Tue, 11 June 24 – Wed, 12 June 24 </div>
                <div class="si-pax">1 room, 2 guests </div>
            </div>
            <hr>

            <div class="summary-room">
                <div class="room-title">Double Room School Holiday Flash Sale</div>
                <div class="room-details">
                    <div class="rd-desc">2 guests 1 night </div>
                    <div class="rd-price">MYR 91.44</div>
                </div>
            </div>
            <hr>
            
            <div class="summary-confirm">
                <div class="confirm-price">
                    <div class="cp-title">Total price</div>
                    <div class="cp-price">MYR 91.44</div>
                </div>
                <button class="">Book Now</button>
            </div>
        </div>
    </div>
	

    <script src="../script/booking.js"></script>
</body>
</html>