
<div class="card">
    <div class="card-body">
        
        <div class="d-flex"> 

            @foreach ($categories as $data)
                <div  class="category-text" style="margin: 10px 15px 10px 5px;">
                    <input type="checkbox" class="marker-checkbox" data-category="{{$data->category}}"  data-lat="{{$data->latitude}}" data-lng="{{$data->longitude}}" checked  style="margin-right: 5px;">
                    {{ $data->category }}
                </div>
            @endforeach
        </div>

    <div id="map" style="width: 100%; height: 275px;"></div>

    </div>
</div>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxgkHPsr2kCn9TAnr73czj-ph2mvj9dbo"  defer></script>



<script type="text/javascript">
    $(document).ready(function () {
        var map;
        var markers = [];

            $.ajax({
                url: '/business-profiles-map',
                type: 'GET',
                success: function (response) {
                    initMap(response.dataForMap);
                
                }
            });
       




        function initMap(dataForMap) {
            
            map = new google.maps.Map(
                document.getElementById("map"),
                {
                    zoom: 2,
                    center: { lat: 51.5072, lng: 0.1276 }
                }
            );

            dataForMap.forEach(function (row){
                var marker= new google.maps.Marker({
                    position: { lat: parseFloat(row.latitude), lng: parseFloat(row.longitude) },
                    map: map,
                    label: {
                        color: 'white',
                        fontWeight: 'bold',
                        text: row.name
                    }
                });
                markers.push(marker);
            });

            $(document).on('change', '.marker-checkbox', function () {
                var lat = parseFloat($(this).data('lat'));
                var lng = parseFloat($(this).data('lng'));
                var category = $(this).data('category');


                if ($(this).prop('checked')) {
                    var marker = new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        label: {
                            color: 'white',
                            fontWeight: 'bold',
                            text: category
                        }
                    });

                    markers.push(marker);
                } else {
                    for (var i = 0; i < markers.length; i++) {
                        if (markers[i].getPosition().lat() === lat && markers[i].getPosition().lng() === lng) {
                            markers[i].setMap(null);
                            markers.splice(i, 1);
                            break;
                        }
                    }
                }
            });
        }

    });
</script>


