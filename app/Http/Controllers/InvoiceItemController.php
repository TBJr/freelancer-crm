<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {
        $invoiceItems = InvoiceItem::with(['invoice', 'item'])->get();
        return view('invoice_items.index', compact('invoiceItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function create()
    {
        $invoices = Invoice::all();
        $items = Item::all();
        return view('invoice_items.create', compact('invoices', 'items'));
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
            'invoice_id' => 'required|exists:invoices,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        InvoiceItem::create($validated);

        return redirect()->route('invoice_items.index')->with('success', 'Invoice item added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param InvoiceItem $invoiceItem
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(InvoiceItem $invoiceItem)
    {
        return view('invoice_items.show', compact('invoiceItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InvoiceItem $invoiceItem
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(InvoiceItem $invoiceItem)
    {
        $invoices = Invoice::all();
        $items = Item::all();
        return view('invoice_items.edit', compact('invoiceItem', 'invoices', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request     $request
     * @param InvoiceItem $invoiceItem
     *
     * @return RedirectResponse
     */
    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $invoiceItem->update($validated);

        return redirect()->route('invoice_items.index')->with('success', 'Invoice item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoiceItem $invoiceItem
     *
     * @return RedirectResponse
     */
    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();

        return redirect()->route('invoice_items.index')->with('success', 'Invoice item deleted successfully.');
    }
}
