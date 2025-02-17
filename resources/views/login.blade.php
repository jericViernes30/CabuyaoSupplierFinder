<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="shortcut icon" href="{{asset('images/logo-2.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>GrainEx | Login</title>
    <style>
        #map { height: 400px; width: 100%; }
        #coordinates { margin-top: 10px; }
    </style>
</head>
<body class="h-screen relative overflow-y-hidden overflow-x-hidden">
    {{-- bg --}}
    <div class="w-[800px] h-[800px] bg-red-500 opacity-5 rounded-full blur-3xl absolute -top-[20%] -left-[10%] z-0"></div>
    <div class="w-[600px] h-[600px] bg-blue-500 opacity-5 rounded-full blur-3xl absolute -top-[20%] left-[30%] z-0"></div>
    <div class="w-[800px] h-[800px] bg-green-500 opacity-5 rounded-full blur-3xl absolute -top-[20%] -right-[10%] z-0"></div>
    <div class="w-[700px] h-[700px] bg-yellow-500 opacity-5 rounded-full blur-3xl absolute -bottom-[30%] right-[25%] z-0"></div>
    <div class="w-[600px] h-[600px] bg-orange-500 opacity-5 rounded-full blur-3xl absolute -bottom-[30%] -left-[5%] z-0"></div>
    <div class="w-[600px] h-[600px] bg-blue-500 opacity-5 rounded-full blur-3xl absolute -bottom-[30%] -right-[20%] z-0"></div>
    <div class="w-full flex items-center justify-center bg-transparent h-full">
        {{-- signup --}}
        <div class="w-1/3 bg-white drop-shadow-xl rounded-2xl py-7 px-10">
            <div class="w-full flex items-center justify-center mb-5">
                <img src="{{asset('images/logo-2.png')}}" alt="" class="w-[15%]">
                <p class="text-2xl font-semibold">grainex</p>
            </div>
            <p class="text-2xl">Retailer Login</p>
            <p class="text-xs text-[#8f8f8f] mb-5">Enter your login credentials below to proceed.</p>
            <form action="{{route('retailer.auth')}}" method="POST" class="w-full text-sm">
                @csrf
                <div class="w-full flex flex-col mb-5">
                    <label for="">Email Address</label>
                    <input type="email" name="email_address" class="outline-none border border-[#cccbcb] rounded-md p-2">
                </div>
                <div class="w-full flex flex-col mb-5">
                    <label for="" class="">Password</label>
                    <div class="w-full relative">
                        <input id="password" type="password" name="password" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="15" height="15"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="w-full flex gap-5 justify-end">
                    <button type="submit" class="w-full bg-[#9ee4d7] rounded-md py-2 border text-[#252525] disabled hover:disable">Login</button>
                </div>
            </form>
            <p class="text-sm text-center mt-6">Don't have an account? <a href="{{route('signup')}}" class="text-sm underline">Sign Up</a></p>
            <a href="{{route('dealer.login')}}" class="text-sm text-center mt-2 text-[#3b5a54] block mx-auto">Login as Dealer</a>
        </div>
        {{-- <h3>Click on the map to select a location</h3>
        <div id="map"></div>
        <div id="coordinates">Latitude: <span id="lat"></span>, Longitude: <span id="lng"></span></div> --}}

        {{-- <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> --}}
    </div>
    <script>
        $(document).ready(function(){
            $('#continue').on('click', function(e){
                e.preventDefault();
                
                alert('Button is clicked');
            })

            $('#cancel').on('click', function(c){
                c.preventDefault()
                window.location.href='/'
            })

            $('#togglePassword').on('click', function(b){
                b.preventDefault();
                var passwordField = $('#password')
                var type = passwordField.attr('type') === 'password' ? 'text' : 'password'
                passwordField.attr('type', type)
            })

             // Initialize map, centered at a default location with a specified zoom level
        var map = L.map('map').setView([14.5995, 120.9842], 13);

// Add a tile layer to the map (from OpenStreetMap)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

// Initialize a marker variable to hold the selected location
var marker;

// Add click event listener on the map
map.on('click', function(e) {
    // Get latitude and longitude from the click event
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;

    // Update the coordinates display
    document.getElementById('lat').textContent = lat.toFixed(6);
    document.getElementById('lng').textContent = lng.toFixed(6);

    // Alert the latitude and longitude
    alert("Selected Location:\nLatitude: " + lat.toFixed(6) + "\nLongitude: " + lng.toFixed(6));

    // If a marker already exists, remove it
    if (marker) {
        map.removeLayer(marker);
    }

    // Add a new marker at the clicked location
    marker = L.marker([lat, lng]).addTo(map)
            .bindPopup("Selected Location:<br>Latitude: " + lat.toFixed(6) + "<br>Longitude: " + lng.toFixed(6))
            .openPopup();
});

// Add geocoding search control
var geocoder = L.Control.geocoder({
    collapsed: false, // Keep the search bar expanded
    position: 'topright' // Position the search bar in the top-right corner
}).addTo(map);

// Add an event to handle geocode results (moving the map and adding a marker)
geocoder.on('markgeocode', function(e) {
    var latlng = e.geocode.center;
    // Move the map to the new location
    map.setView(latlng, 13);
    // Add a marker to the new location
    if (marker) {
        map.removeLayer(marker); // Remove existing marker before adding the new one
    }
    marker = L.marker(latlng).addTo(map)
                .bindPopup(e.geocode.name)
                .openPopup();

    // Update the coordinates display
    document.getElementById('lat').textContent = latlng.lat.toFixed(6);
    document.getElementById('lng').textContent = latlng.lng.toFixed(6);
});
        })


    </script>
</body>
</html>