<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reserve;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addToCart(Request $request){
        $order_id = 'ORD-'.$request->input('user_id').'-'.rand(1000, 9999);

        $order = [
            'order_id' => $order_id,
            'retailer' => $request->input('user_id'),
            'rice_id' => $request->input('rice_id'),
            'dealer_id' => $request->input('dealer_id'),
            'order_type' => $request->input('measurement'),
            'count' => $request->input('sacks_count'),
            'status' => 'Pending'
        ];
        // dd($order);

        $addToOrders = Order::create($order);

        if ($addToOrders) {
            return redirect(route('retailer.dashboard'))->with('success', 'Order added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add order.');
        }
    }
    

    public function addToOrders(Request $request)
    {
        // Get the user ID from the session
        $userID = session('profile')->id;
        $deliveryDate = $request->input('delivery_date');

        // Extract rice_ids from the orders array in the request
        $orderID = $request->input('order_id');

        Order::where('order_id', $orderID)->update(['status' => 'Order Placed']);

        $deliveryData = [
            'order_id' => $orderID,
            'delivery_date' => $deliveryDate
        ];

        Reserve::create($deliveryData);

        // Optionally, you can return a success message or response
        return redirect(route('retailer.dashboard'))->with('success', 'Order added successfully!');
    }

    // ADMIN

    public function ordersList(){
        $orders = Order::where('status', 'On Process')
                        ->get()
                        ->groupBy('user_id');

        $ordersWithRiceDetails = $orders->map(function ($userOrders) {
            return $userOrders->map(function ($order) {
                $order->rice_details = $order->rice; // Assuming you have a relationship set up in the Order model
                return $order;
            });
        });

        return view('dealer.orders', ['orders' => $ordersWithRiceDetails]);
    }
}
