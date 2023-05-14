function initMap() {
    // Create the map
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: { lat: 51.5072, lng: 0.1276 }, // London as default center
    });

    // Set up markers array
    var markers = [];

    // Set up click event listener on map
    map.addListener("click", function (event) {
        // Clear markers if there are already two on the map
        if (markers.length === 2) {
            markers[0].setMap(null);
            markers[1].setMap(null);
            markers = [];
        }

        // Add marker to map at clicked location
        var marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
        });

        // Push marker to markers array
        markers.push(marker);
    });

    // Set up submit button click event listener
    document
        .getElementById("submit-btn")
        .addEventListener("click", function () {
            // Check if there are two markers on the map
            if (markers.length === 2) {
                // Get the coordinates of the two markers
                var startLat = markers[0].getPosition().lat();
                var startLng = markers[0].getPosition().lng();
                var endLat = markers[1].getPosition().lat();
                var endLng = markers[1].getPosition().lng();

                // Send the coordinates to the PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        //alert(xhr.responseText);
                        var text = document.getElementById("welcome-text");
                        //change text to confirmation message
                        text.innerHTML = "Route saved! Thank you for your contribution.";
                        //remove submit button
                        var submitBtn = document.getElementById("buttons");
                        submitBtn.remove();
                        //remove map
                        var map = document.getElementById("map");
                        map.remove();
                    }
                };
                xhr.open("POST", "save_route.php");
                xhr.setRequestHeader(
                    "Content-type",
                    "application/x-www-form-urlencoded"
                );
                xhr.send(
                    "start_lat=" +
                    startLat +
                    "&start_long=" +
                    startLng +
                    "&end_lat=" +
                    endLat +
                    "&end_long=" +
                    endLng
                );
            }
        });

    // Set up reset button click event listener
    document
        .getElementById("reset-btn")
        .addEventListener("click", function () {
            // Remove markers from map
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }

            // Clear markers array
            markers = [];
        });
}