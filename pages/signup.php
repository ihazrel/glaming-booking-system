<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
	<link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/sign-up.css">

</head>
<body>
    <?php include('nav.php');?>
    <div class="wrapper">
        <h1>Sign up</h1>
        <form action="#">
            <input type="text" placeholder="Username">
            <input type="text" placeholder="name">
            <input type="password" placeholder="Password">
            <input type="password" placeholder="Re-Enter password">
        </form>
        ><button>Sign up</button>
        <div class="member">
            Already a member? <a href="./login.html">
                Login Here
            </a>
        </div>
    </div>
    
</body>
</html>