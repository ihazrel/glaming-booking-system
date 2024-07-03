<?php
$successMsg = isset($_GET['success']) ? $_GET['success'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/signup.css">

    <script>
        var successMsg = '<?php echo $successMsg; ?>';
        if (successMsg) {
            alert(successMsg);
        }
    </script>
</head>
<body>
<?php include('../util/nav.php');?>
    <div class="content">
        <div class="wrapper">
            <h1>Login</h1>
            <form id="loginForm" method="get" action="../util/login_check.php">
                <input type="text" id="username" name="username" placeholder="Username">
                <input type="password" id="password" name="password" placeholder="Password">
                
                <button id="submit-button" type="submit">Login</button>
            </form>
            <div class="member">
                Not a member? <a href="./signup.php">
                    Register Now
                </a>
            </div>
        </div>
    </div class="content">
    

<script>
</script>
</body>
</html>