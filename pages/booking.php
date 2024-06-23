<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking form</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/booking.css">
    <link rel="stylesheet" href="../style/footer.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
include '../util/db_connect.php';
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
<section>
    <div class="info-container">
        <form id="infoForm" action="" method="post">
            <div class="info-bar" data-discount="">
                <div class="info-field" id="date">
                    <fieldset id="date">
                        <label>Select dates</label>
                        <div class="if-date">
                            <input type="date" class="date" name="checkinDate" value="2024-06-14">
                            <input type="date" class="date" name="checkoutDate" value="2024-06-15">
                        </div>
                        </fieldset>
                </div>

                <div class="info-field">
                    <fieldset>
                        <label>Have a promocode?</label>
                        <input type="text" name="promocode" class="promocode">
                    </fieldset>
                </div>

                <button id="submit-button" type="submit">Apply</button>
            </div>
        </form>
    </div>

    <?php
    $query = "SELECT hr.hotelroom_id AS hotelroom_id, 
                     hr.hotelroom_number AS room_number, 
                     h.hotel_name as hotel_name,
                     h.hotel_location as hotel_location, 
                     r.room_type as room_type, 
                     r.room_price as room_price, 
                     r.room_pax as room_pax, 
                     COALESCE(b.booking_number, '') AS booking_number 
              FROM hotel_room hr 
              JOIN hotel h ON hr.hotel_id = h.hotel_id 
              JOIN room r ON hr.room_id = r.room_id 
              LEFT JOIN booking b ON hr.booking_id = b.booking_id
              WHERE hr.booking_id IS NULL
              ORDER BY r.room_id";
    $result = mysqli_query($link, $query);
    ?>

    <div class="book-container">
        <div class="book-room">

            <?php while($row = mysqli_fetch_array($result)){?>
            <div class="room-container">
                <div class="rc-head">
                    <div class="rc-h-image"><img src="../pic/suite.png" alt="Lorem Ipsum"></div>
                    <div class="rc-h-desc">
                        <h2><?php echo $row['room_type']?></h2>
                        <p><?php echo $row['room_pax']?> people | Lorem ipsum </p>
                    </div>
                </div>
                <div class="rc-body">
                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2><?php echo $row['room_number']?></h2>
                            <h4><?php echo $row['hotel_name']?> | <?php echo $row['hotel_location']?> Branch</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR<?php echo $row['room_price']?> night</p>
                            </div>
                            <button id="select-button" data-id="<?php echo $row['hotelroom_id']?>" data-number="<?php echo $row['room_number']?>" data-type="<?php echo $row['room_type']?>" 
                                    data-price="<?php echo $row['room_price']?>" data-size="<?php echo $row['room_pax']?>" data-total="">
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

        <div class="book-summary">
            <div class="bs-info" id="info">
                <h2></h2>
                <p id="date"></p>
                <p></p>
            </div>
            <hr>

            <div class="bs-info" id="price">
                <h3></h3>
                <div class="room-details" data-price="">
                    <p></p>
                </div>
            </div>
            <hr>
            
            <div class="bs-info" id="confirm">
                <div class="confirm-discount">
                    <h4>Discount</h4>
                    <p>MYR 0.00</p>
                </div>
                <div class="confirm-price">
                    <h3>Total price</h3>
                    <h3>MYR 00.00</h3>
                </div>
            </div>
            <form id="bookForm" method="POST">
                <input type="number" name="roomID" id="roomID" hidden>
                <input type="text" name="checkinDate" id="checkinDate" hidden>
                <input type="text" name="checkoutDate" id="checkoutDate" hidden>
                <input type="number" name="total" id="total" hidden>
                <input type="number" name="clientID" id="clientID" value="<?php echo !empty($_SESSION['id']) ? $_SESSION['id'] : '';?>" hidden>
                <button class="book">Book Now</button>
            </form>
        </div>
    </div>
	
</section>
<script>
var dateRangeInDays = 1;

function updateTotalRoomPrice(roomPrice, discount) {
    var price = (roomPrice !== 0) ? roomPrice : 0;
    var totalRoomPrice = price * dateRangeInDays ;
    var discountAmount = totalRoomPrice * (discount / 100);
    var totalPriceDiscount = totalRoomPrice - discountAmount;

    console.log(roomPrice, dateRangeInDays, discount, discountAmount, totalRoomPrice, totalPriceDiscount);

    document.querySelector(".bs-info#confirm .confirm-discount p").textContent = '- MYR ' + discountAmount.toFixed(2);
    document.querySelector(".bs-info#confirm .confirm-price h3:nth-of-type(2)").textContent = 'MYR ' + totalPriceDiscount.toFixed(2) ;
    document.querySelector(".bs-info#confirm .confirm-price h3:nth-of-type(2)").setAttribute("data-total", totalPriceDiscount);

    document.querySelector("input#total").value = totalPriceDiscount;
}

document.addEventListener("DOMContentLoaded", function() {

    // info filter button
    document.querySelector("form#infoForm button#submit-button").addEventListener("click", function(event) {
        event.preventDefault();

        var checkinDate = new Date(document.querySelector("Form#infoForm input[name='checkinDate']").value);
        var checkoutDate = new Date(document.querySelector("Form#infoForm input[name='checkoutDate']").value);  
        var promocode = document.querySelector("Form#infoForm input[name='promocode']").value;

        if (checkoutDate <= checkinDate) {
            alert('Check-out date must be after check-in date.');
            return;
        }

        if (promocode == 'SAYAKENALOWNER') {
            document.querySelector(".info-bar").setAttribute("data-discount", "20");
        }
        else {
            document.querySelector(".info-bar").setAttribute("data-discount", "0");
        }

        var discount = document.querySelector(".info-bar").getAttribute("data-discount");

        var dateRangeInMilliseconds = checkoutDate.getTime() - checkinDate.getTime();
        dateRangeInDays = dateRangeInMilliseconds / (1000 * 60 * 60 * 24);

        var formattedCheckinDate = checkinDate.toLocaleDateString("en-US", { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        var formattedCheckoutDate = checkoutDate.toLocaleDateString("en-US", { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        var fullDateRange = formattedCheckinDate + ' – ' + formattedCheckoutDate;
        
        document.querySelector(".bs-info#info p:nth-of-type(2)").textContent = dateRangeInDays + ' nights';

        document.querySelector(".bs-info #date").textContent = fullDateRange;
        
        var roomPrice = document.querySelector(".bs-info#price .room-details").getAttribute("data-price");
        updateTotalRoomPrice(roomPrice, discount);

        document.querySelector("input#checkinDate").value = checkinDate.toISOString().split('T')[0];
        document.querySelector("input#checkoutDate").value = checkoutDate.toISOString().split('T')[0];
    });

    // room selection button
    document.querySelectorAll(".book-room #select-button").forEach(button => {
        button.addEventListener("click", function() {

            var roomID = this.getAttribute("data-id");
            var roomNumber = this.getAttribute("data-number");
            var roomType = this.getAttribute("data-type");
            var roomPrice = this.getAttribute("data-price");
            var roomSize = this.getAttribute("data-size");

            var discount = document.querySelector(".info-bar").getAttribute("data-discount");

            updateTotalRoomPrice(roomPrice, discount);

            document.querySelector(".bs-info#info h2").textContent = roomNumber;

            document.querySelector(".bs-info#price h3").textContent = roomType;
            document.querySelector(".bs-info#price p").textContent = 'MYR ' + roomPrice + ' per night';
            document.querySelector(".bs-info#price .room-details").setAttribute("data-price", roomPrice);

            var totalRoomPrice = roomPrice * dateRangeInDays;
            document.querySelector(".bs-info#confirm .confirm-price h3:nth-of-type(2)").textContent = 'MYR ' + totalRoomPrice.toFixed(2) ;

            document.querySelector("input#roomID").value = roomID;

        });
    });

    document.querySelector("#bookForm .book").addEventListener("click", function() {
        event.preventDefault();

        var formData = new FormData(document.getElementById('bookForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../util/booking_process.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Edit form submitted');
                console.log(xhr.responseText);

                var response = JSON.parse(xhr.responseText);
                if (response.status) {
                    alert(response.message);
                    window.location.href = "../pages/booking.php";
                } else {
                    alert(response.message);
                }
            } else {
                console.error('Form submission failed: ', xhr.responseText);
            }
        };
        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send(formData);
    });
});
</script>
<?php include('../util/footer.php');?>
</body>
</html>