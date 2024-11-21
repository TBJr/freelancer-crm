<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {
        $timesheets = Timesheet::with(['project', 'user'])->get();
        return view('timesheets.index', compact('timesheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        return view('timesheets.create', compact('projects', 'users'));
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
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'hours' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        Timesheet::create($validated);

        return redirect()->route('timesheets.index')->with('success', 'Timesheet created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param Timesheet $timesheet
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(Timesheet $timesheet)
    {
        return view('timesheets.show', compact('timesheet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Timesheet $timesheet
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(Timesheet $timesheet)
    {
        $projects = Project::all();
        $users = User::all();
        return view('timesheets.edit', compact('timesheet', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request   $request
     * @param Timesheet $timesheet
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'hours' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $timesheet->update($validated);

        return redirect()->route('timesheets.index')->with('success', 'Timesheet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Timesheet $timesheet
     *
     * @return RedirectResponse
     */
    public function destroy(Timesheet $timesheet)
    {
        $timesheet->delete();

        return redirect()->route('timesheets.index')->with('success', 'Timesheet deleted successfully.');
    }
}
