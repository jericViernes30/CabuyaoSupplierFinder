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
    <title>GrainEx | Sign Up</title>
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
            <div class="w-full flex items-center justify-start mb-5">
                <img src="{{asset('images/logo-2.png')}}" alt="" class="w-[9%]">
                <p class="text-2xl font-semibold">grainex</p>
            </div>
            <p class="text-2xl">Sign up</p>
            <p class="text-xs text-[#8f8f8f] mb-5">Enter you details below to create an account and get started.</p>
            <form action="{{route('retailer.signup')}}" method="POST" class="w-full text-sm">
                @csrf
                <div class="w-full flex items-center gap-5 mb-8">
                    <div class="w-1/4 flex flex-col">
                        <label for="" class="">First Name</label>
                        <input type="text" name="first_name" class="w-full outline-none rounded-md border border-[#cccbcb] p-2 focus:border focus:border-[#9ee4d7] ease-in-out transition duration-100">
                    </div>
                    <div class="w-1/4 flex flex-col">
                        <label for="" class="">Last Name</label>
                        <input type="text" name="last_name" class="w-full outline-none rounded-md border border-[#cccbcb] p-2 focus:border focus:border-[#9ee4d7] ease-in-out transition duration-100">
                    </div>
                    <div class="w-1/2 flex flex-col">
                        <label for="" class="">Email Address</label>
                        <input type="text" name="email_address" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                    </div>
                </div>
                <div class="w-full flex items-center gap-5 mb-8">
                    <div class="w-1/4 flex flex-col">
                        <label for="" class="">Contact Number</label>
                        <input type="text" name="contact_number" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                    </div>
                    <div class="w-3/4 flex flex-col">
                        <label for="" class="">Address</label>
                        <input type="text" name="address" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                    </div>
                </div>
                <div class="w-full flex items-center gap-5 mb-8">
                    <div class="w-3/4 flex flex-col">
                        <label for="" class="">Bussiness Name</label>
                        <input type="text" name="business_name" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                    </div>
                    <div class="w-1/4 flex flex-col">
                        <label for="" class="">Type</label>
                        <select type="text" name="business_type" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                            <option value="retailer" class="py-2 text-center outline-none border-none">Retailer</option>
                            <option value="dealer" class="py-2 text-center outline-none border-none">Dealer</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="w-full flex items-center gap-5 my-8">
                    <div class="w-1/2 flex flex-col">
                        <label for="" class="">Password</label>
                        <div class="w-full relative">
                            <input id="password" type="password" name="password" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                            <button id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="15" height="15"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="w-1/2 flex flex-col">
                        <label for="" class="">Confirm Password</label>
                        <input type="password" name="confirm_password" class="w-full outline-none rounded-md border border-[#cccbcb] p-2">
                    </div>
                    <input type="hidden" id="lat" name="lat" readonly>
                    <input type="hidden" id="long" name="long" readonly>
                    <script>
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                function(position) {
                                    document.getElementById("lat").value = position.coords.latitude;
                                    document.getElementById("long").value = position.coords.longitude;
                                },
                                function(error) {
                                    console.error("Error getting location:", error);
                                }
                            );
                        } else {
                            console.error("Geolocation is not supported by this browser.");
                        }
                    </script>
                </div>
                <div class="w-full flex gap-5 justify-end">
                    <button id="cancel" class="w-[20%] underline">Cancel</button>
                    <button class="w-[20%] bg-[#9ee4d7] rounded-md py-2 text-[#252525] disabled hover:disable">Continue</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#continue').on('click', function(e){
                e.preventDefault();
                
                alert('Button is clicked');
            })

            $('#cancel').on('click', function(c){
                c.preventDefault()
                window.location.href='/login'
            })

            $('#togglePassword').on('click', function(b){
                b.preventDefault();
                var passwordField = $('#password')
                var type = passwordField.attr('type') === 'password' ? 'text' : 'password'
                passwordField.attr('type', type)
            })
        })
    </script>
</body>
</html>