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
    <div class="content">
        <div class="wrapper">
            <h1>Login</h1>
            <form id="loginForm" method="post">
                <input type="text" id="username" placeholder="Username">
                <input type="password" id="password" placeholder="Password">
                
                <button id="submit-button">Login</button>
            </form>
            <div class="member">
                Not a member? <a href="./signup.php">
                    Register Now
                </a>
            </div>
        </div>
    </div class="content">
    

<script>
    document.querySelector('#loginForm #submit-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('loginForm'));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../util/login_check.php", true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {

                console.log('Login form submitted');
            } else {
                console.error('Form submission failed: ', xhr.responseText);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send(formData);
    });
</script>
</body>
</html>