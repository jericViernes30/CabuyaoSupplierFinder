<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{asset('images/logo-2.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>
<body class="w-full h-screen relative overflow-hidden">
    <div id="cover" class="hidden w-full h-screen absolute top-0 bg-[#000000a6] z-10"></div>
    <div id="filter_div" class="hidden w-1/3 h-fit absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-xl z-20">
        <div class="w-full flex items-center justify-between bg-[#9ee4d7] px-6 py-2 rounded-tr-xl rounded-tl-xl">
            <p>Filter Items</p>
            <button class="" id="close_modal">x</button>
        </div>
        <div class="w-full px-6 py-4 bg-white rounded-br-xl rounded-bl-xl">
            <form id="filterForm">
                @csrf
                <strong>Price:</strong>
                <div class="w-full flex items-center justify-center gap-4 text-sm mx-auto mb-4 mt-2">
                    <div>
                        <p>From</p>
                        <input type="number" name="price_from" class="outline-none border border-gray-400 px-4 py-1 rounded-md">
                    </div>
                    <p>-</p>
                    <div>
                        <p>To</p>
                        <input type="number" name="price_to" class="outline-none border border-gray-400 px-4 py-1 rounded-md">
                    </div>
                </div>
                <hr>
            
                <strong>Location</strong>
                <div class="w-full flex items-center justify-center gap-4 mt-2">
                    <div>
                        <label>
                            <input type="radio" name="location_distance" value="10">
                            0-10km
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="location_distance" value="20">
                            11-20km
                        </label>
                    </div>
                </div>
            
                <input id="lat" type="hidden" name="lat" value="12.3456"> <!-- User's latitude -->
                <input id="long" type="hidden" name="long" value="78.9012"> <!-- User's longitude -->
            
                <button type="submit" class="bg-main w-full px-6 py-2 rounded-md mt-8">Filter</button>
            </form>
        </div>
    </div>

    <div id="orders_div" class="hidden shadow-lg w-1/3 h-fit absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-xl z-20">
        <div class="w-full bg-[#9ee4d7] px-6 py-2 rounded-tr-xl rounded-tl-xl">
            Order Details
        </div>
        <div class="w-full p-6 bg-white rounded-bl-xl rounded-br-xl">
            <div>
                <p id="rice_name" class="text-xl font-semibold uppercase">Jillian Rice</p>
            </div>
            <p class="mb-5">Per sack: &#8369;<span id="price_sack"></span></p>
            <div class="w-full border-b border-black"></div>
            <div class="mt-4">
                <form action="{{route('retailer.cart.add')}}" method="POST">
                    @csrf
                    <p class="text-sm font-semibold mb-4">Order Quantity:</p>
                    <div id="count" class="w-full gap-2 mb-6">
                        <p>How many sacks:</p>
                        <input type="text" name="sacks_count" value="1" class="w-16 border-b border-black outline-none text-center text-sm">
                    </div>
                    <div class="hidden w-full justify-end">
                        <input id="rice_id" type="hidden" name="rice_id">
                        <input id="dealer_id" type="hidden" name="dealer_id">
                        <input type="hidden" name="user_id" value="{{ session('profile')->id }}">
                    </div>
                    <button type="submit" class="py-2 px-10 rounded-md bg-[#9ee4d7]">Add to Orders</button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex h-full">
        <div class="w-[14%] border-r border-[#9ee4d7] h-full">
            <div class="w-full flex items-center justify-center py-16">
                <img src="{{asset('images/logo-2.png')}}" alt="" class="w-[25%]">
                <p class="text-2xl font-semibold">grainex</p>
            </div>
            <div class="w-full flex items-start flex-col text-left">
                <button onclick="window.location.href='{{route('retailer.dashboard')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="18" height="18"><path d="M36.8 192l566.3 0c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0L121.7 0c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224l0 160 0 80c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-80 0-160-64 0 0 160-192 0 0-160-64 0zm448 0l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32l0-256-64 0z"/></svg>
                    <p class="font-light">Marketplace</p>
                </button>
                <button onclick="window.location.href='{{route('retailer.cart')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="17" height="17"><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                    <p class="font-light">Cart</p>
                </button>
                <button onclick="window.location.href='{{route('retailer.order')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="17" height="17"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M384 96l0 128-128 0 0-128 128 0zm0 192l0 128-128 0 0-128 128 0zM192 224L64 224 64 96l128 0 0 128zM64 288l128 0 0 128L64 416l0-128zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32z"/></svg>
                    <p class="font-light">Orders</p>
                </button>
                <button onclick="window.location.href='{{route('retailer.history')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17"><path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z"/></svg>
                    <p class="font-light">History</p>
                </button>
                
            </div>
            {{-- <div>
                <p class="text-sm font-light">jericviernes06@gmail.com</p>
            </div> --}}
        </div>
        <div class="w-[86%] h-full">
            <div class="w-full flex items-center justify-between px-10 h-[10%]">
                <div class="w-fit flex justify-start items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#eed202" width="20" height="20"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>
                    <p class="text-orange-500 font-medium text-xs">Application under development, expect few bugs and unfinished features</p>
                </div>
                <div class="w-1/2 flex justify-end relative">
                    <div class="w-[25%] text-center">
                        @if(session('profile'))
                            <button id="acc-btn">Hi, {{ session('profile')->first_name }}</button>
                        @else
                            <button>Hi, Guest</button>
                        @endif
                    </div>
                    <div id="drpdown" class="absolute bg-[#ececec] text-sm w-[25%] -bottom-16 text-center rounded-md shadow-xl hidden flex-col gap-2">
                        <a href="{{route('retailer.profile')}}" class="py-1 hover:cursor-pointer hover:bg-main px-4">Profile</a>
                        <form action="{{ route('retailer.logout') }}" method="POST" class="py-1 hover:cursor-pointer hover:bg-main px-4">
                            @csrf  <!-- CSRF token for security -->
                            <button type="submit">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-full p-7 h-[90%]">
                <div class="w-full flex items-center justify-between mb-10">
                    <p class="text-xl font-medium">Marketplace</p>
                </div>
                <hr>
                <div class="w-1/2 flex gap-4 items-center mt-10">
                    <div class="w-1/2">
                        <input id="search" type="text" name="search" placeholder="Search for Rice, Quality or Dealer" class="outline-none border border-gray-400 rounded-md w-full px-4 py-2">
                    </div>
                    <div>
                        <span></span>
                        <button id="filter" type="button" class="px-6 bg-main py-2 rounded-md border border-main">Filter</button>
                    </div>
                    <div class="w-fit flex gap-2 items-center">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#eed202" width="20" height="20"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg> --}}
                        {{-- <p class="text-yellow-500 font-medium text-xs">Filter's under development</p> --}}
                    </div>
                </div>
                <div id="result_div" class="w-full flex flex-wrap gap-5 h-[90%] overflow-y-auto mt-10">
                    @foreach ($rice as $r)
                        <button class="rice-button w-1/5 h-fit shadow-md"
                            data-id="{{$r->id}}"
                            data-name="{{ $r->name }}" 
                            data-per-sack="{{ $r->per_sack }}" 
                            data-per-kg="{{ $r->per_kg }}"
                            data-dealer="{{ $r->dealer }}"
                        >
                            <div class="w-full bg-[#e7e5e5] p-5 rounded-tl-lg rounded-tr-lg">
                                <img src="{{ asset('images/' . $r->image_name . '.png') }}" alt="" class="w-1/2 block mx-auto">
                            </div>
                            <div class="w-full bg-white p-5 rounded-bl-lg rounded-br-lg text-left hover:bg-[#bae6de] transition duration-100 ease-in-out">
                                <div class="w-full flex justify-between items-center mb-2">
                                    <p id="name" class="text-left text-[#383737] text-sm font-semibold uppercase">{{ $r->name }}</p>
                                    <p class=" font-medium flex items-center">
                                        <span class="text-yellow-500 "> {{$r->final_rate}}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="14" height="14" fill="#eab308"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                    </p>
                                </div>
                                <div class="w-full flex gap-10 items-center">
                                    <div class="w-1/2">
                                        <p class="text-xs">Per sack</p>
                                        <p class="text-2xl mb-2">&#8369;<span id="per_sack">{{$r->per_sack}}</span>.00</p>
                                    </div>
                                    <div class="w-1/2">
                                        <p class="text-xs">Sacks left</p>
                                        <p class="text-2xl mb-2"><span id="per_kg">{{$r->quantity}}</span></p>
                                    </div>
                                </div>
                                <p class="text-xs uppercase font-medium pb-3 border-b border-[#b3b0b0]">{{$r->quality}}</p>
                                <p class="mt-3 text-xs mb-1">Dealer:</p>
                                <p class="text-md uppercase font-medium">{{$r->dealer}}</p>
                                <p class="text-xs text-[#383737] mb-1">{{$r->address}}</p>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#acc-btn').on('click', function() {
                $('#drpdown').toggleClass('hidden')
                $('#drpdown').toggleClass('flex')
            })

            $('#filter').on('click', function(){
                $('#filter_div').removeClass('hidden')
                $('#cover').removeClass('hidden')
            })
            $('#close_modal').on('click', function(){
                $('#filter_div').addClass('hidden')
                $('#cover').addClass('hidden')
            })
            // Set the CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Get CSRF token from meta tag
                }
            });

            // Handle form submission with AJAX
            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                var locationDistance = $('input[name="location_distance"]:checked').val();
                var priceFrom = $('input[name="price_from"]').val();
                var priceTo = $('input[name="price_to"]').val();
                var userLat = $('#lat').val();
                var userLon = $('#long').val();

                console.log(priceFrom)

                // AJAX request to filter rice items based on location and price
                $.ajax({
                    url: '{{ route('retailer.distance') }}',  // Route to the controller function
                    type: 'POST',
                    data: {
                        location_distance: locationDistance,
                        price_from: priceFrom,
                        price_to: priceTo,
                        lat: userLat,
                        long: userLon
                    },
                    dataType: 'json',
                    success: function(response) {
    console.log("Response received:", response);

    // Ensure riceItems is an array
    let riceItems = Object.values(response.riceItems);

    console.log("Rice items after conversion:", riceItems);

    if (riceItems.length > 0) {
        $('#result_div').empty(); // Clear previous results

        riceItems.forEach(function(item) {
            var riceButton = `
                <button class="rice-button w-1/5 h-fit shadow-md"
                    data-id="${item.id}"
                    data-name="${item.name}"
                    data-per-sack="${item.per_sack}"
                    data-per-kg="${item.per_kg}">
                    <div class="w-full bg-[#e7e5e5] p-5 rounded-tl-lg rounded-tr-lg">
                        <img src="{{ asset('images/${item.image_name}.png') }}" alt="" class="w-1/2 block mx-auto">
                    </div>
                    <div class="w-full bg-white p-5 rounded-bl-lg rounded-br-lg text-left hover:bg-[#bae6de] transition duration-100 ease-in-out">
                        <div class="w-full flex justify-between items-center mb-2">
                            <p id="name" class="text-left text-[#383737] text-sm font-semibold uppercase">${item.name}</p>
                            <p class="font-medium flex items-center">
                                <span class="text-yellow-500 ">${item.final_rate}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="14" height="14" fill="#eab308">
                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                </svg>
                            </p>
                        </div>
                        <div class="w-full flex gap-10 items-center">
                            <div class="w-1/2">
                                <p class="text-xs">Per sack</p>
                                <p class="text-2xl mb-2">&#8369;<span id="per_sack">${item.per_sack}</span>.00</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-xs">Sacks left</p>
                                <p class="text-2xl mb-2"><span id="per_kg">${item.quantity}</span></p>
                            </div>
                        </div>
                        <p class="text-xs uppercase font-medium pb-3 border-b border-[#b3b0b0]">${item.quality}</p>
                        <p class="mt-3 text-xs mb-1">Dealer:</p>
                        <p class="text-md uppercase font-medium">${item.dealer ? item.dealer : 'Dealer info not available'}</p>
                        <p class="text-xs text-[#383737]">${item.address}</p>
                    </div>
                </button>
            `;

            // Append to the result div
            $('#result_div').append(riceButton);
        });
    } else {
        $('#result_div').append('<p class="text-center text-gray-500">No rice items found in your selected range.</p>');
    }
},


                    error: function(xhr, status, error) {
                        console.error("AJAX error: " + status + ", " + error);
                    }
                });
            });
            
            // Handle button click to update order details and unhide the orders div
            $('.rice-button').click(function() {
                $('#orders_div').removeClass('hidden');
                // Get data attributes from the clicked button
                var name = $(this).data('name');
                var perSack = $(this).data('per-sack');
                var perKg = $(this).data('per-kg');
                var address = $(this).data('address');
                var quality = $(this).data('quality');
                var dealer = $(this).data('dealer');
                var riceID = $(this).data('id')
                // alert(dealer)

                $('#rice_id').val(riceID);
                $('#dealer_id').val(dealer);
                // Update the order details div
                $('#rice_name').text(name);
                $('#price_sack').text(perSack + '.00');
                $('#price_kg').text(perKg + '.00');

                // Optionally, you can also update other fields if needed
                $('#per_sack').prop('checked', false);  // Uncheck checkboxes by default
                $('#per_kg').prop('checked', false);

                // Unhide the #orders_div by changing its display property
            });

            // Monitor checkbox selection
            $('input[type="radio"]').change(function() {
                // If any checkbox is checked, show #count
                if ($('#per_sack').prop('checked') || $('#per_kg').prop('checked')) {
                    $('#count').removeClass('hidden');
                    $('#count').addClass('flex');
                } else {
                    $('#count').addClass('hidden');
                    $('#btn_div').addClass('hidden'); // Hide the button div if no checkbox is selected
                }
            });

            $('#search').on('keyup', function () {
                let query = $(this).val();
                
                $.ajax({
                    url: "{{ route('rice.livesearch') }}",
                    type: "GET",
                    data: { 'search': query },
                    success: function (data) {
                        let resultHtml = '';

                        if (data.length > 0) {
                            data.forEach(function (rice) {
                                resultHtml += `
                                    <button class="rice-button w-1/5 h-fit shadow-md"
                                    data-id="${rice.id}"
                                    data-name="${rice.name}"
                                    data-per-sack="${rice.per_sack}"
                                    data-per-kg="${rice.per_kg}">
                                    <div class="w-full bg-[#e7e5e5] p-5 rounded-tl-lg rounded-tr-lg">
                                        <img src="{{ asset('images/${rice.image_name}.png') }}" alt="" class="w-1/2 block mx-auto">
                                    </div>
                                    <div class="w-full bg-white p-5 rounded-bl-lg rounded-br-lg text-left hover:bg-[#bae6de] transition duration-100 ease-in-out">
                                        <div class="w-full flex justify-between items-center mb-2">
                                            <p id="name" class="text-left text-[#383737] text-sm font-semibold uppercase">${rice.name}</p>
                                            <p class="font-medium flex items-center">
                                                <span class="text-yellow-500 ">${rice.final_rate}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="14" height="14" fill="#eab308">
                                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                                </svg>
                                            </p>
                                        </div>
                                        <div class="w-full flex gap-10 items-center">
                                            <div class="w-1/2">
                                                <p class="text-xs">Per sack</p>
                                                <p class="text-2xl mb-2">&#8369;<span id="per_sack">${rice.per_sack}</span>.00</p>
                                            </div>
                                            <div class="w-1/2">
                                                <p class="text-xs">Sacks left</p>
                                                <p class="text-2xl mb-2"><span id="per_kg">${rice.quantity}</span></p>
                                            </div>
                                        </div>
                                        <p class="text-xs uppercase font-medium pb-3 border-b border-[#b3b0b0]">${rice.quality}</p>
                                        <p class="mt-3 text-xs mb-1">Dealer:</p>
                                        <p class="text-md uppercase font-medium">${rice.dealer ? rice.dealer : 'Dealer info not available'}</p>
                                        <p class="text-xs text-[#383737]">${rice.address}</p>
                                    </div>
                                </button>`;
                            });
                        } else {
                            resultHtml = '<p class="text-center w-full">No results found.</p>';
                        }

                        $('#result_div').html(resultHtml);
                    },
                    error: function () {
                        $('#result_div').html('<p class="text-center w-full">Error fetching results.</p>');
                    }
                });
            });
            // Function to handle geolocation
            function onLocationFound(e) {
            var lat = e.coords.latitude;
            var lng = e.coords.longitude;
            console.log("User's latitude: " + lat);
            console.log("User's longitude: " + lng);
            $('#lat').val(lat)
            $('#long').val(lng)
            }

            // Function to handle geolocation errors
            function onLocationError(e) {
            console.log("Geolocation failed: " + e.message);
            }

            // Try to get the user's location when the page loads
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
            } else {
            console.log("Geolocation is not supported by this browser.");
            }
        });
    </script>
</body>
</html>
