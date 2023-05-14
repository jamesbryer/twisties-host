// Create a new Google Map
var map = new google.maps.Map(document.getElementById("map"), {
  zoom: 5,
  center: { lat: 51.5074, lng: -0.1278 },
});

//load the search box, which triggers all other function calls
window.onload = searchBox;

//get the elements to add event listeners to
let commentSubmitBtn = document.getElementById("comment-submit");
let commentTextField = document.getElementById("comment-input");
//add event listener to submit button
commentSubmitBtn.addEventListener("click", submitComment);
//add event listener to comment field, check for enter key to prevent default form submission
commentTextField.addEventListener('keydown', function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    submitComment(event);
    console.log("Enter key pressed");
  }
});

function searchBox() {
  var input = document.getElementById("search-box");
  var autocomplete = new google.maps.places.Autocomplete(input);
  google.maps.event.addListener(autocomplete, "place_changed", function () {
    var place = autocomplete.getPlace();
    var searchLat = place.geometry.location.lat();
    var searchLong = place.geometry.location.lng();
    console.log("Latitude: " + searchLat + ", Longitude: " + searchLong);

    // Prevent form submission when enter key is pressed
    input.addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
      }
    });

    var searchRadiusSelect = document.getElementById("radius-select");
    searchRadiusSelect.addEventListener("change", function (event) {
      var searchRadius = searchRadiusSelect.value;
      if (searchLat !== null && searchLong !== null && searchRadius !== null) {
        console.log("Search radius: " + searchRadius + ", Search latitude: " + searchLat + ", Search longitude: " + searchLong);
        getRoutes(searchLat, searchLong, searchRadius);
      }
    });
  });
}

function getRoutes(searchLat, searchLong, searchRadius) {
  // Create the AJAX request object
  var xhr = new XMLHttpRequest();
  // Set up the AJAX request
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Parse the JSON data
      var routes = JSON.parse(xhr.responseText);
      loadMap(routes);
    }
  };
  console.log("Making db request...");
  url = "db-request/get_roads.php?searchLat=" + searchLat + "&searchLong=" + searchLong + "&searchRadius=" + searchRadius;
  // Send the AJAX request to the server
  xhr.open("GET", url);
  xhr.send();
}

function getComments(routeID, callback) {
  // Create the AJAX request object
  var xhr = new XMLHttpRequest();
  // Set up the AJAX request
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Parse the JSON data
      var comments = JSON.parse(xhr.responseText);
      callback(comments);
    }
  };
  console.log("Making db request...");
  url = "db-request/get_comments.php?routeID=" + routeID;
  // Send the AJAX request to the server
  xhr.open("GET", url);
  xhr.send();
}

// Define the function for handling comment submission
function submitComment(event) {
  event.preventDefault(); // Prevent the default form submission behavior
  var comment = document.getElementById("comment-input").value;

  if (comment !== "") {  //access the text of the selected option (this is the routeID)
    var dropdown = document.getElementById("route-select");
    var routeID = dropdown.options[dropdown.selectedIndex].text;

    // Send the comment to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.status === 200 && comment !== "") {
        // Handle not logged in error
        console.log("Comment submitted!");
        // Clear the comment input and add confirmation message
        document.getElementById("comment-input").value = "";
        document.getElementById("comment-input").placeholder = "Thanks for your comment!";
        // Remove the event listener to prevent multiple submissions
        commentSubmitBtn.removeEventListener("click", submitComment);
        // Add the event listener again for the next submission
        commentSubmitBtn.addEventListener("click", submitComment);
        //refresh comments to show new comment
        getComments(routeID, addCommentsToArea);
      } else if (xhr.status === 403) { // Access denied error
        console.log("Access denied!");
        document.getElementById("comment-input").value = "";
        document.getElementById("comment-input").placeholder = "Please log in to comment!";
      }
    };
    xhr.open("POST", "db-request/add-comment.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("comment=" + comment + "&routeID=" + routeID);
  } else {
    document.getElementById("comment-input").placeholder = "Please enter a comment!";
  }

}

// Define the function for adding comments to the comment area
function addCommentsToArea(comments) {
  //set the comment area to display
  var infobox = document.getElementById("info-box");
  infobox.style.display = "block";
  //clear the comment area
  var commentArea = document.getElementById("comment-area");
  commentArea.innerHTML = "";

  console.log("Adding comments...");
  for (var i = 0; i < comments.length; i++) {
    var comment = document.createElement("p");
    comment.innerHTML = comments[i].comment;
    commentArea.appendChild(comment);
  }

  // Handle comment input
  var commentSubmitBtn = document.getElementById("comment-submit");
  commentSubmitBtn.addEventListener("click", submitComment);
}

function getUserLocation(callback) {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      callback([latitude, longitude]);
    }, function (error) {
      callback(null);
    });
  } else {
    callback(null);
  }
}

function createGmapLink(start_lat, start_lon, end_lat, end_long) {
  //get link element
  var wazeButton = document.getElementById("gmap-link");
  //empty waze button
  wazeButton.innerHTML = "";
  //create lat/lon strings
  endLatLon = end_lat + "," + end_long;
  startLatLon = start_lat + "," + start_lon;
  const url = `https://www.google.com/maps/dir/?api=1&amp;destination=${encodeURIComponent(endLatLon)}&amp;waypoints=${encodeURIComponent(startLatLon)}&amp;travelmode=driving`;
  //change waze button action
  wazeButton.innerHTML = `<a class="btn btn-outline-primary btn-block" href="${decodeURIComponent(url)}" target="_blank">Open in Google Maps</a>`;
  //make wazeDiv visible
  wazeButton.style.display = "block";
}

function loadMap(routes) {
  // create directions service
  var directionsService = new google.maps.DirectionsService();
  var directionsDisplay = new google.maps.DirectionsRenderer();
  //add directions service to map
  directionsDisplay.setMap(map);

  //delete any existing options from the dropdown
  var routeSelect = document.getElementById("route-select");
  for (var i = routeSelect.options.length - 1; i >= 0; i--) {
    //dont remove the first option which is the "select a route" option
    if (i != 0) {
      routeSelect.remove(i);
    }
  }

  // Loop through the routes and add them to the select dropdown
  for (var i = 0; i < routes.length; i++) {
    var option = document.createElement("option");
    option.value = i;
    option.innerHTML = routes[i].id;
    routeSelect.appendChild(option);
  }

  // Event listener on route select dropdown
  routeSelect.addEventListener("change", function (event) {
    //prevent default behavior
    event.preventDefault();
    // get the selected route
    var selectedRoute = routes[routeSelect.selectedIndex - 1];
    // set the route lat and long as LatLng objects
    var start = new google.maps.LatLng(
      parseFloat(selectedRoute.start_lat),
      parseFloat(selectedRoute.start_long)
    );
    var end = new google.maps.LatLng(
      parseFloat(selectedRoute.end_lat),
      parseFloat(selectedRoute.end_long)
    );

    // set the directions request variables
    var request = {
      origin: start,
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING,
    };

    // display the route on the map
    directionsService.route(request, function (result, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(result);
      }
    });

    // Get the comments for the selected route
    getComments(selectedRoute.id, addCommentsToArea);
    // Create the Google Maps link
    createGmapLink(selectedRoute.start_lat, selectedRoute.start_long, selectedRoute.end_lat, selectedRoute.end_long);
    // Reset existing value
    document.getElementById("comment-input").value = "";
    // Reset placeholder text
    document.getElementById("comment-input").placeholder = "Enter your comment";
  });
}
