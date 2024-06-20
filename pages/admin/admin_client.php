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
	$query="Select * from client";
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

            $query = "SELECT * FROM client";
            if ($searchKey != null) {
                $query .= " WHERE client_username = '$searchKey' or client_name like '%$searchKey%' or client_phone like '%$searchKey%'";
            }

        	$result = mysqli_query($link, $query) or die("Query failed");
        ?>

        <div class="content-table">
            <table>
                <tr style="background-color: #b92d2d">
                    <th style="width: 7%;">No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                $counter = 1;
                while($row = mysqli_fetch_array($result)){?>

                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['client_username'];?></td>
                    <td><?php echo $row['client_password'];?></td>
                    <td><?php echo $row['client_name'];?></td>
                    <td><?php echo $row['client_phone'];?></td>
                    <td><button class="edit" data-id="<?php echo $row['client_id'];?>" data-username="<?php echo htmlspecialchars($row['client_username'], ENT_QUOTES);?>" data-password="<?php echo htmlspecialchars($row['client_password'], ENT_QUOTES);?>" data-name="<?php echo $row['client_name'];?>" data-phone="<?php echo $row['client_phone']?>"><i class="ri-pencil-line"></i></button>
                    <button class="delete" data-id="<?php echo $row['client_id'];?>"><i class="ri-delete-bin-line"></i></button></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    
    <!--Alert Popup-->
    <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  
    </div>
    <div class="alert fail">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  
    </div>

    <!-- Modal Structure -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Create New Client</h3>
            <form id="createForm" class="createForm" method="POST">
                <input type="text" id="clientUsername" name="clientUsername" placeholder="Username">
                <input type="text" id="clientPassword" name="clientPassword" placeholder="Password">
                <input type="text" id="clientName" name="clientName" placeholder="Name">
                <input type="text" id="clientPhone" name="clientPhone" placeholder="Phone">
                <div class="button-container">
                    <button class="cancel-button"><i class="ri-close-line"></i></button>
                    <button id="create-button" type="submit" class="save-button"><i class="ri-save-3-line"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 style="margin: 10px;">Edit Client</h3>
            <form id="editForm" class="editForm" method="POST">
                <input type="hidden" id="hiddenclientID" name="clientID">   
                <input type="text" id="clientUsername" name="clientUsername" placeholder="Username">
                <input type="text" id="clientPassword" name="clientPassword" placeholder="Password">
                <input type="text" id="clientName" name="clientName" placeholder="Name">
                <input type="text" id="clientPhone" name="clientPhone" placeholder="Phone Number">
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
        xhr.open("POST", "../../util/client/client_create.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Create form submitted');
                document.getElementById('createModal').style.display = 'none';

                var response = JSON.parse(xhr.responseText);
                alertMessage = response.message;
                alertFlag = response.status;
                showAlert(alertFlag, alertMessage);

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

            const clientID = this.getAttribute('data-id');
            const clientUsername = this.getAttribute('data-username');
            const clientPassword = this.getAttribute('data-password');
            const clientName = this.getAttribute('data-name');
            const clientPhone = this.getAttribute('data-phone');

            document.querySelector('#editModal #hiddenclientID').value = clientID;
            document.querySelector('#editModal #clientUsername').value = clientUsername;
            document.querySelector('#editModal #clientPassword').value = clientPassword;
            document.querySelector('#editModal #clientName').value = clientName;
            document.querySelector('#editModal #clientPhone').value = clientPhone;

            document.getElementById('editModal').style.display = 'block';
        });
    });
    document.querySelector('#editForm #edit-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('editForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/client/client_edit.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Edit form submitted');
                document.getElementById('editModal').style.display = 'none';

                var response = JSON.parse(xhr.responseText);
                alertMessage = response.message;
                alertFlag = response.status;
                showAlert(alertFlag, alertMessage);

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

            const clientID = this.getAttribute('data-id');

            document.querySelector('#deleteModal #delete-button').setAttribute('data-id', clientID);

            document.getElementById('deleteModal').style.display = 'block';
        });
    });
    document.querySelector('#deleteModal #delete-button').addEventListener('click', function() {
        var clientID = this.getAttribute('data-id');

        var formData = new FormData();
        formData.append('clientID', clientID);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../util/client/client_delete.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                document.getElementById('deleteModal').style.display = 'none';

                var response = JSON.parse(xhr.responseText);
                alertMessage = response.message;
                alertFlag = response.status;
                showAlert(alertFlag, alertMessage);

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

function showAlert(status, message){
    
    if(status){
        document.querySelector('.alert.success').textContent = message;
        document.querySelector('.alert.success').style.opacity = '1';
        setTimeout(function() {
            document.querySelector('.alert.success').style.opacity = '0';
        }, 2500);
    }else{
        document.querySelector('.alert.fail').textContent = message;
        document.querySelector('.alert.fail').style.opacity = '1';
        setTimeout(function() {
            document.querySelector('.alert.fail').style.opacity = '0';
        }, 2500);
    }
}

</script>
</div>
</body>
</html>