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
                <div class="w-full flex items-center justify-between mb-10">
                    <p class="text-xl font-medium text-black-v2">Rice List</p>
                </div>
                <div class="w-full mb-10">
                    <button onclick="window.location.href='/dealer/add-product'" class="px-10 py-2 rounded-sm bg-black-v2 text-white-v2">
                        Add Stocks
                    </button>
                </div>
                <div class="w-full">
                    <div class="w-full flex items-center bg-[#3b5a54] py-2 text-white-v2 px-3">
                        <p class="w-[40%]">Name</p>
                        <p class="w-[20%]">Quality</p>
                        <p class="w-[15%] text-right">Price / kg (₱)</p>
                        <p class="w-[15%] text-right">Price / sack (₱)</p>
                        <p class="w-[10%] text-right">In Stocks</p>
                    </div>
                    <div class="w-full flex items-center px-3 py-4 border-b border-black-v2 hover:bg-[#e9f9f6] hover:cursor-pointer">
                        <p class="w-[40%] uppercase">Jillian Rice</p>
                        <p class="w-[20%] uppercase">Well Milled Rice</p>
                        <p class="w-[15%] text-right">52</p>
                        <p class="w-[15%] text-right">1200</p>
                        <p class="w-[10%] text-right">26</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>