

$(function() {
    $('#theHeader').on('click', function() {
alert("Hello");

    });
});

function myFunction ()
{
    alert('HELLLo');
}

var x = document.getElementById("demo");
console.log(x);
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {

    x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
    console.log(x);
}


// if (navigator.geolocation) {
//     var timeoutVal = 10 * 1000 * 1000;
//     navigator.geolocation.getCurrentPosition(
//         displayPosition,
//         displayError,
//         { enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
//     );
// }
// else {
//     alert("Geolocation is not supported by this browser");
// }
//
// function displayPosition(position) {
//     alert("Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude);
// }
