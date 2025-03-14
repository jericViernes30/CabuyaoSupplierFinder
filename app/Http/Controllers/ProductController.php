<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rice;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $dealerID = session('dealer')->business_name;
        $validatedData = $request->validate([
            'dealer' => 'required|string|max:255',
            'rice_name' => 'required|string|max:255',
            'quality' => 'required|string|max:255',
            'sack_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'buy_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'address' => 'required|string|max:255',
        ]);

        // Create a new rice entry in the database
        $rice = Rice::create([
            'name' => $validatedData['rice_name'],
            'quality' => $validatedData['quality'],
            'per_sack' => $validatedData['sack_price'],
            'quantity' => $validatedData['quantity'],
            'price_bought' => $validatedData['buy_price'],
            'dealer' => $dealerID,
            'address' => $validatedData['address'],
            'image_name' => 'rice-1',
        ]);

        if($rice){
            // Return back with a success message
            return redirect()->back()->with('success', 'Rice added successfully!');
        } else{
            dd('ERROR');
        }
    }

    public function liveSearch(Request $request)
    {
        $search = $request->input('search');

        // Filter results based on name, quality, or dealer
        $riceList = Rice::where('name', 'like', "%{$search}%")
                        ->orWhere('quality', 'like', "%{$search}%")
                        ->orWhere('dealer', 'like', "%{$search}%")
                        ->get();

        // Append history count and final rate to each rice entry
        $riceData = $riceList->map(function ($r) {
            $historyCount = History::where('rice_name', $r->name)
                                ->where('dealer_id', $r->dealer)
                                ->count();

            // Avoid division by zero
            $finalRate = $historyCount > 0 ? $r->rate / $historyCount : 0;

            // Add calculated data
            $r->history_count = $historyCount;
            $r->final_rate = $finalRate;

            return $r;
        });

        // Return the modified results as JSON
        return response()->json($riceData);
    }


}
