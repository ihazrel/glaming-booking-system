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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

<div class="tier-card-container">
    <div class="tier-card" id="silver">
        <div class="title">
            <h1>Silver</h1>
            <h2>RM99</h2>
        </div>

        <div class="features">
            <ul>
                <li>Priority access to available rooms during booking.</li>
                <li>10% discount on room rates for repeat bookings.</li>
                <li>Monthly newsletter with exclusive offers.</li>
                <li>Dedicated customer support for all queries.</li>
            </ul>
        </div>

        <button id="silver" tier-price="99">Register</button>
    </div>

    <div class="tier-card" id="gold">
        <div class="title">
            <h1>Gold</h1>
            <h2>RM199</h2>
        </div>

        <div class="features">
            <ul>
                <li>All Silver benefits included.</li>
                <li>15% discount on room rates and dining.</li>
                <li>Early check-in (subject to availability).</li>
                <li>Exclusive discounts on partner services (e.g., spa or city tours).</li>
                <li>Complimentary in-room minibar restocked once per stay.</li>
                <li>One-time free room upgrade per year.</li>
            </ul>
        </div>

        <button id="gold" tier-price="199">Register</button>
    </div>

    <div class="tier-card" id="platinum">
        <div class="title">
            <h1>Platinum</h1>
            <h2>RM299</h2>
        </div>

        <div class="features">
            <ul>
                <li>All Gold benefits included.</li>
                <li>Complimentary airport transfers (to and from the hotel).</li>
                <li>20% discount on room rates, dining, and partner services.</li>
                <li>Guaranteed early check-in and late check-out.</li>
                <li>Priority reservations for popular facilities (e.g., restaurant, spa).</li>
                <li>Two complimentary free room upgrades per year.</li>
                <li>VIP lounge access in the hotel.</li>
                <li>Personalized concierge service for tailored experiences.</li>
            </ul>
        </div>

        <button id="platinum" tier-price="299">Register</button>
    </div>
</div>
    
<div class="popup" id="popup">
    <div class="popup-content">
        <div class="title">
            <h2></h2>
            <h3></h3>
        </div>
        <form id="registerForm">
            <label for="agree">
                <input type="checkbox" id="agree" name="agree" required>
                I agree to the price and terms.
            </label>

            <button type="submit">Submit</button>
        </form>
        <button class="close-btn" id="closePopup">Close</button>
    </div>
</div>

<?php include('../util/ft.php');?>
</body>
<script>
    $(document).ready(function() {
        $(".tier-card button").click(function() {
            $("#popup").css("display", "flex");
            let buttonId = $(this).attr("id");
            let tierPrice = $(this).attr("tier-price");

            $("#popup .popup-content h2").text(buttonId);
            $("#popup .popup-content h3").text("RM" + tierPrice);
        });

        $("#closePopup").click(function() {
            
            $("#popup").css("display", "none");
        });

        $("#registerForm").submit(function(e) {
            if (!<?php echo isset($_SESSION["username"]) ? 'true' : 'false'; ?>) {
                alert("You need to be logged in to register.");
                return;
            }

            e.preventDefault();

            let tier = $("#popup .popup-content h2").text();
            let tierPrice = $(".tier-card button").attr("tier-price");

            $.ajax({
                url: "../util/memberProcess.php",
                type: "POST",
                data: {
                    tier : tier,
                    tierPrice: tierPrice
                },
                success: function(response) {
                    // Ensure response is parsed properly
                    if (typeof response === "string") {
                        response = JSON.parse(response); // Parse the string into JSON
                    }
                    
                    // Alert the message from the response
                    alert(response.message);
                    $("#popup").css("display", "none");
                },
            });
        });
    });

</script>
</html>