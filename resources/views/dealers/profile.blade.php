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
        <div class="w-[86%] p-7 h-full">
            <div class="w-full flex items-center justify-between mb-10">
                <p class="text-xl font-medium">Profile</p>
            </div>
            <hr>
            <div class="w-full items-center mt-10">
                <div class="mb-5">
                    <p class="font-medium mb-2 text-lg">Business details</p>
                    <div class="w-4/5 flex items-center gap-4 mb-4">
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-600">Business name</p>
                            <input type="text" value="{{$dealer->business_name}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-600">Business type</p>
                            <input type="text" value="{{$dealer->business_type}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                    </div>
                    <div class="w-4/5">
                        <div class="w-full">
                            <p class="mb-1 text-gray-600">Business address</p>
                            <input type="text" value="{{$dealer->address}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <p class="font-medium mb-2 text-lg">Owner details</p>
                    <div class="w-4/5 flex items-center gap-4 mb-4">
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-600">First name</p>
                            <input type="text" value="{{$dealer->first_name}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-600">Last name</p>
                            <input type="text" value="{{$dealer->last_name}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                    </div>
                    <div class="w-4/5 flex items-center gap-4 mb-4">
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-600">Email address</p>
                            <input type="text" value="{{$dealer->email_address}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-600">Contact number</p>
                            <input type="text" value="{{ preg_replace('/^0(\d{3})(\d{3})(\d{4})$/', '+63 $1 $2 $3', $dealer->contact_number) }}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                    </div>
                    <div class="w-4/5">
                        <div class="w-full">
                            <p class="mb-1 text-gray-600">Home address</p>
                            <input type="text" value="{{$dealer->address}}" class="w-full px-3 py-2 rounded-md outline-none border border-main" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-5 bg-[#faf7f7] shadow-md rounded-lg p-4 mb-4">
                    <p class="font-medium mb-2 text-lg">Reset Password</p>
                    <div class="w-4/5 flex items-center gap-4 mb-4">
                        <form action="{{route('retailer.password.update')}}" class="w-full" method="POST">
                            @csrf
                            <div class="w-full mb-3">
                                <p class="mb-1 text-gray-600">Old password</p>
                                <div class="w-full flex gap-4 items-center">
                                    <input id="old_password" type="password" name="old_password" class="w-4/5 px-3 py-2 rounded-md outline-none border border-main" placeholder="Enter old password">
                                    <button type="button" id="toggle_old" class="text-xs">Toggle password</button>
                                </div>
                            </div>
                            <div class="w-full mb-6">
                                <p class="mb-1 text-gray-600">New password</p>
                                <div class="w-full flex gap-4 items-center">
                                    <input id="new_password" type="password" name="new_password" class="w-4/5 px-3 py-2 rounded-md outline-none border border-main" placeholder="Enter new password">
                                    <button type="button" id="toggle_new" class="text-xs">Toggle password</button>
                                </div>
                            </div>
                            <button type="submit" class="px-10 py-2 rounded-lg bg-main text-sm">Update password</button>
                        </form>
                    </div>
                </div>
                <div class="mb-5 w-full pb-5">
                </div>
            </div>
        </div>
    </div>
</body>
</html>