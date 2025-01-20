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
            <div class="w-full flex items-center justify-end h-[10%]">
                <div class="w-[15%] text-center">
                    <button class="text-white-v2 text-sm py-2 px-5 bg-black-v2 rounded-full">Lim Rice Trading</button>
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
                <div class="w-full">
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
                                    <label for="" class="text-sm font-medium">Price / kg*</label>
                                    <input type="number" name="kg_price" value="0" class="px-4 py-2 rounded-md border border-gray-400 outline-none bg-white-v2 text-center">
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