<?php
session_start();
include './db_connect.php';

// Base query
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

// Add filter if location is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hotelLocation = isset($_POST['hotelLocation']) ? $_POST['hotelLocation'] : '%';
    if ($hotelLocation != 'all') {
        $hotelLocation = mysqli_real_escape_string($link, $hotelLocation); // Sanitize input
        $query .= " AND h.hotel_location = '$hotelLocation'";
    }
}

$query .= " ORDER BY h.hotel_location, h.hotel_name, r.room_type, r.room_price";

$result = mysqli_query($link, $query);

// Generate room containers dynamically
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="room-container">
            <div class="rc-head">
                <div class="rc-h-image"><img src="../pic/suite.png" alt="Lorem Ipsum"></div>
                <div class="rc-h-desc">
                    <h2>' . htmlspecialchars($row['room_type']) . '</h2>
                    <p>' . htmlspecialchars($row['room_pax']) . ' people | Lorem ipsum</p>
                </div>
            </div>
            <div class="rc-body">
                <div class="rc-b-choice">
                    <div class="rc-bc-title">
                        <h2>' . htmlspecialchars($row['room_number']) . '</h2>
                        <h4>' . htmlspecialchars($row['hotel_name']) . ' | ' . htmlspecialchars($row['hotel_location']) . ' Branch</h4>
                    </div>
                    <div class="rc-bc-right">
                        <div class="rc-bc-price">
                            <p>MYR' . htmlspecialchars($row['room_price']) . ' night</p>
                        </div>
                        <button class="select-button" id="select-button" data-id="' . htmlspecialchars($row['hotelroom_id']) . '" 
                                data-number="' . htmlspecialchars($row['room_number']) . '" 
                                data-type="' . htmlspecialchars($row['room_type']) . '" 
                                data-price="' . htmlspecialchars($row['room_price']) . '" 
                                data-size="' . htmlspecialchars($row['room_pax']) . '" 
                                data-total="">
                            <span>Select</span>
                        </button>
                    </div>                       
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p>No rooms available for the selected location.</p>';
}

// Close the database connection
mysqli_close($link);
?>
