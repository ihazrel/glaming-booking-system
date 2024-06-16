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
	$query="Select * from room";
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

            $query = "SELECT * FROM room";
            if ($searchKey != null) {
                $query .= " room_type like '%$searchKey%' or room_desc like '%$searchKey%' or room_pax = '$searchKey' or room_price = '$searchKey'";
            }

        	$result = mysqli_query($link, $query) or die("Query failed");
        ?>

        <div class="content-table">
            <table>
                <tr style="background-color: #b92d2d">
                    <th style="width: 7%;">No</th>
                    <th style="width: 20%;">Type</th>
                    <th>Description</th>
                    <th style="width: 7%;">Pax</th>
                    <th style="width: 15%;">Price</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                $counter = 1;
                while($row = mysqli_fetch_array($result)){?>

                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td style="max-width: 100px ; text-overflow: ellipsis; white-space: nowrap;"><?php echo $row['room_type'];?></td>
                    <td style="max-width: 450px ; text-overflow: ellipsis; white-space: nowrap;"><?php echo $row['room_desc'];?></td>
                    <td><?php echo $row['room_pax'];?></td>
                    <td>RM<?php echo $row['room_price'];?></td>
                    <td><button class="edit" data-id="<?php echo $row['room_id'];?>" data-type="<?php echo htmlspecialchars($row['room_type'], ENT_QUOTES);?>" 
                              data-desc="<?php echo htmlspecialchars($row['room_desc'], ENT_QUOTES);?>" data-pax="<?php echo $row['room_pax'];?>" 
                              data-price="<?php echo $row['room_price'];?>"><i class="ri-pencil-line"></i></button>
                    <button class="delete" data-id="<?php echo $row['room_id'];?>"><i class="ri-delete-bin-line"></i></button></td>
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
                <input type="text" id="roomType" name="roomType" placeholder="Type">
                <input type="text" id="roomDesc" name="roomDesc" placeholder="Description">
                <input type="text" id="roomPax" name="roomPax" placeholder="Pax">
                <input type="text" id="roomPrice" name="roomPrice" placeholder="Price">
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
                <input type="hidden" id="hiddenroomID" name="roomID">    
                <input type="text" id="roomType" name="roomType">
                <input type="text" id="roomDesc" name="roomDesc">
                <input type="text" id="roomPax" name="roomPax">
                <input type="text" id="roomPrice" name="roomPrice">
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
        xhr.open("POST", "../../util/room/room_create.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Create form submitted');
                document.getElementById('createModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Room entry has been stored.';
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

            const roomID = this.getAttribute('data-id');
            const roomType = this.getAttribute('data-type');
            const roomDesc = this.getAttribute('data-desc');
            const roomPax = this.getAttribute('data-pax');
            const roomPrice = this.getAttribute('data-price');

            document.querySelector('#editModal #hiddenroomID').value = roomID;
            document.querySelector('#editModal #roomType').value = roomType;
            document.querySelector('#editModal #roomDesc').value = roomDesc;
            document.querySelector('#editModal #roomPax').value = roomPax;
            document.querySelector('#editModal #roomPrice').value = roomPrice;

            document.getElementById('editModal').style.display = 'block';
        });
    });
    document.querySelector('#editForm #edit-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('editForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/room/room_edit.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Edit form submitted');
                document.getElementById('editModal').style.display = 'none';
                document.querySelector('.alert').textContent = 'Success! Room entry has been edited.';
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

            const roomID = this.getAttribute('data-id');

            document.querySelector('#deleteModal #delete-button').setAttribute('data-id', roomID);

            document.getElementById('deleteModal').style.display = 'block';
        });
    });
    document.querySelector('#deleteModal #delete-button').addEventListener('click', function() {
        var roomID = this.getAttribute('data-id');

        var formData = new FormData();
        formData.append('roomID', roomID);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/room/room_delete.php", true);

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