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

    <div id="orders_div" class="hidden w-1/3 h-fit absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-xl z-20">
        <div class="w-full bg-[#9ee4d7] px-6 py-2 rounded-tr-xl rounded-tl-xl">
            Order Details
        </div>
        <div class="w-full p-6 bg-white rounded-bl-xl rounded-br-xl">
            <div>
                <p id="rice_name" class="text-xl font-semibold uppercase">Jillian Rice</p>
            </div>
            <p id="rice_name" class="text-xl font-semibold uppercase">Jillian Rice</p>
            <p class="">Per sack: &#8369;<span id="price_sack"></span></p>
            <p class="mb-4">Per kg: &#8369;<span id="price_kg"></span></p>
            <div class="w-full border-b border-black"></div>
            <div class="mt-4">
                <form action="{{route('retailer.cart.add')}}" method="POST">
                    @csrf
                    <p class="text-sm font-semibold mb-4">Order Quantity:</p>
                    <div class="w-full flex items-center mb-4">
                        <p class="w-1/3">Select order type:</p>
                        <div class="w-2/3 flex items-center gap-4">
                            <div>
                                <label for="per_sack">
                                    <input type="radio" id="per_sack" name="measurement" value="per_sack" class="text-sm">
                                    Per Sack
                                </label>
                            </div>
                            <div>
                                <label for="per_kg">
                                    <input type="radio" id="per_kg" name="measurement" value="per_kg" class="text-sm">
                                    Per KG
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="count" class="hidden w-full gap-2 mb-6">
                        <p>How many sacks:</p>
                        <input type="text" name="sacks_count" value="0" class="w-16 border-b border-black outline-none text-center text-sm">
                    </div>
                    <div id="btn_div" class="hidden w-full justify-end">
                            <input id="rice_id" type="hidden" name="rice_id">
                            <input id="dealer_id" type="hidden" name="dealer_id">
                            <input type="hidden" name="user_id" value="{{ session('profile')->id }}">
                            <button type="submit" class="py-2 px-10 rounded-md bg-[#9ee4d7]">Add to Orders</button>
                    </div>
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
                <form action="{{ route('retailer.logout') }}" method="POST" class="pl-10">
                    @csrf  <!-- CSRF token for security -->
                    <button type="submit" class="py-2 w-full text-left flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                        <p>Logout</p>
                    </button>
                </form>
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
                    <p class="text-xl font-medium">Order History</p>
                </div>
                <hr>
                <div id="result_div" class="w-full flex flex-wrap gap-5 h-[90%] overflow-y-auto mt-10">
                    <div class="w-full">
                        <div class="w-full flex items-center px-2 py-2 mb-2 bg-[#3b5a54] text-white">
                            <p class="w-[25%]">Dealer</p>
                            <p class="w-[25%]">Rice</p>
                            <p class="w-[10%]">Order count</p>
                            <p class="w-[18%]">Total (&#8369;)</p>
                            <p class="w-[25%]">Delivered Date</p>
                            <div class="w-[7%]"></div>
                        </div>
                        @foreach ($orders as $order)
                            <div class="w-full flex items-center px-2 py-3 border-b border-[#3b5a54] text-black">
                                <p class="w-[25%]">{{ $order['dealer'] }}</p>
                                <p class="w-[25%]">{{ $order['rice_name'] }}</p>
                                <p class="w-[10%]">{{ $order['quantity'] }}</p>
                                <p class="w-[18%]">{{ $order['price'] }}</p>
                                <p class="w-[25%]">{{ $order['delivery_date'] }}</p>
                                <div class="w-[7%]">
                                    <button id="rate-btn" 
                                        data-rice="{{ $order['rice_name'] }}" 
                                        data-dealer="{{ $order['dealer'] }}" 
                                        data-orderID="{{ $order['orderID'] }}" 
                                        class="py-2 px-6 text-xs rounded-full bg-yellow-500 
                                            @if($order['rated'] == 'true') cursor-not-allowed bg-green-300 @endif"
                                            @if($order['rated'] == 'true') disabled @endif
                                        >
                                        @if($order['rated'] == 'true') 
                                            Rated
                                        @else 
                                            Rate
                                        @endif
                                    </button>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="rate" class="hidden w-1/5 h-auto p-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded lg bg-white z-20">
        <p class="mb-3">Rate:</p>
        <div class="w-full flex items-center justify-evenly gap-2">
            <button data-val="1" class="rate-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="45" height="45" fill="#eab308"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
            </button>
            <button data-val="2" class="rate-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="45" height="45" fill="#eab308"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
            </button>
            <button data-val="3" class="rate-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="45" height="45" fill="#eab308"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
            </button>
            <button data-val="4" class="rate-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="45" height="45" fill="#eab308"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
            </button>
            <button data-val="5" class="rate-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="45" height="45" fill="#eab308"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
            </button>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#acc-btn').on('click', function() {
                $('#drpdown').toggleClass('hidden')
                $('#drpdown').toggleClass('flex')
            })
            let riceName = '';
            let dealer = '';
            let orderID = '';

            // Handle rate button click
            $(document).on('click', '#rate-btn', function () {
                $('#rate').removeClass('hidden');
                $('#cover').removeClass('hidden');
                
                riceName = $(this).data('rice');
                dealer = $(this).data('dealer');
                orderID = $(this).data('orderid');
            });

            // Handle rating submission
            $(document).on('click', '.rate-btn', function(){
                let rate = $(this).data('val');

                $.ajax({
                    url: "{{ route('retailer.rate') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        rate: rate,
                        orderID: orderID,
                        rice: riceName,
                        dealer: dealer
                    },
                    success: function(response){
                        if (response.success) {
                            alert(response.message);
                            $('#rate').addClass('hidden');
                            $('#cover').addClass('hidden');
                        }
                    },
                    error: function(xhr, error){
                        console.error(error);
                        alert("Error submitting rating.");
                    }
                });

            });
        });

    </script>
</body>
</html>
