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
    <div id="overlay" class="hidden w-full bg-[#000000be] h-screen absolute top-0 z-10"></div>
    <div id="details_div" class="hidden w-1/2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 h-fit rounded-xl z-20">
        <div class="w-full bg-[#9ee4d7] px-6 py-2 rounded-tr-xl rounded-tl-xl">
            Order Details
        </div>
        <div class="w-full p-6 bg-white rounded-bl-xl rounded-br-xl">
            <p><strong>Retailer name:</strong><span id="retailer_name"></span></p>
            <p><strong>Business name:</strong><span id="business_name"></span></p>
            <p><strong>Business address:</strong><span id="business_address"></span></p>
            <p><strong>Delivery date:</strong><span id="delivery_date"></span></p>
            <div id="ordersContainer" class="">
                <p id="sack_count"></p>
                <p id="rice_name"></p>
                <p id="price_per_sack"></p>
                <p id="total_price"></p>
            </div>
            <div class="w-full flex items-center justify-end mb-4">
                <p><strong>Total to pay:</strong> <span id="total"></span></p>
            </div>
            <div class="w-full mb-4 border-b border-gray-400">
            </div>
            <div class="w-full flex justify-end">
                <input id="rice_id" type="hidden" name="order_id">
                <button id="process_order" type="button" class="hidden py-2 px-10 bg-[#3b5a54] rounded-lg uppercase text-sm text-white">Process Order</button>
                <script>
                    $('#process_order').on('click', function() {
                        const orderId = $('#rice_id').val();
                        alert(orderId)
                        if (orderId) {
                            $.ajax({
                                url: '{{ route('dealer.order.processed') }}',
                                method: 'POST',
                                data: {
                                    order_id: orderId,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    alert('Order marked as processed');
                                    window.location.href = 'http://127.0.0.1:8000/dealer/orders';
                                },
                                error: function(xhr, status, error) {
                                    alert('Error: ' + error);
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                        } else {
                            alert('Missing required data');
                        }
                    });
                </script>
                <button id="order_delivered" type="button" class="hidden py-2 px-10 bg-[#3b5a54] rounded-lg uppercase text-sm text-white">Order's Delivered</button>
            </div>
        </div>
    </div>
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
                    <p class="text-xl font-medium text-black-v2">Orders List</p>
                </div>
                <div class="w-full">
                    <div class="w-full flex items-center px-2 py-2 bg-[#3b5a54] text-white">
                        <p class="w-[20%]">Retailer</p>
                        <p class="w-[20%]">Order count</p>
                        <p class="w-[20%]">Total (&#8369;)</p>
                        <p class="w-[20%]">Requested Delivery Date</p>
                        <p class="w-[20%] text-center">Order date</p>
                    </div>
                    @foreach($data as $orderData)
                        <button data-order="{{ $orderData['order_id'] }}" id="orderDetails" class="w-full flex items-center p-2 border-b text-left">
                                <p class="w-[20%]">{{ $orderData['business_name'] }}</p>
                                <p class="w-[20%]">{{ $orderData['order_count'] }}</p>
                                <p class="w-[20%]">{{ number_format($orderData['total_price'], 2) }}</p>
                                <p class="w-[20%]">
                                    {{ \Carbon\Carbon::parse($orderData['requested_delivery_date'])->format('F d, Y') }}
                                </p>
                                
                                <p class="w-[20%] text-center">{{ $orderData['order_date'] }}</p>
                        </button>
                    @endforeach
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#orderDetails', function () {
                $('#details_div').removeClass('hidden')
                $('#overlay').removeClass('hidden')
                var orderID = $(this).data('order');
                // alert(orderID)

                $.ajax({
                    url: '{{ route('dealer.order.details') }}',
                    type: 'POST',
                    data: {
                        orderID: orderID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        const ordersContainer = $('#ordersContainer');
                        ordersContainer.empty();

                        let grandTotal = 0;

                        if(response.orders[0].status == 'Order Placed') {
                            $('#process_order').removeClass('hidden');
                        } else {
                            $('#order_delivered').removeClass('hidden');
                        }

                        $('#retailer_name').text(' ' + response.retailer.first_name + ' ' + response.retailer.last_name);
                        $('#business_name').text(' ' + response.retailer.business_name);
                        $('#business_address').text(' ' + response.retailer.address);
                        $('#delivery_date').text(' ' + response.orders[0].delivery_date);
                        alert(response.orders)
                        $('#user_id').val(response.retailer.id)

                        response.orders.forEach(order => {
                            $('#rice_id').val(order.order_id)
                            // alert(order.order_id)
                            const orderHTML = `
                                <div class="order-item my-2 p-4 border rounded flex items-center justify-between">
                                    <p>${order.sack_count}</p>
                                    <p>${order.rice_name}</p>
                                    <p>${order.price_per_sack.toFixed(2)}</p>
                                    <p>${order.total_price.toFixed(2)}</p>
                                </div>
                            `;

                            ordersContainer.append(orderHTML);
                            grandTotal += order.total_price;
                        });
                        $('#total').text(grandTotal.toFixed(2));
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#order_delivered').on('click', function() {
                const orderId = $('#rice_id').val();
                alert(orderId)
                if (orderId) {
                    $.ajax({
                        url: '{{ route('dealer.order.delivered') }}',
                        method: 'POST',
                        data: {
                            orderId: orderId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert('Order marked as delivered');
                            window.location.href = 'http://127.0.0.1:8000/dealer/orders';
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                } else {
                    alert('Missing required data');
                }
            });
        })
    </script>
</body>
</html>