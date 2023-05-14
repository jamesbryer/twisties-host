<?php
include "header.php";
include_once "config/conf.php";
?>

<div class="container" id="container">
    <div class="row">
        <div class="col-lg-4">
            <form id="location-form">
                <div class="row" style="padding-top: 10px; padding-bottom:10px;">
                    <div class="col">
                        <input id="search-box" type="search" placeholder="Enter your location"
                            class="form-control centre" required />
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col">
                        <select id="radius-select" class="custom-select mr-sm-2 centre" required>
                            <option value="" selected disabled>Select a radius</option>
                            <option value="5">5 miles</option>
                            <option value="10">10 miles</option>
                            <option value="15">15 miles</option>
                            <option value="20">20 miles</option>
                            <option value="50">50 miles</option>
                            <option value="100">100 miles</option>
                            <option value="200">200 miles</option>
                            <option value="100000">Unlimited</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <select id="route-select" name="route" class="custom-select mr-sm-2 centre"
                            style="width: 100%;">
                            <option value="" selected disabled>Select a Route</option>
                        </select>
                    </div>
                </div>
            </form>
            <form id="comment-form">
                <div id="info-box" class="row" style="padding-top: 10px;">
                    <div class="col">
                        <div class="form-control">
                            <h5>Comments:</h5>
                            <div id="comment-area"></div>
                            <input style="margin-bottom: 3px;" id="comment-input" type="text"
                                placeholder="Enter your comment" class="form-control" required />
                            <input type="button" value="Comment" class="btn btn-primary form-control btn-sm"
                                id="comment-submit">
                        </div>
                    </div>
                </div>
            </form>
            <form>
                <div class="row" style="padding-top: 10px;">
                    <div class="col" id="gmap-link"></div>
                </div>
            </form>
        </div>
        <div class="col-lg-8" style="padding-top: 10px;">
            <div id="map" style="height: 800px; width: 100%"></div>
        </div>
    </div>


</div>
<script src="<?php echo API_URL_FRONT . API_KEY_INDEX . INDEX_API_URL_BACK; ?>">
</script>
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

</body>

</html>