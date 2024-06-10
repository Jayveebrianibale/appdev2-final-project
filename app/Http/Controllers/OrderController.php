<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{   
    // Fetch all orders
    public function index()
    {
        $orders = Order::all();
        return response()->json(['orders' => $orders], 200);
    }

    // Create a new order
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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'sometimes|string|in:pending,processing,shipped,cancelled',
            'price' => 'sometimes|numeric',
        ]);
    
        $order = Order::findOrFail($id);
        $order->update($validatedData);
    
        return response()->json($order);
    }

    
    // Delete an order by ID
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
