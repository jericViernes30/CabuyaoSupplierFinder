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
            <div class="w-full flex items-center justify-end h-[10%]">
                <div class="w-[15%] text-center">
                    @if(session()->has('dealer'))
                        <button class="text-white-v2 text-sm py-2 px-5 bg-black-v2 rounded-full">
                            {{ session('dealer.business_name') }}
                        </button>
                    @endif

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