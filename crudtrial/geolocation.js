
function getLocation(){
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else { 
  document.getElementById().innerHTML =
  "Geolocation is not supported by this browser.";
}
}

function showPosition(position) {
  document.querySelector('.loginform input[name = "latitude"]').value = position.coords.latitude;
  document.querySelector('.loginform input[name = "longitude"]').value = position.coords.longitude;
  // "Accuracy: " + position.coords.accuracy + " " + "Meters";
}

function myMap() {
  var mapProp= {
    center:new google.maps.LatLng(-6.9887545,110.4605871),
    zoom:5,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }
