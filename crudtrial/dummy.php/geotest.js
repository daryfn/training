$(document).ready(function(){
    $.getJSON('https://geolocation-db.com/json/')
       .done (function(location) {
          $('#country').html(location.country_name);
          $('#state').html(location.state);
          $('#city').html(location.city);
          $('#latitude').html(location.latitude);
          $('#longitude').html(location.longitude);
          $('#ip').html(location.IPv4);
       });
})

