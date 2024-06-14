<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/admin_hotel.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
	include '../util/db_connect.php';
	$query="Select * from hotel order by  hotel_id Asc";
	$result = mysqli_query( $link,$query) or die("Query failed");	// SQL statement for checking
	?>
<?php include('../util/nav.php');?>
<div class="ac-sidebar">
    <ul>
        <li><a href="./admin_dashboard.php"><i class="ri-dashboard-line"></i>Dashboard</a></li>
        <li><a href="./admin_hotel.php"><i class="ri-community-line"></i>Hotel</a></li>
        <li><a href="./admin_room.php"><i class="ri-hotel-bed-line"></i>Room</a></li>
        <li><a href="./admin_user.php"><i class="ri-user-line"></i>User</a></li>
        <li><a href="./admin_booking.php"><i class="ri-book-read-line"></i>Booking</a></li>
    </ul>
</div>

<div class="main">
    <div class="content">
        <div class="content-head">
            <button id="create" class="create"><i class="ri-add-line"></i></button>
            <form action="" method="post">
                <input type="text" name="searchKey" id="searchKey" placeholder="Search">
                <button type="submit"><i class="ri-search-line"></i></button>
            </form>
        </div>
        <?php
        $searchKey = null;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $searchKey = isset($_POST['searchKey']) ? $_POST['searchKey'] : 'all';
            }

            $query = "SELECT * FROM hotel";
            if ($searchKey != null) {
                $query .= " WHERE hotel_id = '$searchKey' or hotel_location like '%$searchKey%' or hotel_desc like '%$searchKey%'";
            }

        	$result = mysqli_query($link, $query) or die("Query failed");
        ?>

        <div class="content-table">
            <table>
                <tr>
                    <th style="width: 7%;">No</th>
                    <th style="width: 7%;">ID</th>
                    <th style="width: 15%;">Location</th>
                    <th>Desc</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                $counter = 1;
                while($row = mysqli_fetch_array($result)){?>

                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['hotel_id'];?></td>
                    <td><?php echo $row['hotel_location'];?></td>
                    <td style="max-width: 516px ; text-overflow: ellipsis; white-space: nowrap;"><?php echo $row['hotel_desc'];?></td>
                    <td><button class="edit" data-id="<?php echo $row['hotel_id'];?>" data-location="<?php echo htmlspecialchars($row['hotel_location'], ENT_QUOTES);?>" data-desc="<?php echo htmlspecialchars($row['hotel_desc'], ENT_QUOTES);?>"><i class="ri-pencil-line"></i></button>
                    <button class="delete"><i class="ri-delete-bin-line"></i></button></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Create New Hotel</h3>
            <form id="createForm" class="createForm" method="get">
                <input type="text" id="hotelID" name="hotelID" placeholder="ID">   
                <input type="text" id="hotelLocation" name="hotelLocation" placeholder="Location">
                <input type="text" id="hotelDesc" name="hotelDesc" placeholder="Description">
                <div class="button-container">
                    <button class="cancel-button"><i class="ri-close-line"></i></button>
                    <button type="submit" class="save-button"><i class="ri-save-3-line"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Edit Hotel</h3>
            <form id="editForm" class="editForm" method="get">
                <input type="text" id="hotelID" name="hotelID" disabled>
                <input type="hidden" id="hiddenHotelID" name="hotelID">    
                <input type="text" id="hotelLocation" name="hotelLocation">
                <input type="text" id="hotelDesc" name="hotelDesc">
                <div class="button-container">
                    <button class="cancel-button"><i class="ri-close-line"></i></button>
                    <button type="submit" class="save-button"><i class="ri-save-3-line"></i></button>
                </div>
            </form>
        </div>
    </div>


<script>

document.addEventListener('DOMContentLoaded', function() {
// Event listener for the create button
    document.getElementById('create').addEventListener('click', function() {
    // Code to display the create modal
        document.getElementById('createModal').style.display = 'block';
    });

    // Event listeners for each edit button
    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', function() {

            const hotelID = this.getAttribute('data-id');
            const hotelLocation = this.getAttribute('data-location');
            const hotelDesc = this.getAttribute('data-desc');

            document.querySelector('#editModal #hotelID').value = hotelID;
            document.querySelector('#editModal #hiddenHotelID').value = hotelID;
            document.querySelector('#editModal #hotelLocation').value = hotelLocation;
            document.querySelector('#editModal #hotelDesc').value = hotelDesc;

            document.getElementById('editModal').style.display = 'block';
        });
    });

    document.querySelector('#editForm .save-button').addEventListener('click', function() {
        document.getElementById('editForm').submit();
        console.log('Edit form submitted');
        document.getElementById('editForm').style.display = 'none';

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $hotelID       = isset($_GET['hotelID']) ? $_GET['hotelID'] : '';
                $hotelLocation = isset($_GET['hotelLocation']) ? $_GET['hotelLocation'] : '';
                $hotelDesc     = isset($_GET['hotelDesc']) ? $_GET['hotelDesc'] : '';

                $query = "UPDATE hotel SET hotel_location = '$hotelLocation', hotel_desc = '$hotelDesc' WHERE hotel_id = '$hotelID'";
                $result = mysqli_query($link, $query) or die("Query failed");
            }
        ?>
    });

    // JavaScript to close the modal
    document.querySelectorAll('.cancel-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission or link navigation
            // Close the parent modal of this button
            this.closest('.modal').style.display = 'none';
        });
    });

});         
</script>
</div>
</body>
</html>