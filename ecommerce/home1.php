<!-- <html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Map using Leaflet</title>
    <link rel="stylesheet" href="leaflet/leaflet.css">
    <style>
        #map{
            width:100%;
            height:100vh;
        }
    </style>
</head>

<body>
    <div id="map"></div>
</body>
</html>

<script src="leaflet/leaflet.js"></script>
<script>
L.geoJSON(states, {
    style: function(feature) {
        switch (feature.properties.party) {
            case 'Republican': return {color: "#ff0000"};
            case 'Democrat':   return {color: "#0000ff"};
        }
    }
}).addTo(map);
    var map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('geoJSON', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

    L.marker([72.00, 58.00]).addTo(map)
    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
    .openPopup();

var states = [{
    "type": "Feature",
    "properties": {"party": "Republican"},
    "geometry": {
        "type": "Polygon",
        "coordinates": [[
            [-104.05, 48.99],
            [-97.22,  48.98],
            [-96.58,  45.94],
            [-104.03, 45.94],
            [-104.05, 48.99]
        ]]
    }
}, {
    "type": "Feature",
    "properties": {"party": "Democrat"},
    "geometry": {
        "type": "Polygon",
        "coordinates": [[
            [-109.05, 41.00],
            [-102.06, 40.99],
            [-102.03, 36.99],
            [-109.04, 36.99],
            [-109.05, 41.00]
        ]]
    }
}];

L.geoJSON(states, {
    style: function(feature) {
        switch (feature.properties.party) {
            case 'Republican': return {color: "#ff0000"};
            case 'Democrat':   return {color: "#0000ff"};
        }
    }
}).addTo(map);
 </script> -->


<?php
// include 'includes/session.php';

// $conn = $pdo->open();

//   $stmt = $conn->prepare("SELECT * FROM sales order by id desc");
//   $stmt->execute();
//   $row = $stmt->fetch();
//   $curqty=$row['id'];
//   echo $curqty;
?>