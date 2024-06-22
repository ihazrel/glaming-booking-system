<?php
session_start(); // Start the session.
session_unset(); // Unset all of the session variables.
session_destroy(); // Destroy the session.
header('Location: ../index.php'); // Redirect to login page or home page.
exit();