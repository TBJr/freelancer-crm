<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all(); // Fetch all available items
        return view('invoices.create', compact('customers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric',
            'status' => 'required|string',
            'is_recurring' => 'nullable|boolean',
            'recurring_period' => 'nullable|string',
        ]);

        $total = array_reduce($validated['items'], function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);

        $invoice = Invoice::create([
            'customer_id' => $validated['customer_id'],
            'total' => $total,
            'tax' => $validated['tax'] ?? 0,
            'status' => $validated['status'],
            'is_recurring' => $validated['is_recurring'] ?? false,
            'recurring_period' => $validated['recurring_period'] ?? null,
        ]);

        foreach ($validated['items'] as $itemData) {
            $itemData['invoice_id'] = $invoice->id;
            $itemData['total'] = $itemData['quantity'] * $itemData['price'];
            InvoiceItem::create($itemData);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $invoice
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Invoice $invoice
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'status' => 'required|string',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     *
     * @return RedirectResponse
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     *
     * @return RedirectResponse
     */
    public function scheduleRecurring(Request $request, Invoice $invoice)
    {
        if (!$invoice->is_recurring) {
            return redirect()->route('invoices.show', $invoice)->with('error', 'This invoice is not set for recurring.');
        }

        // Create a clone of the invoice for the next period
        $newInvoice = $invoice->replicate();
        $newInvoice->created_at = now(); // Update the date for the new invoice
        $newInvoice->save();

        // Clone items
        foreach ($invoice->items as $item) {
            $item->replicate(['invoice_id'])->fill(['invoice_id' => $newInvoice->id])->save();
        }

        return redirect()->route('invoices.show', $newInvoice)->with('success', 'Recurring invoice created successfully.');
    }
}
