{{-- resources/views/components/sidebar.blade.php --}}
<div class="w-[14%] border-r border-[#9ee4d7] h-full">
    <div class="w-full flex items-center justify-center py-16">
        <img src="{{ asset('images/logo-2.png') }}" alt="" class="w-[25%]">
        <p class="text-2xl font-semibold">grainex</p>
    </div>
    <div class="w-full flex items-start flex-col text-left">
        {{-- Dashboard Link --}}
        <button onclick="window.location.href='{{route('dealer.dashboard')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="18" height="18" fill="{{ Request::is('dealer/dashboard*') ? '#95e1d4' : '#000' }}">
                <path d="M36.8 192l566.3 0c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0L121.7 0c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224l0 160 0 80c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-80 0-160-64 0 0 160-192 0 0-160-64 0zm448 0l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32l0-256-64 0z"/>
            </svg>
            <p class="font-normal {{ Request::is('dealer/dashboard*') ? 'text-main' : '' }}">Dashboard</p>
        </button>

        {{-- Items Link --}}
        <button onclick="window.location.href='{{route('dealer.items')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="17" height="17" fill="{{ Request::is('dealer/items*') ? '#95e1d4' : '#000' }}">
                <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
            </svg>
            <p class="font-normal {{ Request::is('dealer/items*') ? 'text-main' : '' }}">Items</p>
        </button>

        {{-- Orders Link --}}
        <button onclick="window.location.href='{{route('dealer.orders')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17" fill="{{ Request::is('dealer/orders*') ? '#95e1d4' : '#000' }}">
                <path d="M384 96l0 128-128 0 0-128 128 0zm0 192l0 128-128 0 0-128 128 0zM192 224L64 224 64 96l128 0 0 128zM64 288l128 0 0 128L64 416l0-128zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32z"/>
            </svg>
            <p class="font-normal {{ Request::is('dealer/orders*') ? 'text-main' : '' }}">Orders</p>
        </button>
        {{-- Orders Link --}}
        <button onclick="window.location.href='{{route('dealer.history')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17" fill="{{ Request::is('dealer/history*') ? '#95e1d4' : '#000' }}">
                <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z"/>
            </svg>
            <p class="font-normal {{ Request::is('dealer/history*') ? 'text-main' : '' }}">History</p>
        </button>
        <button onclick="window.location.href='{{route('dealer.profile')}}'" class="py-2 w-full text-left pl-10 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="17" height="17" fill="{{ Request::is('dealer/profile*') ? '#95e1d4' : '#000' }}"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
            <p class="font-normal {{ Request::is('dealer/profile*') ? 'text-main' : '' }}">Profile</p>
        </button>
        <form action="{{ route('dealer.logout') }}" method="POST" class="pl-10">
            @csrf  <!-- CSRF token for security -->
            <button type="submit" class="py-2 w-full text-left flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="17" height="17"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                <p>Logout</p>
            </button>
        </form>
    </div>
</div>
