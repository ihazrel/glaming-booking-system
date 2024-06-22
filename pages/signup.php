<?php
$errorMsg = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
	<link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/signup.css">

    <script>
        var errorMsg = '<?php echo $errorMsg; ?>';
        if (errorMsg) {
            alert(errorMsg);
        }
    </script>
</head>
<body>
<?php include('../util/nav.php');?>
    <div class="content">
        <div class="wrapper">
            <h1>Sign up</h1>
            <form id="signupForm" method="POST" action="../util/signup_check.php">
                <input type="text" id="username" name="username" placeholder="Username">
                <input type="text" id="name" name="name" placeholder="Name">
                <input type="text" id="phone" name="phone" placeholder="Phone Number">
                <input type="password" id="password" name="password" placeholder="Password">
                <input type="password" id="passwordRe" placeholder="Re-Enter password">
                <button type="submit" id="signup">Sign up</button>
            </form>
            <div class="member">
                Already a member? <a href="./login.php">
                    Login Here
                </a>
            </div>
        </div>
    </div style="display:grid;place-content:center;">

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("button#signup").addEventListener("click", function(event) {

        var username = document.getElementById("username").value;
        var name = document.getElementById("name").value;
        var phone = document.getElementById("phone").value;
        var password = document.getElementById("password").value;
        var passwordRe = document.getElementById("passwordRe").value;

        if(username == "") {
            event.preventDefault();
            alert("Username can't be empty.");
            return;
        }
        if(name == "") {
            event.preventDefault();
            alert("Name can't be empty.");
            return;
        }
        if(phone == "") {
            event.preventDefault();
            alert("Phone number can't be empty.");
            return;
        }
        if(password == "") {
            event.preventDefault();
            alert("Password can't be empty.");
            return;
        }
        if (password !== passwordRe) {
            event.preventDefault();
            alert("Passwords do not match.");
            return;
        }
        
        document.getElementById("signupForm").submit();
    });
});
</script>
</body>
</html>