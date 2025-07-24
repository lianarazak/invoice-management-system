<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('customer', 'invoiceLines')->latest()->paginate(10);
        // $invoices = Invoice::latest()->paginate(10);

        return Inertia::render('Invoice/Index', [
            'invoices' => $invoices,
        ]);
        // return Invoice::with('customer', 'invoiceLines')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Invoice/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'line_items' => 'required|array',
            'line_items.*.product_name' => 'required',
            'line_items.*.quantity' => 'required|integer|min:1',
            'line_items.*.price_per_unit' => 'required|numeric|min:0',
            'line_items.*.price' => 'required|numeric|min:0'
        ]);

        $invoice = Invoice::create([
            'customer_id' => $data['customer_id'],
            'total' => 0
        ]);

        $total = 0;
        foreach ($data['line_items'] as $item) {
            // $total += $item['quantity'] * $item['price'];
            $total += $item['price'];
            $invoice->invoiceLines()->create($item);
        }

        $invoice->update(['total' => $total]);

        return $invoice->load('invoiceLines');
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
}
