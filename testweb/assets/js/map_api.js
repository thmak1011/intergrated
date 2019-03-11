var myLatLng;
var quotation_box = document.getElementById('quotation_box');
var tollSelector = document.getElementById('toll_selector');


function initMap(position) {
    var map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: {lat: 22.2795, lng: 114.1648},
        zoom: 12,
    });
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    myLatLng = {
        lat: latitude,
        lng: longitude
    };
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'My location'
    });

    new AutocompleteDirectionsHandler(map);
}

var image={
    url: "https://i.ibb.co/VTQ394X/iconfinder-BT-c3top-905662-2.png",
};

var driver_latlng = [
    ['driver1',22.304298, 114.185242, 4],
    ['driver2', 22.296916, 114.177472, 5],
    ['driver3', 22.310681, 114.179505, 3],
    ['driver4', 22.303336, 114.174545, 2],
    ['driver5', 22.308422, 114.182829, 1]
];

function setMarkers(map) {
    for (var i=0;i<driver_latlng.length;i++) {
        var driver_pos=driver_latlng[i];
        var marker = new google.maps.Marker({
            position: {lat: driver_pos[1], lng: driver_pos[2]},
            map: map,
            icon: image});
    }

}

/**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
    this.map = map;
    this.originPlaceId = null;
    this.destinationPlaceId = null;
    quotation_box.style.display="none";
    this.toll = true;
    //this.travelMode = 'DRIVING';
    //this.placeService= new google.maps.places.PlacesService;
    this.directionsService = new google.maps.DirectionsService;
    this.directionsDisplay = new google.maps.DirectionsRenderer({draggable:true});
    this.directionsDisplay.setMap(map);


    var originInput = document.getElementById('origin-input');
    var destinationInput = document.getElementById('destination-input');

    //  var modeSelector = document.getElementById('mode-selector');
    //var modeSelector = 'DRIVING';

    var originAutocomplete = new google.maps.places.Autocomplete(originInput);
    // Specify just the place data fields that you need.
    originAutocomplete.setFields(['place_id']);

    var destinationAutocomplete =
        new google.maps.places.Autocomplete(destinationInput);
    // Specify just the place data fields that you need.
    destinationAutocomplete.setFields(['place_id']);

    this.setupClickListener('toll-selector');

    this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
    this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(tollSelector);
    this.map.controls[google.maps.ControlPosition.LEFT_CENTER].push(quotation_box);

}

AutocompleteDirectionsHandler.prototype.setupClickListener = function(
    id) {
    var checkBox = document.getElementById(id);
    var me = this;


    checkBox.addEventListener('click', function() {
        if (this.checked==true) {
            me.toll = true;
            console.log('toll change to true');}

        else{
            me.toll = false;
            console.log('toll change to false');
        }
        me.route();
    });
};


AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
    var me = this;
    autocomplete.bindTo('bounds', this.map);


    autocomplete.addListener('place_changed', function() {


        var place = autocomplete.getPlace();

        if (!place.place_id) {
            window.alert('Please select an option from the dropdown list.');
            return;
        }
        if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;

        } else {
            me.destinationPlaceId = place.place_id;
        }
        me.route();
    });
};

AutocompleteDirectionsHandler.prototype.route = function() {
    if (!this.originPlaceId || !this.destinationPlaceId) {
        return;
    }
    var me = this;
    setMarkers(me.map);

    this.directionsService.route(
        {
            origin: {'placeId': this.originPlaceId},
            destination: {'placeId': this.destinationPlaceId},
            travelMode: "DRIVING",
            avoidTolls: this.toll
        },
        function(response, status) {
            if (status === 'OK') {

                me.directionsDisplay.setDirections(response);
                // me.map.controls[google.maps.ControlPosition.LEFT_CENTER].push(quotation_box);
                computeTotalDistance(me.directionsDisplay.getDirections());
                //showBlock();
                me.directionsDisplay.addListener('directions_changed', function() {
                    computeTotalDistance(me.directionsDisplay.getDirections());

                    //showBlock();
                });
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
};

function geoError() {
    alert("Geocoder failed.");
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(initMap, geoError);
        // alert("Geolocation is supported by this browser.");
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}
function computeTotalDistance(result) {
    var total = 0;
    var fare=0;
    var ori = result.routes[0].legs[0].start_address;
    var oriLat=result.routes[0].legs[0].start_location.lat();
    var oriLNg=result.routes[0].legs[0].start_location.lng();
    var des =result.routes[0].legs[0].end_address;
    var desLat=result.routes[0].legs[0].start_location.lat();
    var desLNg=result.routes[0].legs[0].start_location.lng();
    var duration = result.routes[0].legs[0].duration.text;
    var distance = result.routes[0].legs[0].distance.text;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    if(total<=2){
        fare=30;
    }
    else
    fare=30+(total-2)*5.5;

    console.log('Distance '+ total + ' km');
    console.log('Duration ' + duration );
    document.getElementById("Origin").innerHTML=ori;
    // document.getElementById("Origin_Lat").innerHTML=oriLat;
    // document.getElementById("Origin_Lng").innerHTML=oriLNg;
    document.getElementById("Destination").innerHTML=des;
    // document.getElementById("Destination_Lat").innerHTML=desLat;
    // document.getElementById("Destination_Lng").innerHTML=desLNg;
    document.getElementById("Duration").innerHTML=duration;
    document.getElementById("Fare").innerHTML=fare.toFixed(2);
        document.cookie = 'origin=' + ori;
        document.cookie = 'destination=' + des;
        document.cookie = 'duration=' + duration;
        document.cookie = 'distance=' + total;
    quotation_box.style.display="block";
}
