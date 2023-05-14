<?php

include "../header.php";
include_once "../config/conf.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: https://www.twistiesroaddiscoverer.co.uk");
    exit();
} else {
    //create page displaying User ID and Username from session using Bootstrap
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['user_uid'];
    echo "<div class='container'><div class='row'><div class='col-md'><div class='index-login-login'><h3>My Account</h3><p>User ID: $user_id</p><p>Username: $username</p></div></div></div></div>";
}



?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>