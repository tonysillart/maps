<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        #map {
            height: 100%;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<form action="saveform.php" method="post">
    <input name="name" placeholder="Add name"><br>
    <input name="description" placeholder="Add description"><br>
    <input name="latitude" id="lat" placeholder="Add latitude"><br>
    <input name="longitude" id="lng" placeholder="Add latitude"><br>
    <button name="action" value="save">Save</button>
</form>
<div id="map"></div>
<script>
    var map;

    function createMarker(data) {

        console.log(data);

        var content = '<form action="editmarker.php" method="post">' +
            '<p>Name: </p>' +
            '<input type="text" id="name" name="name" value=' + data.name +'><br>' +
            '<p>Description: </p>' +
            '<input type="text" id="description" name="description" value=' + data.description +'><br>' +
            '<p>Latitude: </p>' +
            '<input type="text" id="latitude" name="latitude" value=' + data.lat +'><br>' +
            '<p>Longitude: </p>' +
            '<input type="text" id="longitude" name="longitude" value=' + data.lng +'><br>' +
            '<br>' +
            '<input type="hidden" name="id" value=' + data.id + '/>' +
            '<input type="submit" name="update" value="update" >' +
            '<input type="submit" name="delete" value="delete" >' +
            '</form>';


        var infowindow = new google.maps.InfoWindow({
            content: content
        });

        var marker = new google.maps.Marker({
            position: data,
            map: map,
            title: 'Test3232'
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
            map.setCenter(marker.getPosition());
        });
    }

    function initMap() {

        fetch('getmarker.php')
            .then(function(response){
                return response.json();
            })
            .then(function(data) {
                for (k in data) {
                    console.log(data[k]);
                    createMarker(data[k]);
                }
            })
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });

        var start = {lat: 58.232693, lng: 22.503854};

        map = new google.maps.Map(document.getElementById('map'), {
            center: start,
            zoom: 8
        });

        map.addListener('click', function(e) {

            console.log(e.latLng.lat())
            console.log(e.latLng.lng())

            var location = {lat: e.latLng.lat(), lng: e.latLng.lng()}
            createMarker(location);
            document.getElementById('lat').value = e.latLng.lat();
            document.getElementById('lng').value = e.latLng.lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>
</body>
</html>