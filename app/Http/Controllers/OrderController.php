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

    public function cancelById($orderId)
    {

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        if (auth()->user()->id != $order->customer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        $order->update(['status' => 'cancelled']);
        return response()->json(['message' => 'Order cancelled successfully'], 200);
    }
    


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}

