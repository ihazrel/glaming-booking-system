<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Room</title>
	<link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/room.css">
    <link rel="stylesheet" href="../style/footer.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<?php
include '../util/db_connect.php';
$query="Select * from room order by  room_id Asc";
$result = mysqli_query( $link,$query) or die("Query failed");	// SQL statement for checking
?>
<?php include('../util/nav.php');?>

	<div class="filter-container">
		<form action="" method="post">
			<div class="filter-bar">
				<div class="filter-button">
					<div class="ft-icon"><i class="ri-map-pin-line ri-2x"></i></div>
					<div class="ft-choice">
						<select name="destination" id="destination">
							<option value="all">All</option>
							<option value="johor">Johor</option>
							<option value="penang">Penang</option>
							<option value="pahang">Pahang</option>
						</select>
					</div>
				</div>

				<div class="filter-button">
					<div class="ft-icon"><i class="ri-user-line ri-2x"></i></div>
					<div class="ft-choice">
						<select name="room-pax" id="room-pax">
							<option value="all">All</option>
							<option value="1">1 pax</option>
							<option value="2">2 pax</option>
							<option value="3">3 pax</option>
						</select>
					</div>
				</div>

				<div class="filter-button">
					<div class="ft-icon"><i class="ri-hotel-bed-line ri-2x"></i></div>
					<div class="ft-choice">
						<select name="room-type" id="room-type">
							<option value="all">All</option>
							<option value="single">Single</option>
							<option value="double">Double</option>
							<option value="suite">Suite</option>
						</select>
					</div>
				</div>
				<input type="submit" value="Filter">
			</div>
		</form>
	</div>

	<?php
	
	$roomPax = 'all';
	$roomType = 'all';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$roomPax = isset($_POST['room-pax']) ? $_POST['room-pax'] : 'all';
		$roomType = isset($_POST['room-type']) ? $_POST['room-type'] : 'all';
	}

	$query = "SELECT * FROM room WHERE 1=1";
	if ($roomPax != 'all') {
		$query .= " AND room_pax >= '$roomPax'";
	}
	if ($roomType != 'all') {
		$query .= " AND room_type = '$roomType'";
	}

	$query .= " ORDER BY room_pax ASC";
	$result = mysqli_query($link, $query) or die("Query failed");
	?>

	<div class="room-container">
		<?php 
		if(mysqli_num_rows($result) == 0){
			echo "<h1>No rooms found</h1>";
		}
		else{
			while($row = mysqli_fetch_array($result)){?>

			<div class="room">
				<div class="room-image">
					<img src="../pic/suite.png" alt="Lorem Ipsum">
				</div>
				<div class="room-desc">
					<div class="room-desc-name">
						<h2><?php echo $row['room_type'];?></h2>
						<p><?php echo $row['room_pax'];?> pax | RM<?php echo $row['room_price'];?> per night</p>
					</div>
					<div class="room-desc-misc">
						<?php echo $row['room_desc'];?>	
						<br><br>
						Book now for unmatched comfort, prime location, and outstanding service.
					</div>
					<div class="room-desc-book">
						<button onclick="window.location.href='booking.php';">Book Now</button>
					</div>
				</div>
			</div>
		<?php
			}
		}
		?>
	</div>

<?php include('../util/footer.php');?>
</body>
</html>