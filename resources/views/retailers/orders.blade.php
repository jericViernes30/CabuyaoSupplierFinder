<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <button class="py-2 w-full text-left pl-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17"><path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z"/></svg>
                    <p class="font-light">History</p>
                </button>
                <form action="{{ route('retailer.logout') }}" method="POST">
                    @csrf  <!-- CSRF token for security -->
                    <button type="submit">Logout</button>
                </form>
            </div>
            {{-- <div>
                <p class="text-sm font-light">jericviernes06@gmail.com</p>
            </div> --}}
        </div>
        <div class="w-[86%] h-full">
            <div class="w-full flex items-center justify-end pr-10 h-[10%]">
                <div class="w-[15%] text-center">
                    @if(session('profile'))
                        <button>Hi, {{ session('profile')->first_name }}</button>
                    @else
                        <button>Hi, Guest</button>
                    @endif
                </div>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="#252525"><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg>
                </button>
            </div>
            <div class="w-full p-7 h-[90%]">
                <div class="w-full flex items-center justify-between mb-10">
                    <p class="text-xl font-medium">Orders</p>
                </div>
                <hr>
                <div class="mt-10">
                    <form action="{{ route('retailer.order.add') }}" method="POST" class="w-full flex gap-10">
                        @csrf
                        <div class="w-3/4">
                            @if ($orderDetails->isEmpty())
                                <p class="text-center my-5">No orders in cart yet.</p>
                            @else
                                @foreach ($orderDetails as $order)
                                    <div class="w-full flex items-center my-5">
                                        <img src="{{ asset('images/' . $order['image_name'] . '.png') }}" alt="" class="w-[10%]">
                                        <div class="w-[41%] flex flex-col gap-2 pl-16">
                                            <p class="text-lg">{{ $order['rice_name'] }}</p> 
                                            <p class="text-xs">{{ $order['order_type'] == 'per_sack' ? 'Per Sack' : 'Per KG' }}</p>
                                        </div>
                                        <p class="w-[17%] text-center">{{ $order['order_type'] == 'per_sack' ? number_format($order['price_per_sack'], 2) : number_format($order['price_per_kg'], 2) }}</p>
                                        <p class="w-[5%] text-center">{{ $order['count'] }}</p>
                                        <p class="w-[17%] pl-4 text-center">{{ number_format($order['total_price'], 2) }}</p>
                                        <p class="w-[15%] 
                                            @if($order['status'] == 'On Process') 
                                                text-red-500 !important
                                            @else 
                                                text-green-500 !important
                                            @endif
                                        ">
                                            {{ $order['status'] }}
                                        </p>



                                        <!-- Hidden fields to send additional data with the checkbox -->
                                    </div>
                                    <hr>
                                @endforeach
                            @endif
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            
        });
    </script>
</body>
</html>