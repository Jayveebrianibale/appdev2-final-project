<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{   
    public function index()
    {
        $orders = Order::all();

        return response()->json(['orders' => $orders], 200);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required',
            'price' => 'required|numeric',
        ]);
    
        
        $order = Order::create($validatedData);
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function cancelByCustomerId($customerId)
{
    // Find orders associated with the provided customer_id
    $orders = Order::where('customer_id', $customerId)->get();
    
    // Check if orders exist
    if ($orders->isEmpty()) {
        return response()->json(['message' => 'No orders found for the given customer ID'], 404);
    }

    // Loop through each order
    foreach ($orders as $order) {
        // Check if the customer_id of the order matches the authenticated user's ID
        if ($order->customer_id != auth()->user()->id) {
            abort(403, 'Unauthorized');
        }

        // Update the status of the order to 'cancelled'
        $order->status = 'cancelled';
        $order->save();  // Ensure save() is called to persist changes
    }

    // Return a JSON response with a success message
    return response()->json(['message' => 'Orders cancelled successfully'], 200);
}


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}

