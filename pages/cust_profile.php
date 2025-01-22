<?php
	session_start();
  $id = $_SESSION['id'];

	if (!isset($_SESSION['password'])) {
    echo "<script type='text/javascript'>
            alert('password missing.');
            window.location.assign('homepage.php');
          </script>";
    exit();
}
include '../util/db_connect.php';

	// Get the logged-in user's password from the session
  $id = $_SESSION['id'];
  $password = $_SESSION['password'];
	
	// Query for user details
	$sql = "SELECT * FROM client WHERE client_id = '$id'";
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
  <link rel="stylesheet" href="../style/cust_booking.css" />
</head>
<body>
<?php
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

      <div class="rightbox">
        <div class="profile">
          <table class="table">
            <thead>
              <tr>
                <th>Username</th>
                <th>password</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Membership Tier</th>
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
                        <td>" . $row["membership_tier"] . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edit_profile.php?id=" . $row["client_id"] . "'>Edit</a>
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