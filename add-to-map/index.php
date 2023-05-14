<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Status: 301 Moved Permanently");
    header("Location: https://www.twistiesroaddiscoverer.co.uk");
    exit();
}
include "../header.php";
include_once "../config/conf.php";
?>
<link rel="stylesheet" href="styles.css">
<div class="container">
    <div class="row">
        <div class="col">
            <h3 style="margin-top: 5px;">Add to Map</h3>
            <p id="welcome-text">Welcome! If you would like to contribute to our map, just click/tap the start point of
                your road, then
                the end point! Click submit and its all done!</p>
        </div>
    </div>
    <div class="row" id="buttons">
        <div class="col"><button id="submit-btn" class="btn btn-primary btn-block">Submit</button></div>
        <div class="col"><button id="reset-btn" class="btn btn-outline-primary btn-block">Reset</button></div>
    </div>
    <div id="map" style="margin-top: 10px;"></div>
</div>
<br />


<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script async defer src="<?php echo API_URL_FRONT . API_KEY_ADD_NEW . ADD_NEW_URL_BACK; ?>">
</script>
</body>

</html>