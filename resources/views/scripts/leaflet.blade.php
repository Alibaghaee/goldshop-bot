<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>

<script src="{{asset('leaflet-location-picker/src/leaflet-locationpicker.js')}}"></script>

<script>
    $('.input_map_leaflet').leafletLocationPicker({
        alwaysOpen: true,
        mapContainer: ".mapContainer",
        locationMarker: true,
        onChangeLocation: function (e) {
            locationPicker(e.location)
        },


        'map': {
            'zoom': 15,
            'zoomControl': false,
            'dragging': true,

        },

    });


</script>
