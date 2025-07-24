<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $customers = Customer::paginate(10);
        // return Inertia::render('Customers/Index', [
        //     'customers' => $customers
        // ]);

        $customers = Customer::latest()->paginate(10);

        return Inertia::render('Customer/Index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customer/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20|unique:customers,phone',
        ]);

        $customer = Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');

        // return Customer::create($request->validate([
        //     'name' => 'required',
        //     'email' => 'nullable|email',
        //     'phone' => 'nullable'
        // ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function list()
    {
        $customers = Customer::select('id', 'name')->get();

        if (!$customers) return response()->json(['status' => false, 'message' => 'Failed to fetch data'], 500);

        return response()->json([
            'data' => $customers,
            'status' => true
        ], 200);
        // return response()->json($customers);
    }
}
