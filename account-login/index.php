<?php

include "../header.php";
include_once "../config/conf.php";

//redirect user from login page if they are already logged in
if (isset($_SESSION['user_uid'])) {
    header("Location: ../");
    exit();
}

//if there are paramenters for error/confirmation messages, display them (errors are held in conf.php)
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if (array_key_exists($error, ERROR_MESSAGES)) {
        echo "<div class='alert alert-danger' role='alert'>" . ERROR_MESSAGES[$error] . "</div>";
    }
} elseif (isset($_GET['signup']) && $_GET['signup'] == 'success') {
    echo "<div class='alert alert-success' role='alert'>Sign up successful!</div>";
}

?>
<div style="padding-top: 10px;"></div>
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="index-login-login">
                <h3>Log In</h3>
                <p>If you already have an account, log in here!</p>
                <form action="includes/login.inc.php" method="post" required>
                    <div class="form-group">
                        <input class="form-control centre" type="text" name="uid" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control centre" type="password" name="pwd" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md">
            <div class="index-login-signup">
                <h3>Sign Up</h3>
                <p>Don't have an account? Sign up here!</p>
                <form action="includes/signup.inc.php" method="post">
                    <div class="form-group">
                        <input class="form-control centre" type="text" name="uid" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control centre" type="password" name="pwd" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control centre" type="password" name="pwdrepeat"
                            placeholder="Repeat password" required>
                    </div>
                    <div class="form-group"><input class="form-control centre" type="email" name="email"
                            placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
</body>

</html>