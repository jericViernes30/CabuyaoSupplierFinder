<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reserve;
use App\Models\Retailer;
use App\Models\Rice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    public function dashboard(){
        return view('dealers.dashboard');
    }

    public function items(){
        return view('dealers.items');
    }

    public function addProductView(){
        return view('dealers.add_items');
    }

    public function signUpDealer(){
        // dd($request);

        $password = 'allan';
        $hashedPassword = Hash::make($password);

        $data = [
            'first_name' => 'Allan',
            'last_name' => 'Labigan',
            'email_address' => 'allanlabigan@gmail.com',
            'contact_number' => '09917582491',
            'address' => 'San Isidro Cabuyao Laguna',
            'latitude' => '14.254524900598247',
            'longitude' => '121.12842534347477',
            'business_name' => 'Allan Rice Trading',
            'business_type' => 'Dealer',
            'password' => $hashedPassword
        ];

        $signin = Dealer::create($data);

        if($signin){
            return redirect()->route('login')->with('success', 'Account registered successfully!');
        }
    }

    public function loginDealer(Request $request)
    {
        $request->validate([
            'email_address' => 'required|email',
            'password' => 'required|string',
        ]);

        $dealer = Dealer::where('email_address', $request->email_address)->first();

        if ($dealer && Hash::check($request->password, $dealer->password)) {
            // Store dealer information in session
            session(['dealer' => $dealer]);  // Using 'dealer' as the session key

            Auth::login($dealer);

            return redirect()->route('dealer.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function orders()
{
    $dealerName = session('dealer')->business_name;
    // Get all distinct user_ids from the Order model where status is 'Reserved'
    $distinctUserIds = Order::where('status', 'On Process')->distinct()->pluck('user_id');

    $data = [];

    foreach ($distinctUserIds as $userId) {
        // 1. Get all Orders for the user where status is 'Reserved'
        $userOrders = Order::where('user_id', $userId)->where('status', 'On Process')->get();
        
        // 2. Get the Retailer info for this user
        $retailer = Retailer::find($userId);

        // 3. Get all rice_ids for this user's orders
        $riceIds = $userOrders->pluck('rice_id')->unique();

        // 4. Get Rice data for each rice_id where the dealer is 'Lim Rice Trading'
        $riceData = Rice::whereIn('id', $riceIds)->where('dealer', $dealerName)->get()->keyBy('id');

        // 5. Filter orders to include only those with rice data from 'Lim Rice Trading'
        $filteredOrders = $userOrders->filter(function($order) use ($riceData) {
            return isset($riceData[$order->rice_id]);
        });

        // 6. Query the Reserve model for the user's reserve data
        $reserve = Reserve::where('user_id', $userId)->first();

        // 7. Calculate the total price for each order and sum them up
        $totalPrice = $filteredOrders->sum(function($order) use ($riceData) {
            $ricePrice = ($order->order_type == 'per_sack')
                ? $riceData[$order->rice_id]->per_sack
                : $riceData[$order->rice_id]->per_kg;
            return $order->count * $ricePrice;
        });

        // Only add data if there are any valid orders from 'Lim Rice Trading'
        if ($filteredOrders->isNotEmpty()) {
            $data[] = [
                'first_name' => $retailer->first_name,
                'order_count' => $filteredOrders->count(),
                'total_price' => $totalPrice,
                'requested_delivery_date' => $reserve->delivery_date,
                'order_date' => $reserve->created_at,
                'business_name' => $retailer->business_name,
                'user_id' => $retailer->id,
                'rice_ids' => $filteredOrders->pluck('rice_id')->unique()->values(), // Get all unique rice_ids for the filtered orders
            ];
        }
    }

    // Pass the data to the view
    return view('dealers.orders', compact('data'));
}




public function getOrderDetails(Request $request)
{
    $name = $request->input('name');

    // Fetch orders based on retailer's first name
    $orders = Order::whereHas('retailer', function ($query) use ($name) {
        $query->where('first_name', $name);
    })->get();

    // Retrieve the retailer details
    $retailer = Retailer::where('first_name', $name)->first(); // Assuming you are looking for the retailer by first_name

    // Prepare the data to return, filtering orders for rice from 'Lim Rice Trading'
    $orderData = $orders->map(function ($order) {
        $dealer = session('dealer')->business_name;
        $rice = Rice::find($order->rice_id); // Get rice details
        if ($rice && $rice->dealer === $dealer) {
            return [
                'sack_count' => $order->count,
                'rice_name' => $rice->name,
                'rice_id' => $rice->id,  // Include the rice_id
                'price_per_sack' => $rice->per_sack,
                'total_price' => $order->count * $rice->per_sack,
            ];
        }
        return null; // Return null for orders that are not from 'Lim Rice Trading'
    })->filter(); // Filter out null values (orders that are not from 'Lim Rice Trading')

    // Return response as JSON with retailer and orders data
    return response()->json([
        'retailer' => $retailer,
        'orders' => $orderData
    ]);
}


    public function markOrderDelivered(Request $request)
    {
        // Get rice_id and user_id from the request
        $riceId = $request->input('rice_id');
        $userId = $request->input('user_id');

        // Find the order based on rice_id and user_id (assuming you have an Order model)
        $order = Order::where('rice_id', $riceId)
                    ->where('user_id', $userId)
                    ->where('status', 'Reserved')
                    ->first();

        if ($order) {
            // Update the order status to 'Delivered'
            $order->status = 'Delivered';
            $order->save();

            // Return a success response
            return response()->json(['message' => 'Order marked as delivered']);
        } else {
            // Return an error response if the order is not found
            return response()->json(['error' => 'Order not found'], 404);
        }
    }

 
}
