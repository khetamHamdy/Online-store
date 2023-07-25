@extends('layout.adminLayout')
@section('title')
    {{ucwords(__('cp.orders'))}}
@endsection
@section('css')
<style >
        /*
        * Always set the map height explicitly to define the size of the div element
        * that contains the map.
        */
        #map {
        height: 100%;
        }

        /*
        * Optional: Makes the sample page fill the window.
        */
        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }
</style>
@endsection
@section('content')
<div id="map88"></div>
@endsection
@section('js')
 <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

   <script>
     var map, marker;
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dc834b009355f8a65f0b', {
      cluster: 'mt1',
      channelAuthorization: {
                endpoint: "/broadcasting/auth",
                headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}"
                }
            }
    });

    var channel = pusher.subscribe('private-deliveries.{{ $order->id }}');
    channel.bind('location-updated', function(data) {
      alert(JSON.stringify(data));
      marker.setPosition({
                lat: Number(data.lat),
                lng: Number(data.lng)
            });
    });
  </script>

 <script>
        // Initialize and add the map
        function initMap() {
            // The location of Delivery
            const location = {
                lat: Number("{{ $delivery->lat }}"),
                lng: Number("{{ $delivery->lng }}")
            };
            // The map, centered at Uluru
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            // The marker, positioned at Uluru
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }
        window.initMap = initMap;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&callback=initMap&v=weekly" defer></script>
@endsection

@section('script')

@endsection
