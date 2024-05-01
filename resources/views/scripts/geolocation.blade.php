<script>

    function getGeoLocationForLeaflet() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition,
                err => {
                    console.log(err.message)
                    fetch('http://ip-api.com/json')
                        .then(results => results.json())
                        .then(data => {

                                locationPicker(data.lat + ',' + data.lon)
                                flash('موقعیت مکانی شما با موفقیت دریافت شد', 'info')
                            }
                        );
                }
            );
        } else {

            fetch('http://ip-api.com/json')
                .then(results => results.json())
                .then(data => {

                        locationPicker(data.lat + ',' + data.lon)
                        flash('موقعیت مکانی شما با موفقیت دریافت شد', 'info')
                    }
                );
        }
    }

    function showPosition(position) {
        locationPicker(position.coords.latitude + ',' + position.coords.longitude)
        flash('موقعیت مکانی شما با موفقیت دریافت شد', 'info')
    }
</script>
