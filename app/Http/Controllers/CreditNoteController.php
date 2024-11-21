<?php

namespace App\Http\Controllers;

use App\Models\CreditNote;
use App\Models\Invoice;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {
        $creditNotes = CreditNote::with('invoice')->get();
        return view('credit_notes.index', compact('creditNotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function create()
    {
        $invoices = Invoice::all();
        return view('credit_notes.create', compact('invoices'));
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
            'amount' => 'required|numeric',
            'reason' => 'nullable|string',
        ]);

        CreditNote::create($validated);

        return redirect()->route('credit_notes.index')->with('success', 'Credit note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param CreditNote $creditNote
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(CreditNote $creditNote)
    {
        return view('credit_notes.show', compact('creditNote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CreditNote $creditNote
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(CreditNote $creditNote)
    {
        $invoices = Invoice::all();
        return view('credit_notes.edit', compact('creditNote', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request    $request
     * @param CreditNote $creditNote
     *
     * @return RedirectResponse
     */
    public function update(Request $request, CreditNote $creditNote)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:1',
            'reason' => 'required|string|max:255',
        ]);

        $creditNote->update($validated);

        return redirect()->route('credit_notes.index')->with('success', 'Credit note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CreditNote $creditNote
     *
     * @return RedirectResponse
     */
    public function destroy(CreditNote $creditNote)
    {
        $creditNote->delete();

        return redirect()->route('credit_notes.index')->with('success', 'Credit note deleted successfully.');
    }
}
