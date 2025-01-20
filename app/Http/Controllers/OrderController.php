<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reserve;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addToCart(Request $request){
        $order = [
            'user_id' => $request->input('user_id'),
            'rice_id' => $request->input('rice_id'),
            'order_type' => $request->input('measurement'),
            'count' => $request->input('sacks_count'),
            'status' => 'Pending'
        ];

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
        $riceIds = array_column($request->input('orders'), 'rice_id');

        // Query the Order model to find orders matching the rice_ids, status 'Pending', and user_id
        $pendingOrders = Order::whereIn('rice_id', $riceIds)
                            ->where('status', 'Pending')
                            ->where('user_id', $userID)
                            ->get();

        // Update the status of those orders to 'Reserved'
        $pendingOrders->each(function ($order) {
            $order->status = 'On Process'; // Change the status to 'Reserved'
            $order->save(); // Save the changes to the database
        });

        $deliveryData = [
            'user_id' => $userID,
            'delivery_date' => $deliveryDate
        ];

        Reserve::create($deliveryData);

        // Optionally, you can return a success message or response
        return redirect(route('retailer.dashboard'))->with('success', 'Order added successfully!');
    }


}
