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
    <link rel="shortcut icon" href="{{asset('images/logo-2.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>GrainEx</title>
</head>
<body class="h-screen relative overflow-hidden">
    {{-- bg --}}
    <div class="w-[800px] h-[800px] bg-red-500 opacity-5 rounded-full blur-3xl absolute -top-[20%] -left-[10%] z-0"></div>
    <div class="w-[600px] h-[600px] bg-blue-500 opacity-5 rounded-full blur-3xl absolute -top-[20%] left-[30%] z-0"></div>
    <div class="w-[800px] h-[800px] bg-green-500 opacity-5 rounded-full blur-3xl absolute -top-[20%] -right-[10%] z-0"></div>
    <div class="w-[700px] h-[700px] bg-yellow-500 opacity-5 rounded-full blur-3xl absolute -bottom-[30%] right-[25%] z-0"></div>
    <div class="w-[600px] h-[600px] bg-orange-500 opacity-5 rounded-full blur-3xl absolute -bottom-[30%] -left-[5%] z-0"></div>
    <div class="w-[600px] h-[600px] bg-blue-500 opacity-5 rounded-full blur-3xl absolute -bottom-[30%] -right-[20%] z-0"></div>
    <div class="w-full flex items-center justify-evenly bg-transparent h-full">
        {{-- signup --}}
        <div class="w-1/2 bg-white drop-shadow-xl rounded-2xl p-10">
            <a href="{{route('signup')}}">Signup</a>
            <a href="{{route('login')}}">Login</a>
        </div>
    </div>
</body>
</html>