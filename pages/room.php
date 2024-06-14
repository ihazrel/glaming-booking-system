<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Room</title>
	<link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/room.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
	<?php include('nav.php');?>

	<div class="filter-container">
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
					<select name="room-type" id="room-type">
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
		</div>
	</div>

	<div class="room-container">

		<div class="room">
			<div class="room-image">
				<img src="../pic/suite.png" alt="Lorem Ipsum">
			</div>
			<div class="room-desc">
				<div class="room-desc-name">
					<h2>Lorem ipsum</h2>
					<p>Lorem ipsum | Lorem ipsum </p>
				</div>
				<div class="room-desc-misc">
					Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem mollitia ducimus incidunt qui officiis iure impedit porro aut laudantium voluptatum! Expedita voluptas nesciunt tempora. Dolores, molestiae? <br><br>Enim quidem excepturi at.
				</div>
				<div class="room-desc-book">
					<button>Book Now</button>
				</div>
			</div>
		</div>
		
		<div class="room">
			<div class="room-image">
				<img src="../pic/suite.png" alt="Lorem Ipsum">
			</div>
			<div class="room-desc">
				<div class="room-desc-name">
					<h2>Lorem ipsum</h2>
					<p>Lorem ipsum | Lorem ipsum</p>
				</div>
				<div class="room-desc-misc">
					Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem mollitia ducimus incidunt qui officiis iure impedit porro aut laudantium voluptatum! Expedita voluptas nesciunt tempora. Dolores, molestiae? <br><br>Enim quidem excepturi at.
				</div>
				<div class="room-desc-book">
					<button>Book Now</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>