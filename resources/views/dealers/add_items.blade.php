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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="{{asset('images/logo-2.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>
<body class="w-full h-screen bg-white-v2">
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
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{route('dealer.items')}}" class="text-blue-400 underline">Items</a>
                    <p class="text-black-v2">></p>
                    <p class="text-xl font-medium text-black-v2">Add Product</p>
                </div>
                <div class="w-full flex items-center justify-between mb-10">
                </div>
                <div class="w-[full]">
                    <form action="{{route('dealer.product.add')}}" class="w-1/2 bg-[#f4fcfa] shadow-xl p-10 rounded-2xl" method="POST">
                        @csrf
                        <div>
                            <p class="mb-6">Rice Details</p>
                            <div class="w-full flex items-center gap-4 mb-6">
                                <div class="w-1/2 flex flex-col gap-2">
                                    <label for="" class="text-sm font-medium">Rice Name*</label>
                                    <input type="text" name="rice_name" class="px-4 py-2 rounded-md border border-gray-400 outline-none bg-white-v2">
                                </div>
                                <div class="w-1/2 flex flex-col gap-2">
                                    <label for="" class="text-sm font-medium">Quality*</label>
                                    <input type="text" name="quality" class="px-4 py-2 rounded-md border border-gray-400 outline-none bg-white-v2">
                                </div>
                            </div>
                            <div class="w-full flex items-center justify-between gap-4 mb-6">
                                <div class="w-[21%] flex flex-col gap-2">
                                    <label for="" class="text-sm font-medium">Price / sack*</label>
                                    <input type="number" name="sack_price" value="0" class="px-4 py-2 rounded-md border border-gray-400 outline-none bg-white-v2 text-center">
                                </div>
                                <div class="w-[21%] flex flex-col gap-2">
                                    <label for="" class="text-sm font-medium">Price bought*</label>
                                    <input type="number" name="buy_price" value="0" class="px-4 py-2 rounded-md border border-gray-400 outline-none bg-white-v2 text-center">
                                </div>
                                <div class="w-[21%] flex flex-col gap-2">
                                    <label for="" class="text-sm font-medium">Quantity*</label>
                                    <input type="number" name="quantity" id="quantity" value="1" class="px-4 py-2 rounded-md border border-gray-400 outline-none text-center bg-white-v2">
                                </div>
                            </div>
                            <input type="hidden" name="dealer" value="{{ session('dealer')->business_name }}">
                            <input type="hidden" name="address" value="{{ session('dealer')->address }}">
                            <button type="sumit" class="px-16 text-sm py-2 rounded-md bg-main">Add</button>
                            <button type="button" class="underline text-sm ml-4">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>