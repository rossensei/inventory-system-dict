<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcquisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acquisitions = Acquisition::select('id', 'name')
        ->withCount('properties')
        ->orderBy('name', 'asc')
        ->get();
        
        return inertia('Acquisition/Index', [
            'acquisitions' => $acquisitions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:acquisitions']);

        Acquisition::create(['name' => $request->name]);

        session()->flash('success', 'New acquisition type has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Acquisition $acquisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acquisition $acquisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acquisition $acquisition)
    {
        // dd($request, $acquisition);
        $request->validate([
            'name' => ['required', 'string', Rule::unique(Acquisition::class)->ignore($acquisition->id)]
        ]);

        $acquisition->update(['name' => $request->name]);

        session()->flash('success', 'Acquisition type has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acquisition $acquisition)
    {
        if($acquisition->properties()->exists()) {
            return back()->with('error', 'This record has an associated properties');
        }

        $acquisition->delete();

        return back()->with('success', 'Acquisition type successfully removed!');
    }
}
