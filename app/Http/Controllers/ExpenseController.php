<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function create()
    {
        return view('expenses.create');
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
            'category' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Expense::create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Expense $expense
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Expense $expense
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Expense $expense
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param Expense $expense
     *
     * @return RedirectResponse
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
