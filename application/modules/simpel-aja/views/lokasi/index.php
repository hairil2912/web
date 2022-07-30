<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div id="map" style="width:100%;height:670px;"></div>
            </div>
        </div>
    </section>
</div>

<div class="control-sidebar-bg"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwdshTh6kgL7OvyyoaFbQVzQC4jmqzNro&callback=initMap" async defer></script>

<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }
</script>
