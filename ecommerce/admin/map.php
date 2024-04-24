<?php 
  include 'includes/session.php';
  include 'includes/format.php'; 
?>
<?php 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

  $conn = $pdo->open();
?>
<?php include 'includes/header.php'; ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="../map/css/leaflet.css"><link rel="stylesheet" href="../map/css/L.Control.Locate.min.css">
        <link rel="stylesheet" href="../map/css/qgis2web.css"><link rel="stylesheet" href="../map/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../map/css/leaflet-control-geocoder.Geocoder.css">
        <link rel="stylesheet" href="../map/css/leaflet-measure.css">
        <style>
        #map {
            width: 1887px;
            height: 1215px;
        }
        </style>
        <title></title>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <div id="map">
        </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </div>
        <script src="../map/js/qgis2web_expressions.js"></script>
        <script src="../map/js/leaflet.js"></script><script src="../map/js/L.Control.Locate.min.js"></script>
        <script src="../map/js/leaflet.rotatedMarker.js"></script>
        <script src="../map/js/leaflet.pattern.js"></script>
        <script src="../map/js/leaflet-hash.js"></script>
        <script src="../map/js/Autolinker.min.js"></script>
        <script src="../map/js/rbush.min.js"></script>
        <script src="../map/js/labelgun.min.js"></script>
        <script src="../map/js/labels.js"></script>
        <script src="../map/js/leaflet-control-geocoder.Geocoder.js"></script>
        <script src="../map/js/leaflet-measure.js"></script>
        <script src="../map/data/INDIA_STATE_BOUNDARY_PROJ_UPDATED_0.js"></script>
        <script src="../map/data/palce_cordinates_1.js"></script>
        <script src="../map/data/palce_cordinates_1_2.js"></script>
        <script>
        var highlightLayer;
        function highlightFeature(e) {
            highlightLayer = e.target;

            if (e.target.feature.geometry.type === 'LineString') {
              highlightLayer.setStyle({
                color: '#ffff00',
              });
            } else {
              highlightLayer.setStyle({
                fillColor: '#ffff00',
                fillOpacity: 1
              });
            }
            highlightLayer.openPopup();
        }
        var map = L.map('map', {
            zoomControl:true, maxZoom:28, minZoom:2
        }).fitBounds([[5.781902867349263,55.96819978980926],[39.11191444935129,107.76298283356346]]);
        var hash = new L.Hash(map);
        map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
        var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
        L.control.locate({locateOptions: {maxZoom: 19}}).addTo(map);
        var measureControl = new L.Control.Measure({
            position: 'topleft',
            primaryLengthUnit: 'feet',
            secondaryLengthUnit: 'miles',
            primaryAreaUnit: 'sqfeet',
            secondaryAreaUnit: 'sqmiles'
        });
        measureControl.addTo(map);
        document.getElementsByClassName('leaflet-control-measure-toggle')[0]
        .innerHTML = '';
        document.getElementsByClassName('leaflet-control-measure-toggle')[0]
        .className += ' fas fa-ruler';
        var bounds_group = new L.featureGroup([]);
        function setBounds() {
            map.setMaxBounds(map.getBounds());
        }
        function pop_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    for (i in e.target._eventParents) {
                        e.target._eventParents[i].resetStyle(e.target);
                    }
                    if (typeof layer.closePopup == 'function') {
                        layer.closePopup();
                    } else {
                        layer.eachLayer(function(feature){
                            feature.closePopup()
                        });
                    }
                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">OBJECTID</th>\
                        <td>' + (feature.properties['OBJECTID'] !== null ? autolinker.link(feature.properties['OBJECTID'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">STATE</th>\
                        <td>' + (feature.properties['STATE'] !== null ? autolinker.link(feature.properties['STATE'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">AREA</th>\
                        <td>' + (feature.properties['AREA'] !== null ? autolinker.link(feature.properties['AREA'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">ST_CODE</th>\
                        <td>' + (feature.properties['ST_CODE'] !== null ? autolinker.link(feature.properties['ST_CODE'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Shape_Leng</th>\
                        <td>' + (feature.properties['Shape_Leng'] !== null ? autolinker.link(feature.properties['Shape_Leng'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Shape_Area</th>\
                        <td>' + (feature.properties['Shape_Area'] !== null ? autolinker.link(feature.properties['Shape_Area'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0_0() {
            return {
                pane: 'pane_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0',
                opacity: 1,
                color: 'rgba(35,35,35,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1.0, 
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(190,178,151,1.0)',
                interactive: true,
            }
        }
        map.createPane('pane_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0');
        map.getPane('pane_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0').style.zIndex = 400;
        map.getPane('pane_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0').style['mix-blend-mode'] = 'normal';
        var layer_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0 = new L.geoJson(json_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0, {
            attribution: '',
            interactive: true,
            dataVar: 'json_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0',
            layerName: 'layer_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0',
            pane: 'pane_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0',
            onEachFeature: pop_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0,
            style: style_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0_0,
        });
        bounds_group.addLayer(layer_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0);
        map.addLayer(layer_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0);
        function pop_palce_cordinates_1(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    for (i in e.target._eventParents) {
                        e.target._eventParents[i].resetStyle(e.target);
                    }
                    if (typeof layer.closePopup == 'function') {
                        layer.closePopup();
                    } else {
                        layer.eachLayer(function(feature){
                            feature.closePopup()
                        });
                    }
                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['place'] !== null ? autolinker.link(feature.properties['place'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['lattitude'] !== null ? autolinker.link(feature.properties['lattitude'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['longitude'] !== null ? autolinker.link(feature.properties['longitude'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['User type'] !== null ? autolinker.link(feature.properties['User type'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_palce_cordinates_1_0() {
            return {
                pane: 'pane_palce_cordinates_1',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(35,35,35,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(232,113,141,1.0)',
                interactive: true,
            }
        }
        map.createPane('pane_palce_cordinates_1');
        map.getPane('pane_palce_cordinates_1').style.zIndex = 401;
        map.getPane('pane_palce_cordinates_1').style['mix-blend-mode'] = 'normal';
        var layer_palce_cordinates_1 = new L.geoJson(json_palce_cordinates_1, {
            attribution: '',
            interactive: true,
            dataVar: 'json_palce_cordinates_1',
            layerName: 'layer_palce_cordinates_1',
            pane: 'pane_palce_cordinates_1',
            onEachFeature: pop_palce_cordinates_1,
            pointToLayer: function (feature, latlng) {
                var context = {
                    feature: feature,
                    variables: {}
                };
                return L.circleMarker(latlng, style_palce_cordinates_1_0(feature));
            },
        });
        bounds_group.addLayer(layer_palce_cordinates_1);
        map.addLayer(layer_palce_cordinates_1);
        function pop_palce_cordinates_1_2(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    for (i in e.target._eventParents) {
                        e.target._eventParents[i].resetStyle(e.target);
                    }
                    if (typeof layer.closePopup == 'function') {
                        layer.closePopup();
                    } else {
                        layer.eachLayer(function(feature){
                            feature.closePopup()
                        });
                    }
                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['place'] !== null ? autolinker.link(feature.properties['place'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['lattitude'] !== null ? autolinker.link(feature.properties['lattitude'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['longitude'] !== null ? autolinker.link(feature.properties['longitude'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['User type'] !== null ? autolinker.link(feature.properties['User type'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_palce_cordinates_1_2_0() {
            return {
                pane: 'pane_palce_cordinates_1_2',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(35,35,35,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(255,158,23,1.0)',
                interactive: true,
            }
        }
        map.createPane('pane_palce_cordinates_1_2');
        map.getPane('pane_palce_cordinates_1_2').style.zIndex = 402;
        map.getPane('pane_palce_cordinates_1_2').style['mix-blend-mode'] = 'normal';
        var layer_palce_cordinates_1_2 = new L.geoJson(json_palce_cordinates_1_2, {
            attribution: '',
            interactive: true,
            dataVar: 'json_palce_cordinates_1_2',
            layerName: 'layer_palce_cordinates_1_2',
            pane: 'pane_palce_cordinates_1_2',
            onEachFeature: pop_palce_cordinates_1_2,
            pointToLayer: function (feature, latlng) {
                var context = {
                    feature: feature,
                    variables: {}
                };
                return L.circleMarker(latlng, style_palce_cordinates_1_2_0(feature));
            },
        });
        bounds_group.addLayer(layer_palce_cordinates_1_2);
        map.addLayer(layer_palce_cordinates_1_2);
        var osmGeocoder = new L.Control.Geocoder({
            collapsed: true,
            position: 'topleft',
            text: 'Search',
            title: 'Testing'
        }).addTo(map);
        document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        .className += ' fa fa-search';
        document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        .title += 'Search for a place';
        var baseMaps = {};
        L.control.layers(baseMaps,{'<img src="legend/palce_cordinates_1_2.png" /> palce_cordinates_1': layer_palce_cordinates_1_2,'<img src="legend/palce_cordinates_1.png" /> palce_cordinates': layer_palce_cordinates_1,'<img src="legend/INDIA_STATE_BOUNDARY_PROJ_UPDATED_0.png" /> INDIA_STATE_BOUNDARY_PROJ_UPDATED': layer_INDIA_STATE_BOUNDARY_PROJ_UPDATED_0,}).addTo(map);
        setBounds();
        var i = 0;
        layer_palce_cordinates_1.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['User type'] !== null?String('<div style="color: #000000; font-size: 10pt; font-family: \'MS Shell Dlg 2\', sans-serif;">' + layer.feature.properties['User type']) + '</div>':''), {permanent: true, offset: [-0, -16], className: 'css_palce_cordinates_1'});
            labels.push(layer);
            totalMarkers += 1;
              layer.added = true;
              addLabel(layer, i);
              i++;
        });
        var i = 0;
        layer_palce_cordinates_1_2.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['User type'] !== null?String('<div style="color: #000000; font-size: 10pt; font-family: \'MS Shell Dlg 2\', sans-serif;">' + layer.feature.properties['User type']) + '</div>':''), {permanent: true, offset: [-0, -16], className: 'css_palce_cordinates_1_2'});
            labels.push(layer);
            totalMarkers += 1;
              layer.added = true;
              addLabel(layer, i);
              i++;
        });
        resetLabels([layer_palce_cordinates_1,layer_palce_cordinates_1_2]);
        map.on("zoomend", function(){
            resetLabels([layer_palce_cordinates_1,layer_palce_cordinates_1_2]);
        });
        map.on("layeradd", function(){
            resetLabels([layer_palce_cordinates_1,layer_palce_cordinates_1_2]);
        });
        map.on("layerremove", function(){
            resetLabels([layer_palce_cordinates_1,layer_palce_cordinates_1_2]);
        });
        </script>
    </body>
</html>