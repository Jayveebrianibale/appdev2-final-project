<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $customer = Customer::create($validatedData);
        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function storeOrder(Request $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);

        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'status' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $order = new Order($validatedData);
        $order->customer_id = $customer->id;
        $order->save();

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:customers,email,' . $id,
            'address' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:15',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);
        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
    
}

