
<?php
	session_start();

	if (!isset($_SESSION['password'])) {
    echo "<script type='text/javascript'>
            alert('password missing.');
            window.location.assign('homepage.php');
          </script>";
    exit();
}
include '../util/db_connect.php';
include('../util/nav.php');
	
	// Get the logged-in user's password from the session
  $password = $_SESSION['password'];
	
	// Query for user details
	$sql = "SELECT * FROM client WHERE client_password = '$password'";
	$result = $link->query($sql);		

  if ($result === false) {
    die("Query failed: " . $link->error);
}
?>

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
  
    
    <div class="container">
      <div id="logo">
        <h1 class="logo">Profile</h1>
      </div>

      <div class="leftbox">
        <nav>
          <a href="cust_profile.php" class="active">
            <i class="fa fa-user"></i>
          </a>
          <a href="cust_booking.php">
            <i class="fa fa-credit-card"></i>
          </a>
        </nav>
      </div>

      <div class="rightbox">
        <div class="profile">
          <table class="table">
            <thead>
              <tr>
              <th>Profile</th>
                <th>Username</th>
                <th>password</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
			      if ($result->num_rows > 0)	{
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["client_username"] . "</td>
                        <td>" . $row["client_password"] . "</td>
                        <td>" . $row["client_name"] . "</td>
                        <td>" . $row["client_phone"] . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edit_profile.php?id=" . $row["client_password"] . "'>Edit</a>
                        </td>
                      </tr>";
            }
			} else {
				echo "<tr><td colspan='8' class='text-center'>No food items available</td></tr>";
			}
            ?>
            </tbody>
            </table>
          
        </div>
      </div>
    </div>
<script>

</script>

  </body>
</html>
<?php
$link->close();
?>