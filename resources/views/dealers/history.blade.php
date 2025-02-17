<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{asset('images/logo-2.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>
<body class="w-full h-screen bg-white-v2">
    <script>
        console.log(@json(session()->all()));
    </script>
    <div class="flex h-full">
        @include('components.sidebar')
        <div class="w-[86%] h-full">
            <div class="w-full flex items-center justify-between px-6 h-[10%]">
                <div class="w-fit flex justify-start items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#eed202" width="20" height="20"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>
                    <p class="text-orange-500 font-medium text-xs">Application under development, expect few bugs and unfinished features</p>
                </div>
                <div class="w-[15%] text-center">
                    <button class="text-white text-sm py-2 px-5 bg-[#383535] rounded-full">{{ session('dealer')->business_name }}</button>
                </div>
            </div>
            <div class="w-full p-7 h-[90%]">
                <div class="w-full flex items-center justify-between mb-10">
                    <p class="text-xl font-medium text-black-v2">Sold History</p>
                </div>
                <div class="w-full">
                    <div class="w-full flex items-center px-2 py-2 mb-2 bg-[#3b5a54] text-white">
                        <p class="w-[25%]">Retailer</p>
                        <p class="w-[25%]">Rice</p>
                        <p class="w-[15%]">Order count</p>
                        <p class="w-[10%]">Total (&#8369;)</p>
                        <p class="w-[25%] text-center">Delivered Date</p>
                    </div>
                    @foreach ($orders as $order)
                        <div class="w-full flex items-center px-2 py-3 border-b border-[#3b5a54] text-black">
                            <p class="w-[25%]">{{ $order['retailer'] }}</p>
                            <p class="w-[25%]">{{ $order['rice_name'] }}</p>
                            <p class="w-[15%]">{{ $order['quantity'] }}</p>
                            <p class="w-[10%]">&#8369; {{ number_format($order['total_amount'], 2) }}</p>
                            <p class="w-[25%] text-center">{{ \Carbon\Carbon::parse($order['created_at'])->format('F d, Y') }}</p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</body>
</html>