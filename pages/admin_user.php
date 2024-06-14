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
	$query="Select * from user order by  user_id Asc";
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
            <button id="add"><i class="ri-add-line"></i></button>
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

            $query = "SELECT * FROM user";
            if ($searchKey != null) {
                $query .= " WHERE user_id = '$searchKey' or user_username like '%$searchKey%'";
            }

        	$result = mysqli_query($link, $query) or die("Query failed");
        ?>

        <div class="content-table">
            <table>
                <tr>
                    <th style="width: 7%;">No</th>
                    <th style="width: 7%;">ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th> Is Admin</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                $counter = 1;
                while($row = mysqli_fetch_array($result)){?>

                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['user_id'];?></td>
                    <td><?php echo $row['user_username'];?></td>
                    <td><?php echo $row['user_password'];?></td>
                    <td><?php if($row['user_isAdmin'] == 1)echo "True";else echo "False";?></td>
                    <td><button class="edit"><i class="ri-pencil-line"></i></button>
                    <button class="delete"><i class="ri-delete-bin-line"></i></button></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <!-- Modal Structure -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Edit Hotel</h2>
    <!-- Form inside the modal -->
    <form id="editForm">
      <!-- Add form fields here -->
      <input type="text" id="hotelName" name="hotelName" placeholder="Hotel Name">
      <!-- Add more fields as needed -->
      <button type="submit">Save Changes</button>
    </form>
  </div>
</div>
<script>
    // JavaScript to open the modal
    document.querySelectorAll('table button.edit').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'block';
        });
    });

    // JavaScript to close the modal
    document.querySelector('.close-button').addEventListener('click', function() {
        document.getElementById('editModal').style.display = 'none';
    });
</script>
</div>
</body>
</html>