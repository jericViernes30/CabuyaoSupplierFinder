<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reserve;
use App\Models\Retailer;
use App\Models\Rice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class DealerController extends Controller
{
    public function dashboard(){
        $dealerID = session('dealer')->id;

        $pendingOrders = Order::whereIn('status', ['Order Placed', 'Processing Order'])
        ->where('dealer_id', $dealerID)
        ->count();

        // Calculate sales for this month
        $thisMonthProfit = History::where('dealer_id', $dealerID)
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');
        $thisMonthSacks = History::where('dealer_id', $dealerID)
            ->whereMonth('created_at', now()->month)
            ->sum('quantity');
    
        // Calculate sales for the previous month
        $previousMonthProfit = History::where('dealer_id', $dealerID)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total_amount');
        $previousMonthSacks = History::where('dealer_id', $dealerID)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('quantity');
    
        // Calculate the percentage increase/decrease
        $profitChange = $previousMonthProfit ? (($thisMonthProfit - $previousMonthProfit) / $previousMonthProfit) * 100 : 100;
        $sacksChange = $previousMonthSacks ? (($thisMonthSacks - $previousMonthSacks) / $previousMonthSacks) * 100 : 100;
    
       

        // Get monthly sales data for the current year
        $monthlySales = History::where('dealer_id', $dealerID)
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [date('F', mktime(0, 0, 0, $item->month, 10)) => $item->total_amount];
            });
        $stats = [
            'profit' => htmlspecialchars((string) $thisMonthProfit),
            'sacks' => htmlspecialchars((string) $thisMonthSacks),
            'pendingOrders' => $pendingOrders,
            'profitChange' => $profitChange,
            'sacksChange' => $sacksChange,
        ];
        return view('dealers.dashboard', ['status' => $stats, 'monthlySales' => $monthlySales]);
    }
    
    
    
    

    public function items(){

        $rice = Rice::where('dealer', session('dealer')->business_name)->get();
        // dd($rice);
        return view('dealers.items', ['rice' => $rice]);

    }

    public function addProductView(){
        return view('dealers.add_items');
    }

    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Optionally, you can invalidate the session (for extra security)
        session()->invalidate();
        session()->regenerateToken();

        // Redirect to the login page or home page after logout
        return redirect()->route('index');
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

        $dealer = Retailer::where('email_address', $request->email_address)
                  ->where('business_type', 'dealer')
                  ->first();

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
    if (!session()->has('dealer')) {
        return redirect()->route('login')->withErrors(['error' => 'Please log in first.']);
    }

    $dealerID = session('dealer')->id;
    
    $order = Order::where('dealer_id', $dealerID)
                  ->whereIn('status', ['Order Placed', 'Processing Order', 'Out for delivery'])
                  ->get();
    // dump($order);

    $data = $order->map(function ($order) {
        $retailer = Retailer::find($order->retailer);
        $deliverDate = Reserve::where('order_id', $order->order_id)->first();
        // dump($deliverDate);
        $rice = Rice::find($order->rice_id);
        $perSack = $rice->per_sack;

        return [
            'order_id' => $order->order_id,
            'first_name' => $retailer->first_name,
            'business_name' => $retailer->business_name,
            'rice_name' => $rice->name,
            'requested_delivery_date' => $deliverDate ? $deliverDate->delivery_date : null, 
            'order_type' => $order->order_type,
            'order_count' => $order->count,
            'order_date' => $order->created_at->format('F d, Y - h:i A'),
            'total_price' => $order->count * $perSack,
            'status' => $order->status,
        ];
    });

    // dump($data);


    // Pass the data to the view
    return view('dealers.orders', compact('data'));
}

public function getOrderDetails(Request $request)
{
    // 1. Get the orderID and dealerID from the request and session
    $orderID = $request->input('orderID');
    $dealerID = session('dealer')->id;

    // Log the received orderID and dealerID
    Log::info('Received Order ID:', ['orderID' => $orderID, 'dealerID' => $dealerID]);

    // Validate that the orderID is provided
    if (!$orderID) {
        return response()->json(['error' => 'Order ID is required'], 400);
    }

    // 2. Try to find the order based on orderID and dealerID
    $order = Order::where('order_id', $orderID)->where('dealer_id', $dealerID)->first();

    if (!$order) {
        // Log error if the order is not found
        Log::error('Order not found for the given orderID and dealerID.', ['orderID' => $orderID, 'dealerID' => $dealerID]);
        return response()->json(['error' => 'Order not found for the given orderID and dealerID'], 404);
    }

    // 3. Find the retailer (client) associated with the order
    $client = Retailer::where('id', $order->retailer)->first();

    if (!$client) {
        // Log error if the client is not found
        Log::error('Retailer not found for order', ['order_id' => $orderID, 'retailer_id' => $order->retailer]);
        return response()->json(['error' => 'Client not found'], 404);
    }

    // 4. Try to fetch all orders for this retailer with status 'Order Placed' or 'Processing Order'
    $orders = Order::where('retailer', $client->id)
                    ->where('order_id', $orderID)
                    ->whereIn('status', ['Order Placed', 'Processing Order', 'Out for delivery'])
                    ->get();

    if ($orders->isEmpty()) {
        // Log if no orders are found
        Log::info('No orders found for retailer', ['retailer_id' => $client->id]);
        return response()->json(['message' => 'No orders found for this client'], 200);
    }
    Log::info('Orders before mapping:', ['orders' => $orders]);

    // 5. Prepare the data to return, filtering orders for rice from the current dealer
    $orderData = $orders->map(function ($order) use ($dealerID) {
        // Log each order before filtering
        Log::info('Mapping order:', ['order' => $order]);
    
        // Get the rice details
        $rice = Rice::find($order->rice_id);
        Log::info('Rice fetched for order:', ['rice' => $rice]);
        $deliverDate = Reserve::where('order_id', $order->order_id)->first();
        if ($rice && $rice->dealer == session('dealer')->business_name) {
            Log::info('Order matches dealer:', ['order_id' => $order->order_id]);
            return [
                'order_id' => $order->order_id,
                'status' => $order->status,
                'sack_count' => $order->count,
                'rice_name' => $rice->name,
                'rice_id' => $rice->id,
                'price_per_sack' => $rice->per_sack,
                'total_price' => $order->count * $rice->per_sack,
                'delivery_date' => $deliverDate ? $deliverDate->delivery_date : null,
            ];
        }
    
        // Log when a match is not found
        Log::info('Order does not match dealer:', ['order_id' => $order->order_id]);
    
        // Skip orders that do not match the dealer
        return null;
    })->filter()->values();
    

    // Log the final data being returned
    Log::info('Returning order details', ['client' => $client->business_name, 'orderData' => $orderData]);

    // Return the response as JSON with retailer and filtered orders data
    return response()->json([
        'name' => $client->business_name,
        'dealer_id' => $dealerID,
        'retailer' => $client,
        'orders' => $orderData
    ]);
}






public function markOrderDelivered(Request $request)
{
    // Get the order ID from the request
    $orderID = $request->input('orderId');

    // Find the order based on the order ID and check if its status is 'Processing Order'
    $order = Order::where('order_id', $orderID)
                  ->where('status', 'Out for delivery')
                  ->first();

    if ($order) {
        // Update the order status to 'Delivered'
        $order->status = 'Delivered';
        $order->save();

        // Get dealer ID from the session
        $dealerID = session('dealer')->id;

        // Retrieve associated retailer, rice, and calculate total price
        $retailer = Retailer::where('id', $order->retailer)->first();
        $rice = Rice::where('id', $order->rice_id)->first();
        $orderType = 'per sack';
        $totalPrice = $order->count * $rice->per_sack;

        // Prepare data to save to the History model
        $delivered = [
            'order_id' => $orderID,
            'dealer_id' => $dealerID,
            'retailer' => $retailer->business_name,
            'rice_name' => $rice->name,
            'quantity' => $order->count,
            'total_amount' => $totalPrice,
            'order_type' => $orderType,
        ];

        // Log the delivered array
        // Log::info('Delivered Order Data:', $delivered);

        // Create a new record in the History table
        $saveToDelivered = History::create($delivered);

        if ($saveToDelivered) {
            return response()->json(['message' => 'Order marked as delivered']);
        } else {
            return response()->json(['error' => 'Failed to mark order as delivered', 'delivered' => $delivered], 500);
        }
    } else {
        // Return an error response if the order is not found
        return response()->json(['error' => 'Order not found'], 404);
    }
}


    public function processOrder(Request $request)
    {
        // Get rice_id and user_id from the request
        $orderID = $request->input('order_id');

        // Find the order based on rice_id and user_id (assuming you have an Order model)
        $order = Order::where('order_id', $orderID)
                    ->where('status', 'Order Placed')
                    ->first();

        $rice = Rice::find($order->rice_id);

        if ($order) {
            // Update the order status to 'Delivered'
            $rice->quantity = $rice->quantity - $order->count;
            $rice->save();
            $order->status = 'Processing Order';
            $order->save();

            // Return a success response
            return response()->json(['message' => 'Order marked as processed']);
        } else {
            // Return an error response if the order is not found
            return response()->json(['error' => 'Order not found'], 404);
        }
    }

    public function shipOrder(Request $request)
    {
        // Get rice_id and user_id from the request
        $orderID = $request->input('order_id');

        // Find the order based on rice_id and user_id (assuming you have an Order model)
        $order = Order::where('order_id', $orderID)
                    ->where('status', 'Processing Order')
                    ->first();

        if ($order) {
            // Update the order status to 'Delivered'
            $order->status = 'Out for delivery';
            $order->save();

            // Return a success response
            return response()->json(['message' => 'Order marked as shipped out']);
        } else {
            // Return an error response if the order is not found
            return response()->json(['error' => 'Order not found'], 404);
        }
    }

    public function history()
{
    $dealerID = session('dealer')->id;
    // Fetch all orders with 'Delivered' status
    $orders = History::where('dealer_id', $dealerID)->get();

    return view('dealers.history', ['orders' => $orders]);
}


    public function deleteRiceItem($rice_id){
        $rice = Rice::find($rice_id);

        if ($rice) {
            $rice->delete();
            return response()->json(['message' => 'Rice item deleted successfully']);
        } else {
            return response()->json(['error' => 'Rice item not found'], 404);
        }
    }




 
}
