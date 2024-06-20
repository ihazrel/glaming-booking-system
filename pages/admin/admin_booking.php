<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../style/nav.css">
    <link rel="stylesheet" href="../../style/sidebar.css">
    <link rel="stylesheet" href="../../style/admin_hotel.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
	include '../../util/db_connect.php';
	$query="Select * from booking";
	$result = mysqli_query( $link,$query) or die("Query failed");	// SQL statement for checking
	?>
<?php include('../../util/nav_admin.php');?>
<?php include('../../util/sidebar.php')?>
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

            $query = "SELECT * FROM booking b, client c WHERE b.client_id = c.client_id";
            if ($searchKey != null) {
                $query .= " and (b.booking_number like '%$searchKey%' or c.client_username like '%$searchKey%' or c.client_name like '%$searchKey%')";
            }

        	$result = mysqli_query($link, $query) or die("Query failed");
        ?>

        <div class="content-table">
            <table>
                <tr style="background-color: #b92d2d">
                    <th style="width: 7%;">No</th>
                    <th>Booking ID</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                    <th>Amount</th>
                    <th>Client Username</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                $counter = 1;
                while($row = mysqli_fetch_array($result)){?>

                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['booking_number'];?></td>
                    <td><?php echo $row['booking_checkin_date'];?></td>
                    <td><?php echo $row['booking_checkout_date'];?></td>
                    <td>RM<?php echo $row['booking_amt'];?></td>
                    <td><?php echo $row['client_username'];?></td>
                    <td><button class="edit" data-id="<?php echo $row['booking_id'];?>" data-number="<?php echo htmlspecialchars($row['booking_number'], ENT_QUOTES);?>" data-checkin="<?php echo $row['booking_checkin_date'];?>" data-checkout="<?php echo $row['booking_checkout_date'];?>" data-amount="<?php echo $row['booking_amt'];?>" data-clientID="<?php echo $row['client_id'];?>" data-clientUsername="<?php echo $row['client_username'];?>"><i class="ri-pencil-line"></i></button>
                    <button class="delete" data-id="<?php echo $row['booking_id'];?>"><i class="ri-delete-bin-line"></i></button></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    
    <!--Alert Popup-->
    <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  
            <strong>Success!</strong> Indicates a successful or positive action.
    </div>

    <!-- Modal Structure -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Create New Booking</h3>
            <form id="createForm" class="createForm" method="POST">
                <input type="text" id="bookingNumber" name="bookingNumber" placeholder="Booking ID">   
                <input type="date" id="bookingCheckinDate" name="bookingCheckinDate" placeholder="Checkin Date">
                <input type="date" id="bookingCheckoutDate" name="bookingCheckoutDate" placeholder="Checkout Date">
                <input type="number" id="bookingAmount" name="bookingAmount" placeholder="Booking Amount">
                <input type="text" id="clientUsername" name="clientUsername" placeholder="Client Username">
                <div class="button-container">
                    <button class="cancel-button"><i class="ri-close-line"></i></button>
                    <button id="create-button" type="submit" class="save-button"><i class="ri-save-3-line"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Edit Booking</h3>
            <form id="editForm" class="editForm" method="POST">
                <input type="hidden" id="hiddenbookingID" name="bookingID"> 
                <input type="text" id="bookingNumber" name="bookingNumber" placeholder="Booking ID">   
                <input type="date" id="bookingCheckinDate" name="bookingCheckinDate" placeholder="Checkin Date">
                <input type="date" id="bookingCheckoutDate" name="bookingCheckoutDate" placeholder="Checkout Date">
                <input type="number" id="bookingAmount" name="bookingAmount" placeholder="Booking Amount">
                <input type="text" id="clientUsername" name="clientUsername" placeholder="Client Username" disabled>
                <div class="button-container">
                    <button class="cancel-button"><i class="ri-close-line"></i></button>
                    <button id="edit-button" type="submit" class="save-button"><i class="ri-save-3-line"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Are you sure you want to delete?</h3>
            <div class="button-container">
                <button onclick="close_modal(event, this)" class="cancel-button"><i class="ri-close-line"></i></button>
                <button id="delete-button" class="delete-button" data-id=""><i class="ri-delete-bin-line"></i></button>
            </div>
        </div>
    </div>

</div>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Event listener for the create button
    document.getElementById('create').addEventListener('click', function() {
    // Code to display the create modal
        document.getElementById('createModal').style.display = 'block';
    });
    document.querySelector('#createForm #create-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('createForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/booking/booking_create.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Create form submitted');
                document.getElementById('createModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Booking entry has been stored.';
                showAlert();
            } else {
                console.error('Form submission failed: ', xhr.responseText);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send(formData);
    });
   
    // Event listeners for each edit button
    document.querySelectorAll('table .edit').forEach(button => {
        button.addEventListener('click', function() {

            const bookingID = this.getAttribute('data-id');
            const bookingNumber = this.getAttribute('data-number');
            const bookingCheckinDate = this.getAttribute('data-checkin');
            const bookingCheckoutDate = this.getAttribute('data-checkout');
            const bookingAmount = this.getAttribute('data-amount');
            const clientUsername = this.getAttribute('data-clientUsername');

            document.querySelector('#editModal #hiddenbookingID').value = bookingID;
            document.querySelector('#editModal #bookingNumber').value = bookingNumber;
            document.querySelector('#editModal #bookingCheckinDate').value = bookingCheckinDate;
            document.querySelector('#editModal #bookingCheckoutDate').value = bookingCheckoutDate;
            document.querySelector('#editModal #bookingAmount').value = bookingAmount;
            document.querySelector('#editModal #clientUsername').value = clientUsername;

            document.getElementById('editModal').style.display = 'block';
        });
    });
    document.querySelector('#editForm #edit-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('editForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/booking/booking_edit.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Edit form submitted');
                document.getElementById('editModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Booking entry has been edited.';
                showAlert();

                console.log(xhr.responseText);
            } else {
                console.error('Form submission failed: ', xhr.responseText);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send(formData);
    });

    // Event listerner for each delete button
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function() {

            const bookingID = this.getAttribute('data-id');

            document.querySelector('#deleteModal #delete-button').setAttribute('data-id', bookingID);

            document.getElementById('deleteModal').style.display = 'block';
        });
    });
    document.querySelector('#deleteModal #delete-button').addEventListener('click', function() {
        var bookingID = this.getAttribute('data-id');

        var formData = new FormData();
        formData.append('bookingID', bookingID);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/booking/booking_delete.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                document.getElementById('deleteModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Room entry has been deleted.';
                showAlert();
            } else {
                console.error('Form submission failed: ', xhr.responseText);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send(formData);
    });
    
    // JavaScript to close the modal
    document.querySelectorAll('.cancel-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            this.closest('.modal').style.display = 'none';
        });
    });

});  

function showAlert(){
    document.querySelector('.alert').style.opacity = '1';
    setTimeout(function() {
        document.querySelector('.alert').style.opacity = '0';
    }, 2500);
}

</script>
</div>
</body>
</html>