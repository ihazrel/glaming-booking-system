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
	$query="Select * from hotel";
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
                    <th>Description</th>
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
                    <button class="delete" data-id="<?php echo $row['hotel_id'];?>"><i class="ri-delete-bin-line"></i></button></td>
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
            <h3 style="margin: 10px;">Create New Hotel</h3>
            <form id="createForm" class="createForm" method="POST">
                <input type="text" id="hotelID" name="hotelID" placeholder="ID">   
                <input type="text" id="hotelLocation" name="hotelLocation" placeholder="Location">
                <input type="text" id="hotelDesc" name="hotelDesc" placeholder="Description">
                <div class="button-container">
                    <button class="cancel-button"><i class="ri-close-line"></i></button>
                    <button id="create-button" type="submit" class="save-button"><i class="ri-save-3-line"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Edit Hotel</h3>
            <form id="editForm" class="editForm" method="POST">
                <input type="text" id="hotelID" name="hotelID" disabled>
                <input type="hidden" id="hiddenHotelID" name="hotelID">    
                <input type="text" id="hotelLocation" name="hotelLocation">
                <input type="text" id="hotelDesc" name="hotelDesc">
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
        xhr.open("POST", "../../util/hotel/hotel_create.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Create form submitted');
                document.getElementById('createModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Hotel entry has been stored.';
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
    document.querySelector('#editForm #edit-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('editForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/hotel/hotel_edit.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Edit form submitted');
                document.getElementById('editModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Hotel entry has been edited.';
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

    // Event listerner for each delete button
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function() {

            const hotelID = this.getAttribute('data-id');

            document.querySelector('#deleteModal #delete-button').setAttribute('data-id', hotelID);

            document.getElementById('deleteModal').style.display = 'block';
        });
    });
    document.querySelector('#deleteModal #delete-button').addEventListener('click', function() {
        var hotelID = this.getAttribute('data-id');

        var formData = new FormData();
        formData.append('hotelID', hotelID);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/hotel/hotel_delete.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                document.getElementById('deleteModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Hotel entry has been deleted.';
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