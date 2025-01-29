<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\History;
use App\Models\Order;
use App\Models\Retailer;
use App\Models\Rice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RetailerController extends Controller
{
    public function dashboard(){
        $rice = Rice::all();
        return view('retailers.dashboard', ['rice' => $rice]);
    }

    public function signUpUser(Request $request){
        // dd($request);

        $password = $request->input('password');
        $hashedPassword = Hash::make($password);

        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email_address' => $request->input('email_address'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'business_name' => $request->input('business_name'),
            'business_type' => $request->input('business_type'),
            'lat' => $request->input('lat'),
            'long' => $request->input('long'),
            'password' => $hashedPassword
        ];

        $signin = Retailer::create($data);

        if($signin){
            return redirect()->route('retailer.dashboard')->with('success', 'Account registered successfully!');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email_address' => 'required|email',
            'password' => 'required|string',
        ]);

        $retailer = Retailer::where('email_address', $request->email_address)->first();
        $rice = Rice::all();


        if ($retailer && Hash::check($request->password, $retailer->password)) {
            Auth::login($retailer);

            session(['profile' => $retailer]);
            return redirect()->route('retailer.dashboard', ['rice' => $rice]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
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


    public function cart()
    {
        $userID = session('profile')->id;
        
        $orders = Order::where('status', 'Pending')
            ->where('retailer', $userID)
            ->get();
        $firstOrder = $orders->first();
        $dealerLat = $firstOrder ? Retailer::where('id', $firstOrder->dealer_id)->value('lat') : null;
        $dealerLong = $firstOrder ? Retailer::where('id', $firstOrder->dealer_id)->value('long') : null;
        // dd($dealerLat, $dealerLong);
        $ordersID = Order::where('status', 'Pending')
        ->where('retailer', $userID)
        ->value('order_id');
        $riceIds = $orders->pluck('rice_id')->unique();
        $riceData = Rice::whereIn('id', $riceIds)->get()->keyBy('id');
        $orderDetails = $orders->map(function ($order) use ($riceData) {
            $rice = $riceData[$order->rice_id];

            return [
                'order_id' => $order->order_id,
                'rice_name' => $rice->name,
                'price_per_sack' => $rice->per_sack,
                'price_per_kg' => $rice->per_kg,
                'count' => $order->count,
                'order_type' => $order->order_type,
                'total_price' => $rice->per_sack * $order->count,
                'image_name' => $rice->image_name,
                'rice_id' => $rice->id
            ];
        });

        return view('retailers.cart', [
            'orderDetails' => $orderDetails,
            'orderID' => $ordersID,
            'dealerLat' => $dealerLat,
            'dealerLong' => $dealerLong,
        ]);
    }

    

    public function orders()
{
    $userID = session('profile')->id;

    // Fetch orders based on retailer ID and status 'Order Placed'
    $orders = Order::where('retailer', $userID)
        ->whereIn('status', ['Order Placed', 'Processing Order', 'Out for delivery'])
        ->latest()
        ->get();

    // Group orders by dealer ID
    $groupedOrders = $orders->groupBy('dealer_id');

    // Get dealer data
    $dealerData = Retailer::whereIn('id', $groupedOrders->keys())->get()->keyBy('id');

    // Get unique rice ids from orders
    $riceIds = $orders->pluck('rice_id')->unique();

    // Fetch rice data by rice ids
    $riceData = Rice::whereIn('id', $riceIds)->get()->keyBy('id');

    // Prepare the order details per dealer
    $orderDetails = $groupedOrders->map(function ($group, $dealerId) use ($riceData, $dealerData) {
        $dealer = $dealerData[$dealerId];
        $toPay = $group->first()->to_pay;
        $totalQuantity = $group->sum('count');
        $totalPrice = $group->sum(function ($order) use ($riceData) {
            $rice = $riceData[$order->rice_id];
            return $rice->per_sack * $order->count;
        });

        // Get the first order's placed_at (all orders have the same date for the dealer)
        $placedAt = $group->first()->updated_at->format('F d, Y - h:i A');

        return [
            'dealer_name' => $dealer->business_name,
            'quantity' => $totalQuantity,
            'to_pay' => $toPay,
            'status' => $group->first()->status,
            'placed_at' => $placedAt
        ];
    });

    // Return the view with grouped order details
    return view('retailers.orders', [
        'orderDetails' => $orderDetails
    ]);
}



public function filterRiceItems(Request $request)
{
    // Retrieve the data from the request
    $lat = $request->input('lat');
    $long = $request->input('long');
    $location_distance = $request->input('location_distance');
    $price_from = $request->input('price_from');
    $price_to = $request->input('price_to');

    // Log received coordinates and filters
    Log::info("Received coordinates: Lat = $lat, Long = $long");
    Log::info("Price range: From = $price_from, To = $price_to");

    // Fetch rice items with their dealer IDs
    $riceItems = Rice::with('dealer')->get();

    $filteredRiceItems = [];

    foreach ($riceItems as $rice) {
        // Get dealer ID
        $dealerId = $rice->dealer;

        if (!$dealerId) {
            Log::info("Rice item " . $rice->name . " has no dealer.");
            continue;
        }

        // Fetch the full dealer data using the dealer ID
        $dealer = Dealer::find($dealerId);

        // Skip rice items without dealer data or missing coordinates
        if (!$dealer || !$dealer->latitude || !$dealer->longitude) {
            Log::info("Skipping rice item " . $rice->name . " due to missing dealer coordinates.");
            continue;
        }

        // If latitude and longitude are not provided, skip distance filtering
        if ($lat && $long) {
            // Calculate the distance to the dealer's location
            $distance = $this->calculateDistance($lat, $long, $dealer->latitude, $dealer->longitude);
            Log::info("Calculated distance: " . $distance . " km for rice item ID: " . $rice->id);

            // Check distance filter
            if ($location_distance && $distance > $location_distance) {
                Log::info("Rice item " . $rice->name . " is too far.");
                continue;
            }
        }

        // Check price filter using 'per_sack' column
        if ($rice->per_sack < $price_from || $rice->per_sack > $price_to) {
            Log::info("Rice item " . $rice->name . " fails the price filter");
            continue;
        }

        // If passed all filters, add to the filtered list
        $filteredRiceItems[] = $rice;
    }

    // Log filtered rice items count
    Log::info("Filtered rice items: " . count($filteredRiceItems));

    return response()->json(['riceItems' => $filteredRiceItems]);
}










// Haversine Distance Function
private function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    $earthRadius = 6371;  // Radius of the earth in km

    // Convert degrees to radians
    $latFrom = deg2rad($lat1);
    $lonFrom = deg2rad($lon1);
    $latTo = deg2rad($lat2);
    $lonTo = deg2rad($lon2);

    // Difference in coordinates
    $latDiff = $latTo - $latFrom;
    $lonDiff = $lonTo - $lonFrom;

    // Haversine formula
    $a = sin($latDiff / 2) * sin($latDiff / 2) +
        cos($latFrom) * cos($latTo) *
        sin($lonDiff / 2) * sin($lonDiff / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distance in kilometers
    return $earthRadius * $c;
}

    public function history()
    {
        // Fetch all history records for the retailer
        $histories = History::where('retailer', session('profile')->business_name)->get();

        // Use map to transform the collection
        $orders = $histories->map(function ($order) {
            $dealer = Retailer::where('id', $order->dealer_id)->first();
            return [
                'dealer' => $dealer ? $dealer->business_name : 'Unknown Dealer', // Handle null dealer
                'rice_name' => $order->rice_name,
                'quantity' => $order->quantity,
                'price' => $order->total_amount,
                'delivery_date' => $order->created_at->format('F d, Y'),
            ];
        });

        return view('retailers.history', ['orders' => $orders]);
    }



}
