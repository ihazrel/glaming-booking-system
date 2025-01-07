<nav>
    <img src="../pic/LogoHotel.png" class="logo">
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="./about.php">About</a></li>
        <li><a href="./room.php">Room</a></li>
        <li><a href="./membership.php">Membership</a></li>
        <li id="book"><a href="./booking.php">Book Now</a></li>
        <li><a href="./cust_profile.php"><i class="ri-account-circle-line"></i>  <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
        <li><a href="../util/logout.php" class="btn">Logout</a></li>
    </ul>
</nav>