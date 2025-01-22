<?php session_start(); 
include '../util/db_connect.php';

    $id = $_SESSION['id'];

    $query = "SELECT `membership_tier` FROM `client` WHERE `client_id` = '" . $id . "'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    $_SESSION['tier'] = $row['membership_tier'];
?>
<script>
var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking form</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/booking.css">
    <link rel="stylesheet" href="../style/ft.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
            <div class="info-field">
                    <fieldset>
                        <label>Location</label>
                        <select name="hotelLocation" id="hotelLocation">
                            <option value="all">All</option>
                            <option value="selangor">Selangor</option>
                            <option value="pahang">Pahang</option>
                            <option value="johor">Johor</option>
                            <option value="pulau pinang">Pulau Pinang</option>
                        </select>
                    </fieldset>
                </div>

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
              WHERE hr.booking_id IS NULL";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $hotelLocation = isset($_POST['hotelLocation']) ? $_POST['hotelLocation'] : 'all';
        if ($hotelLocation != 'all') {
            $query .= " AND h.hotel_location = '$hotelLocation'";
        }


    }

    $query .= " ORDER BY h.hotel_location, h.hotel_name, r.room_type, r.room_price";

    $result = mysqli_query($link, $query);
    ?>

    <div class="book-container">
        <div class="book-room">
            
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
                <div class="member-discount">
                    <h4>Member discount</h4>
                    <p>MYR 0.00</p>
                </div>
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
var membershipDiscount = 0;

$(document).ready(function () {
    console.log('<?php echo isset($_SESSION['tier']) ? $_SESSION['tier'] : 'null'; ?>');

    // Function to fetch filtered data
    function fetchRooms() {
        const location = $('#hotelLocation').val();
        $.ajax({
            url: '../util/fetchRoom.php', // URL of the PHP script
            type: 'POST',
            data: { hotelLocation: location },
            success: function (data) {
                $('.book-room').html(data); // Populate room container
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Fetch rooms when the page loads
    fetchRooms();

    // Fetch rooms on dropdown change
    $('#hotelLocation').change(function () {
        fetchRooms();
    });

    $("form#infoForm button#submit-button").on("click", function (event) {
        event.preventDefault();

        var checkinDate = new Date($("form#infoForm input[name='checkinDate']").val());
        var checkoutDate = new Date($("form#infoForm input[name='checkoutDate']").val());
        var promocode = $("form#infoForm input[name='promocode']").val();

        if (checkoutDate <= checkinDate) {
            alert('Check-out date must be after check-in date.');
            return;
        }

        var discount = promocode.toUpperCase() === 'SAYAKENALOWNER' ? "20" : "0";
        $(".info-bar").attr("data-discount", discount);

        var dateRangeInMilliseconds = checkoutDate.getTime() - checkinDate.getTime();
        dateRangeInDays = dateRangeInMilliseconds / (1000 * 60 * 60 * 24);

        var formattedCheckinDate = checkinDate.toLocaleDateString("en-US", { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        var formattedCheckoutDate = checkoutDate.toLocaleDateString("en-US", { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        var fullDateRange = `${formattedCheckinDate} – ${formattedCheckoutDate}`;

        $(".bs-info#info p:nth-of-type(2)").text(`${dateRangeInDays} nights`);
        $(".bs-info #date").text(fullDateRange);

        var roomPrice = $(".bs-info#price .room-details").data("price");
        updateTotalRoomPrice(roomPrice, discount);

        $("input#checkinDate").val(checkinDate.toISOString().split('T')[0]);
        $("input#checkoutDate").val(checkoutDate.toISOString().split('T')[0]);
    });

    $(document).on("click", ".room-card", function() {
        var roomID = $(this).data("room-id");
        var roomNumber = $(this).data("room-number");
        var hotelName = $(this).data("hotel-name");
        var roomType = $(this).data("room-type");
        var roomPrice = $(this).data("room-price");

        $(".bs-info#info h2").text(`${hotelName} - Room ${roomNumber}`);
        $(".bs-info#price h3").text(`MYR ${roomPrice}`);
        $(".bs-info#price .room-details p").text(roomType);
        $(".bs-info#price .room-details").attr("data-price", roomPrice);

        $("input#roomID").val(roomID);

        updateTotalRoomPrice(roomPrice, $(".info-bar").attr("data-discount"));
    });

    $(document).on("click", ".room-container #select-button", function () { 
        console.log('MEOW');

        var roomID = $(this).data("id");
        var roomNumber = $(this).data("number");
        var roomType = $(this).data("type");
        var roomPrice = $(this).data("price");
        var roomSize = $(this).data("size");

        var discount = $(".info-bar").data("discount");

        $(".bs-info#info h2").text(roomNumber);
        $(".bs-info#price h3").text(roomType);
        $(".bs-info#price p").text(`MYR ${roomPrice} per night`);
        $(".bs-info#price .room-details").data("price", roomPrice);

        var totalRoomPrice = roomPrice * dateRangeInDays;
        $(".bs-info#confirm .confirm-price h3:nth-of-type(2)").text(`MYR ${totalRoomPrice.toFixed(2)}`);

        $("input#roomID").val(roomID);

        updateTotalRoomPrice(roomPrice, discount);
    });

    <?php
    if (isset($_SESSION['tier'])) {
        if ($_SESSION['tier'] == 'platinum') {
            echo 'membershipDiscount = 20;';
        } else if ($_SESSION['tier'] == 'gold') {
            echo 'membershipDiscount = 15;';
        } else if ($_SESSION['tier'] == 'silver') {
            echo 'membershipDiscount = 10;';
        } else {
            echo 'membershipDiscount = 0;';
        }
    } else {
        echo 'membershipDiscount = 0;';
    }
    ?>
});

var dateRangeInDays = 1;

function updateTotalRoomPrice(roomPrice, discount) {
    var price = (roomPrice !== 0) ? roomPrice : 0;
    var totalRoomPrice = price * dateRangeInDays ;
    var membershipDiscountAmount = totalRoomPrice * (membershipDiscount / 100);
    var additionalDiscountAmount = totalRoomPrice * (discount / 100);

    var totalPriceDiscount = totalRoomPrice - membershipDiscountAmount - additionalDiscountAmount;

    document.querySelector(".bs-info#confirm .member-discount p").textContent = '- MYR ' + membershipDiscountAmount.toFixed(2);
    document.querySelector(".bs-info#confirm .confirm-discount p").textContent = '- MYR ' + additionalDiscountAmount.toFixed(2);
    document.querySelector(".bs-info#confirm .confirm-price h3:nth-of-type(2)").textContent = 'MYR ' + totalPriceDiscount.toFixed(2) ;
    document.querySelector(".bs-info#confirm .confirm-price h3:nth-of-type(2)").setAttribute("data-total", totalPriceDiscount);

    document.querySelector("input#total").value = totalPriceDiscount;
}

    document.querySelector("#bookForm .book").addEventListener("click", function() {
        event.preventDefault();

        if (!isLoggedIn) {
            alert('Please log in first.');
            return;
        }

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
</script>
<?php include('../util/ft.php');?>
</body>
</html>