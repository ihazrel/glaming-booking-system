<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/signup.css">
</head>
<body>
<?php include('../util/nav.php');?>
    <div class="wrapper">
        <h1>Login</h1>
        <form action="#">
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
        </form>
        <button>Login</button>
        <div class="member">
            Not a member? <a href="./signup.php">
                Register Now
            </a>
        </div>
    </div>
    
</body>
</html>